<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Image;
use App\Models\HotelSpecialOffer;
use App\Models\TransportType;
use App\Models\HotelSpecialOfferRoom;
use App\Models\Route;
use App\Models\Transport;
use App\Models\HotelRoom;
use App\Models\CurrencyConversion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.hotel.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();

        return view('admin.hotel.create',compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $current_currency = CurrencyConversion::first();
        $rules = [
            'name' => 'required',
            'google_map' => 'required',
            'weekend_price' => 'required|array|min:1',
            'weekdays_price' => 'required|array|min:1',
            'city' => 'required',
            'validity' => 'required|date',
            'room_id' => 'required|array|min:1'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $hotel = new Hotel();

        $hotel->name = $request->name;
        $hotel->excerpt = $request->excerpt;
        $hotel->description = $request->description;
        $hotel->google_map = $request->google_map;
        $hotel->city = $request->city;
        
        $hotel->save();

        if($request->has('images'))
        {
            $images = $request->file('images');

            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
        
                $newImage = new Image();
                $newImage->name = $imageName;
                $newImage->path = 'uploads/' . $imageName;
                $newImage->hotel_id = $hotel->id;
                $newImage->save();
            }
        }

        $roomIds = $request->room_id;
        $weekdaysPrices = $request->weekdays_price;
        $weekendPrices = $request->weekend_price;   

        for ($i = 0; $i < count($roomIds); $i++)
        {
            DB::table('hotel_rooms')->insert([
                'hotel_id' => $hotel->id,
                'room_id' => $roomIds[$i], 
                'weekdays_price' => $weekdaysPrices[$i],
                'weekend_price' => $weekendPrices[$i],
                'validity' => $request->validity,
                'current_currency' => $current_currency->default_currency
            ]);
        }
        
        if(isset($request->offer_name) && count($request->offer_name) > 0) {
            foreach($request->offer_name as $key => $offer) {
                
                $data['hotel_id'] = $hotel->id;
                $data['package_name'] = $offer;
                $data['start_date'] = $request->offer_start_date[$key];
                $data['end_date'] = $request->offer_end_date[$key];

                $package = HotelSpecialOffer::create($data);

                if(count($request->rooms) > 0) {
                    foreach($request->rooms as $keyr => $room) {
                        $dataroom['package_id'] = $package->id;
                        $dataroom['room_id'] = $keyr;
                        $dataroom['price'] = $room[$key];

                        HotelSpecialOfferRoom::create($dataroom);
                    }
                }
            }
        }
        return redirect()->route('hotels.index')->with('success', 'Hotel has been added successfully!');

    }
    public function custom_package(){
        $rooms = Room::all();
        $routes = Route::all();
        $transport_types = TransportType::all();
        return view('admin.package.index', compact('rooms','routes','transport_types'));
    }
    public function currency_conversion()
    {
        $currency_conversion = CurrencyConversion::first();
        return view('admin.currency.index',compact('currency_conversion'));
    }
    public function update_currency_conversion(Request $request){
        $currency_conversion = CurrencyConversion::findOrFail(1);

        $currency_conversion->usd = $request->usd;
        $currency_conversion->sar = $request->sar;
        $currency_conversion->default_currency = $request->default_currency;

        $currency_conversion->save();
       
        return redirect()->route('admin.currency_conversion', compact('currency_conversion'))->with('success', 'Currency has been Updated successfully!');
    }
    public function calculate_package(Request $request){
        $total=0;
        $total= $total + $request->visa_charges;
        if(isset($request->route_id) && count($request->route_id) > 0)
        {
            for($i=0; $i<count($request->route_id); $i++)
            {
                $transport = Transport::where('route_id',$request->route_id[$i]);
            }
        }
        return $total;
    }
    public function get_hotels(Request $request)
    {
        $result = Hotel::orderBy('created_at', 'DESC');

        $aColumns = ['id','name','google_map','city', 'excerpt','created_at'];

        $iStart = $request->get('iDisplayStart');
        $iPageSize = $request->get('iDisplayLength');

        $order = 'created_at';
        $sort = ' DESC';

        if ($request->get('iSortCol_0')) { 
      
            $sOrder = "ORDER BY  ";

            for ($i = 0; $i < intval($request->get('iSortingCols')); $i++) {
                if ($request->get('bSortable_' . intval($request->get('iSortCol_' . $i))) == "true") {
                    $sOrder .= $aColumns[intval($request->get('iSortCol_' . $i))] . " " . $request->get('sSortDir_' . $i) . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                 $sOrder = " id ASC";
            }

            $OrderArray = explode(' ', $sOrder);
            $order = trim($OrderArray[3]);
            $sort = trim($OrderArray[4]);

        }

        $sKeywords = $request->get('sSearch');
        if ($sKeywords != "") {

            $result->Where(function($query) use ($sKeywords) {
                $query->orWhere('name', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('city', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('validity', 'LIKE', "%{$sKeywords}%");
            });
        }

        for ($i = 0; $i < count($aColumns); $i++) {
            $request->get('sSearch_' . $i);
            if ($request->get('bSearchable_' . $i) == "true" && $request->get('sSearch_' . $i) != '') {
                 $result->orWhere($aColumns[$i], 'LIKE', "%" . $request->orWhere('sSearch_' . $i) . "%");
            }
        }

        $iFilteredTotal = $result->count();

        if ($iStart != null && $iPageSize != '-1') {
            $result->skip($iStart)->take($iPageSize);
        }

        $result->orderBy($order, trim($sort));
        $result->limit($request->get('iDisplayLength'));
        $linksData = $result->get();

        $iTotal = $iFilteredTotal;
        $output = array(
             "sEcho" => intval($request->get('sEcho')),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => array()
        );
        $i = 0;

        foreach ($linksData as $aRow) {

            $checkbox = "<label class=\"mt-checkbox mt-checkbox-single mt-checkbox-outline\">
                             <input type=\"checkbox\" class=\"checkbox-index\" value=\"{$aRow->id}\">
                             <span></span>
                          </label>"; 

            $hotel_id = $aRow->id;
            $name = $aRow->name;
            $city = $aRow->city;
            $excerpt =  $aRow->excerpt;

            $action = "<span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog font-medium-1\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"hotels/{$aRow->id}/edit\" class=\"dropdown-item font-small-3\"><i class=\"la la-barcode font-small-3\"></i> edit</a>
                            <a href=\"#\" onClick=\"deleteHotel({$aRow->id})\"  class=\"dropdown-item font-small-3\"><i class=\"la la-repeat font-small-3\"></i> delete</a>
                          </span>
                        </span>
                        ";
 
            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$aRow->id,
                @$name,
                @$city,
                @$excerpt,
                @$action
            );  

            $i++;
        }
        echo json_encode($output);           
    }
    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $rooms = Room::all();
        $hotel_rooms = DB::table('hotel_rooms')
                        ->join('rooms', 'rooms.id', '=', 'hotel_rooms.room_id')
                        ->select('hotel_rooms.*','rooms.id as room_id', 'rooms.name as room_name')
                        ->where('hotel_rooms.hotel_id', $hotel->id)
                        ->get();
        $specialOffers = $hotel->specialOffers;
        $room_category = ["Single","Double","Triple","Quad"];
        $room_count=0;
        return view('admin.hotel.edit',compact('hotel','hotel_rooms','room_category','room_count'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $request;
        $currency_conversion = CurrencyConversion::first();

        $hotel = Hotel::findOrFail($id);

        $hotel->name = $request->name;
        $hotel->excerpt = $request->excerpt;
        $hotel->description = $request->description;
        $hotel->google_map = $request->google_map;
        $hotel->city = $request->city;
        
        $hotel->save();

        $roomIds = $request->room_id;
        $weekdaysPrices = $request->weekdays_price;
        $weekendPrices = $request->weekend_price; 

        for ($i=0; $i<count($request->validity); $i++){
            for ($j = 0; $j < count($roomIds); $j++) {
                HotelRoom::where('hotel_id', $hotel->id)
                    ->where('room_id', $roomIds[$j])
                    ->update([
                        'weekdays_price' => $weekdaysPrices[$j],
                        'weekend_price' => $weekendPrices[$j],
                        'validity' => $request->validity[$i],
                        'current_currency' => $currency_conversion->default_currency
                    ]);
            }
        }
        
        
        if(isset($request->offer_id) && count($request->offer_id) > 0){
            foreach ($request->offer_id as $key => $val) {
                $specialOffer = HotelSpecialOffer::findOrFail($val);

                if($val!=0){

                    $specialOffer->update([
                        'package_name' => $request->offer_name[$key],
                        'start_date' => $request->offer_start_date[$key],
                        'end_date' => $request->offer_end_date[$key],
                    ]);
                    
                    //foreach ($request->rooms_price as $roomData => $value ) {
                        
                        // $hotel_special_offer_room = HotelSpecialOfferRoom::findOrFail($request->rooms_price);
                        // echo $hotel_special_offer_room;
                        // $room->update([
                        //     'price' => $roomData['price'],
                        //     // Any other fields you need to update in the room
                        // ]);
                    
               }
            }
        }
        return redirect()->route('hotels.index')->with('success', 'Hotel has been Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $hotel = Hotel::findOrFail($id);
       $hotel->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Hotel deleted successfully.'
        ], 200);
    }
}
