<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $roles = Testimonial::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(5);
        $result = Testimonial::orderBy('created_at', 'DESC');
        return view('admin.testimonial.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'content' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'designation' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('uploads'), $imageName);

        // Update existing testimonial or create a new one
        $Testimonial = new Testimonial();
        
        $Testimonial->user_id = $user->id;
        $Testimonial->content = $request->input('content');
        $Testimonial->first_name = $request->input('first_name');
        $Testimonial->last_name = $request->input('last_name');
        $Testimonial->designation = $request->input('designation');
        $Testimonial->image = $imageName;

        $Testimonial->save();
        // Testimonial::updateOrCreate(
        //     ['user_id' => $user->id], // Find testimonial by user ID
        //     [
        //         'content' => $request->input('content'),
        //         'first_name' => $request->input('first_name'),
        //         'last_name' => $request->input('last_name'),
        //         'designation' => $request->input('designation'),
        //         'image' => $imageName, // Update or create content
        //     ]
        // );

        // Redirect the user back with a success message
        return redirect()->route('testimonials.index')->with('success', 'Testimonial added successfully.');
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
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'content' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'designation' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $Testimonial = Testimonial::findOrFail($id);
    
        $Testimonial->content = $request->input('content');
        $Testimonial->first_name = $request->input('first_name');
        $Testimonial->last_name = $request->input('last_name');
        $Testimonial->designation = $request->input('designation');
    
        if ($request->hasFile('image')) {
            if (!empty($Testimonial->image)) {
                $oldImagePath = public_path('uploads/' . $Testimonial->image);

                // Delete the old image if it exists
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $Testimonial->image = $imageName;
        }
    
        $Testimonial->save();
    
        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');    
    }

    public function get_testimonial_result(Request $request)
    {
        $user = Auth::user();
        $result = Testimonial::orderBy('created_at', 'DESC');

        $aColumns = ['id', 'content', 'created_at'];

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
            $content = $aRow->content;

            $action = "<span class=\"dropdown\">
                          <button id=\"btnSearchDrop2\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                          aria-expanded=\"false\" class=\"btn btn-info btn-sm dropdown-toggle\"><i class=\"la la-cog font-medium-1\"></i></button>
                          <span aria-labelledby=\"btnSearchDrop2\" class=\"dropdown-menu mt-1 dropdown-menu-right\">
                            <a href=\"testimonials/{$aRow->id}/edit\" class=\"dropdown-item font-small-3\"><i class=\"la la-barcode font-small-3\"></i> edit</a>
                            <a href=\"#\" onClick=\"deleteTestimonial({$aRow->id})\"  class=\"dropdown-item font-small-3\"><i class=\"la la-repeat font-small-3\"></i> delete</a>
                          </span>
                        </span>
                        ";

            $output['aaData'][] = array(
                "DT_RowId" => "row_{$aRow->id}",
                @$content,
                @$action,
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
        $testimonial = Testimonial::findOrFail($id);

        $imagePath = public_path('uploads');
        $imageFileName = $testimonial->image; // Assuming the image file name is stored in the 'image' column
        if ($imageFileName && file_exists($imagePath . '/' . $imageFileName)) {
            unlink($imagePath . '/' . $imageFileName);
        }

        // Delete the testimonial
        $testimonial->delete();

        return redirect()->route('testimonials.index')
            ->with('success', 'Your testimonial deleted successfully');

    }
}
