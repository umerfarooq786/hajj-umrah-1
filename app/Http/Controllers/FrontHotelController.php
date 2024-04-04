<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Image;

class FrontHotelController extends Controller
{
    public function index($city)
    {
        $hotels = Hotel::where('city', $city)->paginate(10);        
        return view('website.hotels.index', ['hotels' => $hotels]);
    }

    public function singleHotel($id)
    {
        // return 'ali';
        $hotel = Hotel::where('id', $id)->first();        
        $hotel_images = [];
        if($hotel){
            $hotel_images = Image::where('hotel_id', $hotel->id)->get();
        }

        // return $hotel_images;
        return view('website.hotelDetail.index',['hotel'=> $hotel, 'hotel_images' => $hotel_images]);
    }

    public function predefinedUmrah(Request $request){
        $packages = Package::where('type', 'umrah')->get();
        return view('website.predefined-package.index', ['packages'=>$packages]);
    }    

    public function predefinedHajj(Request $request){
        $packages = Package::where('type', 'hajj')->get();
        return view('website.predefined-package.index', ['packages'=>$packages]);
    }    
}
