<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransportType;
use App\Models\Route;
use App\Models\Transport;
use Illuminate\Support\Facades\Validator;


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
        $routes= Route::all();
        $transport_types = TransportType::all();
        return view('admin.transport.create', compact('routes','transport_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'transport_type_id' => 'required',
            'make' => 'required|string|max:255',
            'capacity' => 'required',
            'route_id' => 'required',
            'cost' => 'required',
            'validity' => 'required|date'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $transport = new Transport();

        $transport->transport_type_id = $request->transport_type_id;
        $transport->make = $request->make;
        $transport->capacity = $request->capacity;
        $transport->route_id = $request->route_id;
        $transport->cost = $request->cost;
        $transport->validity = $request->validity;
        $transport->save();

        return redirect()->route('transports.index')->with('success', 'Transport has been added successfully!');
    }

    public function get_transports(Request $request)
    {
        $result = Transport::orderBy('created_at', 'DESC');

        $aColumns = ['id','transport_type_id','make','capacity', 'route_id','cost','validity','created_at'];

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
                $query->orWhere('transport_type_id', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('make', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('capacity', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('route_id', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('cost', 'LIKE', "%{$sKeywords}%");
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

            $transport_type_id = $aRow->types->name;
            $make = $aRow->make;
            $capacity = $aRow->capacity;
            $route_id = $aRow->route->name;
            $cost = $aRow->cost;
            $validity = $aRow->validity;

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
                @$transport_type_id,
                @$make,
                @$capacity,
                @$route_id,
                @$cost,
                @$validity,
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
        $transport = Transport::findOrFail($id);

        $routes= Route::all();
        $transport_types = TransportType::all();
        return view('admin.transport.edit',compact('routes','transport_types','transport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transport = Transport::findOrFail($id);

        $transport->transport_type_id = $request->transport_type_id;
        $transport->make = $request->make;
        $transport->capacity = $request->capacity;
        $transport->route_id = $request->route_id;
        $transport->cost = $request->cost;
        $transport->validity = $request->validity;
        $transport->save();

        return redirect()->route('transports.index')->with('success', 'Transport has been Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $transport = Transport::findOrFail($id);
       $transport->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Welldone! Item deleted successfully.'
        ], 200);
    }
}
