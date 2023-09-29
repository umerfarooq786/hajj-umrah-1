<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $rules = [
            'name' => 'required',
            'google_map' => 'required',
            'weekend_price' => 'required|array|min:1',
            'weekend_price' => 'required|array|min:1',
            'city' => 'required',
            'validity' => 'required|date',
            'room_id' => 'required||array|min:1'
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $hotel = new Hotel();

        $hotel->name = $request->name;
        $hotel->google_map = $request->google_map;
        $hotel->city = $request->city;
        $hotel->validity = $request->validity;
        
        $hotel->save();

        $roomIds = $request->room_id;
        $weekdaysPrices = $request->weekdays_price;
        $weekendPrices = $request->weekend_price;   

        for ($i = 0; $i < count($roomIds); $i++)
        {
            DB::table('hotel_rooms')->insert([
                'hotel_id' => $hotel->id,
                'room_id' => $roomIds[$i], 
                'weekdays_price' => $weekdaysPrices[$i],
                'weekend_price' => $weekendPrices[$i]
            ]);
        }

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
    public function edit(Hotel $hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        //
    }
}
