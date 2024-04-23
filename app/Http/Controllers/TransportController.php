<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransportType;
use App\Models\Route;
use App\Models\Transport;
use App\Models\Cost;
use App\Models\CurrencyConversion;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.transport.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $current_currency = CurrencyConversion::findOrFail(1);
        $routes= Route::all();
        $transport_types = Vehicle::all();
        return view('admin.transport.create', compact('routes','transport_types','current_currency'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $current_currency = CurrencyConversion::findOrFail(1);
        $rules = [
            'vehicle_id' => 'required',
            'route_id' => 'required',
            'cost' => 'required',
            'validity_start' => 'required|date',
            'validity_end' => 'required|date'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $transport = new Transport();

        $transport->vehicle_id = $request->vehicle_id;
        $transport->route_id = $request->route_id;
        $transport->Commision = $request->commision;
    
        $transport->save();
        $transport->costs()->create([
            'item_id' => $transport->id,
            'item_type' => 'transports', 
            'cost' => $request->cost,   
            'validity_start' => $request->validity_start,
            'validity_end' => $request->validity_end,
            'current_currency' =>  $current_currency->default_currency
        ]);
        return redirect()->route('transports.index')->with('success', 'Transport has been added successfully!');
    }

    public function get_transports(Request $request)
    {
        $result = Transport::orderBy('created_at', 'DESC');

        $aColumns = ['id','vehicle_id', 'route_id','cost','validity','created_at'];

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
                $query->orWhere('vehicle_id', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('route_id', 'LIKE', "%{$sKeywords}%");

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

            $vehicle_id = $aRow->types->name;
            $route_id = $aRow->route->name;

            $action = "<span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog font-medium-1\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"transports/{$aRow->id}/edit\" class=\"dropdown-item font-small-3\"><i class=\"la la-barcode font-small-3\"></i> edit</a>
                            <a href=\"#\" onClick=\"deleteTransport({$aRow->id})\"  class=\"dropdown-item font-small-3\"><i class=\"la la-repeat font-small-3\"></i> delete</a>
                          </span>
                        </span>
                        ";
 
            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$aRow->id,
                @$vehicle_id,
                @$route_id,
                @$action
            );  

            $i++;
        }
        echo json_encode($output);           
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $current_currency = CurrencyConversion::first();
        $transport = Transport::findOrFail($id);
        $costs = Cost::where('item_id','=',$transport->id)->get();
        $routes= Route::all();
        $transport_types = Vehicle::all();
        return view('admin.transport.edit',compact('routes','transport_types','transport','costs' ,'current_currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $current_currency = CurrencyConversion::first();
        $transport = Transport::findOrFail($id);

        $transport->vehicle_id = $request->vehicle_id;
        $transport->route_id = $request->route_id;
        $transport->Commision = $request->commision;
        foreach ($request->cost as $key => $costData) {
            $costId = $request->cost_id[$key] ?? null; // Existing cost ID
    
            // Find the existing cost or create a new one
            $cost = Cost::findOrNew($costId);
    
            // Update the cost attributes
            $cost->item_id = $transport->id;
            $cost->item_type = 'transports';
            $cost->cost = $costData;
            $cost->validity_start = $request->validity_start[$key];
            $cost->validity_end = $request->validity_end[$key];
            $cost->current_currency = $current_currency->default_currency;
            // Save the cost instance
            $cost->save();
        }
        $transport->save();

        return redirect()->route('transports.index')->with('success', 'Transport has been Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_transport_validity($id)
    {
        try {

            // Find all hotel rooms associated with the validity date
            $validity = Cost::where('id', $id)->get();

            // Delete all the found rooms
            foreach ($validity as $validity) {
                $validity->delete();
            }
        } catch (\Exception $e) {
        }
        $validity = Cost::where('id', $id)->get();
        return redirect()->route('transports.index')->with('success', 'Record deleted successfully!');
    }
    
    public function destroy($id)
    {
       $transport = Transport::findOrFail($id);
       DB::table('costs')->where('item_id', $transport->id)->delete();

       $transport->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Welldone! Item deleted successfully.'
        ], 200);
    }

}
