<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontHotelController extends Controller
{
    public function index()
    {
        return view('website.hotels.index');
    }

    public function singleHotel()
    {
        // return 'ali';
        return view('website.hotelDetail.index');
    }
}
