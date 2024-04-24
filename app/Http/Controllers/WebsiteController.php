<?php

namespace App\Http\Controllers;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function homepage(){
        $package = Package::all();
        $testimonial = Testimonial::all();
        return view('website.home.index' , compact('package', 'testimonial'));
    }
    
    public function vehicle(){
        $vehicle =Vehicle::with('transport.route', 'transport.costs')->get();
        // dd($vehicle);
        return view('website.vehicle.index' , compact('vehicle'));
    }
    
    public function contact(){
        return view('website.contact.index');
    }

    public function airlines(){
        return view('website.contact.airlines');
    }    
}
