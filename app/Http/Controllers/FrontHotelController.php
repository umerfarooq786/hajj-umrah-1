<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontHotelController extends Controller
{
    public function index($city)
    {
        // $hotels = Hotel::where('city', $city)->get();
        return $city;
        return view('website.hotels.index');
    }

    public function singleHotel()
    {
        // return 'ali';
        return view('website.hotelDetail.index');
    }
}
