<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Route;
use App\Models\TransportType;

class CostController extends Controller
{
    
    public function calculate_package(){
        $rooms = Room::all();
        $routes = Route::all();
        $transport_types = TransportType::all();

        return view("website.custom-package.index", compact('rooms','routes','transport_types'));
    }

    public function calculate_package_result(){
        
        return view("website.custom-package.result");
    }
}
