<?php

namespace App\Http\Controllers;

use App\Models\CurrencyConversion;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\HotelSpecialOffer;
use App\Models\HotelSpecialOfferRoom;
use App\Models\Image;
use App\Models\Meal;
use App\Models\MealType;
use App\Models\Room;
use App\Models\Route;
use App\Models\Transport;
use App\Models\TransportType;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $meal_types = MealType::all();

        return view('admin.hotel.create', compact('rooms', 'meal_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $current_currency = CurrencyConversion::first();
        $rules = [
            'name' => 'required',
            'google_map' => 'required',
            'weekend_price' => 'required|array|min:1',
            'weekdays_price' => 'required|array|min:1',
            'city' => 'required',
            'validity_start' => 'required|date',
            'validity_end' => 'required|date',
            'room_id' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:3000',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $display = $request->display ?? 0;
        $hotel = new Hotel();

        $hotel->name = $request->name;
        $hotel->excerpt = $request->excerpt;
        $hotel->display = $display;
        $hotel->description = $request->description;
        $hotel->google_map = $request->google_map;
        $hotel->commision = $request->commision;
        $hotel->note = $request->note;
        $hotel->city = $request->city;

        $hotel->save();

        if ($request->has('images')) {
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
        $hotelRoomData = [];
        for ($i = 0; $i < count($roomIds); $i++) {
            if ($weekdaysPrices[$i]) {
                $hotelRoomData[] = [
                    'hotel_id' => $hotel->id,
                    'room_id' => $roomIds[$i],
                    'weekdays_price' => $weekdaysPrices[$i],
                    'weekend_price' => $weekendPrices[$i],
                    'validity_start' => $request->validity_start,
                    'validity_end' => $request->validity_end,
                    'current_currency' => $current_currency->default_currency,
                ];
            }
        }

        HotelRoom::insert($hotelRoomData);

        $meal_type_id = $request->meal_type_id;
        $meal_price = $request->meal_price;
        $displayMeal = $request->displayMeal;
        $mealData = [];
        for ($i = 0; $i < count($meal_type_id); $i++) {
            if($displayMeal == NULL){$displayMeal[] = 0;};
            // dd($displayMeal);
            $display = in_array($meal_type_id[$i], $displayMeal) ? 1 : 0;
            if ($meal_price[$i]) {
                $mealData[] = [
                    'hotel_id' => $hotel->id,
                    'meal_type_id' => $meal_type_id[$i],
                    'price' => $meal_price[$i],
                    'display' => $display,
                ];
            }
        }

        Meal::insert($mealData);

        // Retrieve the inserted hotel rooms
        // $hotelRooms = HotelRoom::with('hotel')->where('hotel_id', $hotel->id)->get();

        // // Dispatch job for each hotel room
        // foreach ($hotelRooms as $room) {
        //     // SendHotelValidityExpirationNotification::dispatch($room)->delay(now()->addMinutes(5));
        //     SendHotelValidityExpirationNotification::dispatch($room)->delay(Carbon::now()->addMinutes(1));

        // }

        if (isset($request->offer_name) && count($request->offer_name) > 0) {
            foreach ($request->offer_name as $key => $offer) {

                $data['hotel_id'] = $hotel->id;
                $data['package_name'] = $offer;
                $data['start_date'] = $request->offer_start_date[$key];
                $data['end_date'] = $request->offer_end_date[$key];

                $package = HotelSpecialOffer::create($data);

                if (count($request->rooms) > 0) {
                    foreach ($request->rooms as $keyr => $room) {
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
    public function custom_package()
    {
        $rooms = Room::all();
        $routes = Route::all();
        $transport_types = TransportType::all();
        return view('admin.package_calculation.index', compact('rooms', 'routes', 'transport_types'));
    }
    public function currency_conversion()
    {
        $currency_conversion = CurrencyConversion::first();
        return view('admin.currency.index', compact('currency_conversion'));
    }
    public function update_currency_conversion(Request $request)
    {
        $currency_conversion = CurrencyConversion::findOrFail(1);

        $currency_conversion->sar_to_usd = $request->sar_to_usd;
        $currency_conversion->sar_to_pkr = $request->sar_to_pkr;
        // $currency_conversion->default_currency = $request->default_currency;

        $currency_conversion->save();

        return redirect()->route('admin.currency_conversion', compact('currency_conversion'))->with('success', 'Currency has been Updated successfully!');
    }
    public function calculate_package(Request $request)
    {
        $total = 0;
        $total = $total + $request->visa_charges;
        if (isset($request->route_id) && count($request->route_id) > 0) {
            for ($i = 0; $i < count($request->route_id); $i++) {
                $transport = Transport::where('route_id', $request->route_id[$i]);
            }
        }
        return $total;
    }
    public function get_hotels(Request $request)
    {
        $result = Hotel::orderBy('created_at', 'DESC');

        $aColumns = ['id', 'name', 'city', 'excerpt', 'created_at'];

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

            $result->Where(function ($query) use ($sKeywords) {
                $query->orWhere('name', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('city', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('excerpt', 'LIKE', "%{$sKeywords}%");
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
            "aaData" => array(),
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
            $excerpt = $aRow->excerpt;

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
                @$action,
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
            ->select('hotel_rooms.*', 'rooms.id as room_id', 'rooms.name as room_name')
            ->where('hotel_rooms.hotel_id', $hotel->id)
            ->orderBy('hotel_rooms.validity_start')
            ->orderBy('rooms.id')
            ->get()
            ->groupBy('validity_start');
            // dd($hotel_rooms);
        $meals = DB::table('meals')
            ->join('meal_types', 'meal_types.id', '=', 'meals.meal_type_id')
            ->select('meals.*', 'meal_types.id as meal_id', 'meal_types.name as name')
            ->where('meals.hotel_id', $hotel->id)
            ->orderBy('meal_types.id')
            ->get();

        $meal_types = MealType::all();

        $specialOffers = $hotel->specialOffers;
        $room_category = ["Single", "Double", "Triple", "Quad"];
        $room_count = 0;
        return view('admin.hotel.edit', compact('hotel', 'hotel_rooms', 'room_category', 'room_count', 'meal_types', 'meals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required',
            'google_map' => 'required',
            'weekend_price' => 'required|array|min:1',
            'weekdays_price' => 'required|array|min:1',
            'city' => 'required',
            'room_id' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:3000',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $currency_conversion = CurrencyConversion::first();

        $display = $request->display ?? 0;
        $displayPrice = $request->displayPrice ?? 0;
        $hotel = Hotel::findOrFail($id);

        $hotel->name = $request->name;
        $hotel->excerpt = $request->excerpt;
        $hotel->description = $request->description;
        $hotel->display = $display;
        $hotel->displayPrice = $displayPrice;
        $hotel->Commision = $request->commision;
        $hotel->google_map = $request->google_map;
        $hotel->note = $request->note;
        $hotel->city = $request->city;

        $hotel->save();

        $roomIds = $request->room_id;
        $ids = $request->id;
        $weekdaysPrices = $request->weekdays_price;
        $weekendPrices = $request->weekend_price;

        if ($request->validity_start != null) {
            foreach ($request->validity_start as $i => $validity_start) {
                // Extract corresponding room IDs and details for the current validity date
                $currentRoomIds = $roomIds[$i];
                $currentIds = $ids[$i] ?? []; // Ensure the IDs array is set
                $currentWeekdaysPrices = $weekdaysPrices[$i];
                $currentWeekendPrices = $weekendPrices[$i];
                $validity_end = $request->validity_end[$i]; // Get corresponding end dates


                // Loop through the room IDs and update or create records for each room
                foreach ($currentRoomIds as $index => $roomId) {
                    // Extract corresponding prices and ID for the current room

                    $idss = $currentIds[$index] ?? null;
                    $weekdaysPrice = $currentWeekdaysPrices[$index];
                    $weekendPrice = $currentWeekendPrices[$index];
                    // dd($currentValidityEnds);
                    // Update or create the hotel room record for the current room ID and validity date

                    if ($weekdaysPrice === null) {
                        // If $weekdaysPrice is null, delete the row
                        HotelRoom::where([
                            'hotel_id' => $hotel->id,
                            'room_id' => $roomId,
                            'id' => $idss,
                        ])->delete();
                    } else {
                        HotelRoom::updateOrCreate(
                            [
                                'hotel_id' => $hotel->id,
                                'room_id' => $roomId,
                                'id' => $idss,

                            ],
                            [
                                'validity_start' => $validity_start,
                                'validity_end' => $validity_end,
                                'weekdays_price' => $weekdaysPrice,
                                'weekend_price' => $weekendPrice,
                                'current_currency' => $currency_conversion->default_currency,
                            ]
                        );
                    }
                }
            }
        }
        if ($request->has('images')) {
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

        // for meal update
        $meal_type_id = $request->meal_type_id;
        $meal_price = $request->meal_price;
        $displayMeal = $request->displayMeal;

// Retrieve existing meals for the hotel
        $existingMeals = Meal::where('hotel_id', $hotel->id)->get()->keyBy('meal_type_id');

// Initialize an array to store meal IDs with NULL price
        $mealIdsWithNullPrice = [];

        foreach ($meal_type_id as $index => $type_id) {
            if($displayMeal == NULL){
                $displayMeal[] = 0;
                $display = in_array($meal_type_id[$index], $displayMeal) ? 1 : 0;
            }
            else{
            $display = in_array($type_id, $displayMeal) ? 1 : 0;
            }
            $price = $meal_price[$index];

            // If price is NULL, add meal ID to the array
            if ($price === null) {
                $mealIdsWithNullPrice[] = $type_id;
                continue;
            }

            // Check if the meal already exists
            if ($existingMeals->has($type_id)) {
                $meal = $existingMeals[$type_id];
                // Update existing meal data
                $meal->price = $price;
                $meal->display = $display;
                $meal->save();
            } else {
                // If meal doesn't exist, create new meal
                Meal::create([
                    'hotel_id' => $hotel->id,
                    'meal_type_id' => $type_id,
                    'price' => $price,
                    'display' => $display,
                ]);
            }
        }

// Delete previous records corresponding to meal IDs with NULL price
        if (!empty($mealIdsWithNullPrice)) {
            Meal::where('hotel_id', $hotel->id)
                ->whereIn('meal_type_id', $mealIdsWithNullPrice)
                ->delete();
        }

        if (isset($request->offer_id) && count($request->offer_id) > 0) {
            foreach ($request->offer_id as $key => $val) {

                if ($val != 0) {
                    $specialOffer = HotelSpecialOffer::findOrFail($val);
                    $specialOffer->update([

                        'package_name' => $request->offer_name[$key],
                        'start_date' => $request->offer_start_date[$key],
                        'end_date' => $request->offer_end_date[$key],
                    ]);

                    for ($i = 0; $i < count($request->rooms_price); $i++) {
                        HotelSpecialOfferRoom::where('package_id', $specialOffer->id)
                            ->where('id', $request->rooms_id[$i])
                            ->update([
                                'price' => $request->rooms_price[$i],
                            ]);
                    }
                } else {
                    $specialOffer = new HotelSpecialOffer();

                    $specialOffer->hotel_id = $id;
                    $specialOffer->package_name = $request->offer_name[$key];
                    $specialOffer->start_date = $request->offer_start_date[$key];
                    $specialOffer->end_date = $request->offer_end_date[$key];

                    $specialOffer->save();

                    if (count($request->rooms) > 0) {

                        for ($i = 0; $i < count($request->rooms); $i++) {

                            HotelSpecialOfferRoom::create([
                                'room_id' => $request->hotel_room_id[$i],
                                'price' => $request->rooms[$i],
                                'package_id' => $specialOffer->id,
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->route('hotels.index')->with('success', 'Hotel has been Updated successfully!');
    }

    public function deleteValidity($date)
    {
        try {
            // Parse the date string to a Carbon instance
            $parsedDate = Carbon::parse($date);

            // Find all hotel rooms associated with the validity date
            $rooms = HotelRoom::whereDate('validity_end', $parsedDate)->get();

            // Delete all the found rooms
            foreach ($rooms as $room) {
                $room->delete();
            }
        } catch (\Exception $e) {
        }
        return redirect()->route('hotels.index')->with('success', 'Record deleted successfully!');
    }

    public function deleteOffer($id)
    {
        try {

            $specialOffer = HotelSpecialOffer::where('hotel_id', $id);
            $specialOffer->delete();
        } catch (\Exception $e) {
        }
        return redirect()->route('hotels.index')->with('success', 'Offer deleted successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotel_room = HotelRoom::where('hotel_id', $id);
        $hotel_room->delete();

        $specialOffer = HotelSpecialOffer::where('hotel_id', $id);
        $specialOffer->delete();
        
        $Meals = Meal::where('hotel_id', $id);
        $Meals->delete();

        $images = Image::where('hotel_id', $id)->get();

        foreach ($images as $image) {
            $imageFileName = $image->name;
            $imagePath = public_path('uploads') . '/' . $imageFileName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }

        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Hotel deleted successfully.',
        ], 200);
    }
}
