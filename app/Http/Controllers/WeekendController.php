<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weekend;

class WeekendController extends Controller
{
    public function index()
    {
        $weekdays = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
        $w = Weekend::first();
        $weekend = json_decode($w->name);
        return view('admin.weekend.index', compact('weekend', 'weekdays'));
    }
    public function store(Request $request)
    {
        $isEmpty = (Weekend::count() === 0);

        if ($isEmpty) {
            $weekend = new Weekend();
            $weekend->name =  json_encode($request->weekends);
            $weekend->save();
        } else {
            $weekend = Weekend::first();
            $weekend->name =  json_encode($request->weekends);
            $weekend->save();
        }

        return redirect()->route('weekends.index')->with('success', 'Weekend data has been added successfully!');
    }
}
