<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class FrontHotelController extends Controller
{
    public function index($city)
    {
        $hotels = Hotel::where('city', $city)->paginate(10);        
        return view('website.hotels.index', ['hotels' => $hotels]);
    }

    public function singleHotel()
    {
        // return 'ali';
        return view('website.hotelDetail.index');
    }
}
