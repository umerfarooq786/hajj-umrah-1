<?php

namespace App\Http\Controllers;
use App\Models\Package;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function homepage(){
        $package = Package::all();
        $testimonial = Testimonial::all();
        return view('website.home.index' , compact('package', 'testimonial'));
    }
    
    public function contact(){
        return view('website.contact.index');
    }

    public function airlines(){
        return view('website.contact.airlines');
    }    
}
