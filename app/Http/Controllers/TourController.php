<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tour.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tour.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other fields
        ]);

        $package = new Tour();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $package->image = $imageName;
        }

        $package->name = $request->name;
        $package->type = $request->type;
        $package->description = $request->description;
        $package->note = $request->note;
        $package->save();

        return redirect()->route('tours.index')->with('success', 'Tour created successfully.');
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
    public function edit(string $id)
    {
        $tour = Tour::findOrFail($id);
        return view('admin.tour.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'price' => 'required|numeric',
            'type' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);

        $package = Tour::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            // Store the image path or perform any other necessary actions
            $package->image = $imageName;
        }

        $package->name = $request->name;
        $package->type = $request->type;
        $package->description = $request->description;
        $package->note = $request->note;
        // $package->price = $request->price;
        // Set other fields as needed
        $package->save();
        // Attach selected hotels to the package
        // $package->hotels()->attach($request->input('hotels'));

        return redirect()->route('tour.index')->with('success', 'Tour Updated successfully.');
    }


    public function get_tours(Request $request)
    {
        $result = Tour::orderBy('created_at', 'DESC');
        
        $aColumns = ['id', 'name','type','note','image', 'created_at'];

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
                $query->orWhere('type', 'LIKE', "%{$sKeywords}%");
                $query->orWhere('note', 'LIKE', "%{$sKeywords}%");
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
            $name = $aRow->name;
            // $price = $aRow->price;
            $type = $aRow->type;
            $note = $aRow->note;
            $imageName = $aRow->image;
            $imageUrl = asset('uploads/' . $imageName);
            $image = "<img style='height:60px; width:60px' src='{$imageUrl}'>";
            

            $action = "<span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog font-medium-1\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"tours/{$aRow->id}/edit\" class=\"dropdown-item font-small-3\"><i class=\"la la-barcode font-small-3\"></i> edit</a>
                            <a href=\"#\" onClick=\"deleteTour({$aRow->id})\"  class=\"dropdown-item font-small-3\"><i class=\"la la-repeat font-small-3\"></i> delete</a>
                          </span>
                        </span>
                        ";

            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$aRow->id,
                @$name,
                @$type,
                @$note,
                @$image,
                @$action
            );

            $i++;
        }
        echo json_encode($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Tour::findOrFail($id);
        $imagePath = public_path('uploads');
        $imageFileName = $package->image; // Assuming the image file name is stored in the 'image' column
        if ($imageFileName && file_exists($imagePath . '/' . $imageFileName)) {
            unlink($imagePath . '/' . $imageFileName);
        }
       $package->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Welldone! Event deleted successfully.'
        ], 200);
    }
}
