<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {   
        // return $request->all();
        $data = [
            'total_cost'=>$request->total_cost, 
            'makkah_hotel_room_price'=>$request->makkah_hotel_room_price, 
            'makkah_hotel_room_perday_price'=>$request->makkah_hotel_room_perday_price, 
            'madinah_hotel_room_price'=>$request->madinah_hotel_room_price, 
            'madinah_hotel_room_perday_price'=>$request->madinah_hotel_room_perday_price, 
            'mealPrices'=>$request->mealPrices, 
            'transport_cost'=>$request->transport_cost, 
            'visa'=>$request->visa, 
            'visa_per_person'=>$request->visa_per_person,             
        ];
        
        // return view('pdf.pdfDocument', $data);
        $pdf = PDF::loadView('pdf.pdfDocument', $data);
        return $pdf->download('document.pdf');
    }
}
