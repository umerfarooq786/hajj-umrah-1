<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class FrontHotelController extends Controller
{
    public function index($city)
    {
        $hotels = Hotel::where('city', $city)->where('display', '1')->paginate(10);
        return view('website.hotels.index', ['hotels' => $hotels]);
    }

    public function singleHotel($id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel_images = Image::where('hotel_id', $hotel->id)->get();

        $hotel_rooms = DB::table('hotel_rooms')
            ->join('rooms', 'rooms.id', '=', 'hotel_rooms.room_id')
            ->join('hotels', 'hotels.id', '=', 'hotel_rooms.hotel_id')
            ->select('hotel_rooms.*', 'rooms.id as room_id', 'rooms.name as room_name')
            ->where('hotel_rooms.hotel_id', $hotel->id)
            ->where('hotels.displayPrice', '1') 
            ->orderBy('hotel_rooms.validity_start')
            ->orderBy('rooms.id')
            ->get();


        $meals = DB::table('meals')
            ->join('meal_types', 'meal_types.id', '=', 'meals.meal_type_id')
            ->join('hotels', 'hotels.id', '=', 'meals.hotel_id')
            ->select('meals.*', 'meal_types.id as meal_id', 'meal_types.name as name')
            ->where('meals.hotel_id', $hotel->id)
            ->where('hotels.displayPrice', '1') 
            ->orderBy('meal_types.id')
            ->get();
        // dd($meals);
        return view('website.hotelDetail.index', [
            'hotel' => $hotel,
            'hotel_images' => $hotel_images,
            'hotel_rooms' => $hotel_rooms,
            'meals' => $meals
        ]);
    }

    public function transportation()
    {
        $vehicles = Vehicle::with('transport.route','transport.costs')->get();
        // dd($vehicles);
        return view('website.transportation.index', ['vehicles' => $vehicles]);
    }

    public function singleTransportation($id)
    {
        $vehicle = Vehicle::with(['transport.route', 'transport.costs'])
        ->where('id', $id)
        ->firstOrFail();
        // dd($vehicles);
        return view('website.transportation.detail', ['vehicle' => $vehicle]);
    }

    public function predefinedUmrah(Request $request)
    {
        $packages = Package::where('type', 'umrah')->get();
        return view('website.predefined-package.index', ['packages' => $packages]);
    }

    public function predefinedHajj(Request $request)
    {
        $packages = Package::where('type', 'hajj')->get();
        return view('website.predefined-package.index', ['packages' => $packages]);
    }
}
