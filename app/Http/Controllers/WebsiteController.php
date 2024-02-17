<?php

namespace App\Http\Controllers;
use App\Models\Package;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function homepage(){
        $package = Package::all();
        $testimonial = Testimonial::with('user')->get();
        return view('website.home.index' , compact('package', 'testimonial'));
    }
    
    public function contact(){
        return view('website.contact.index');
    }
}
