<?php

namespace App\Http\Controllers;
use App\Models\Package;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function homepage(){
        $package = Package::all();
        return view('website.home.index' , compact('package'));
    }
}
