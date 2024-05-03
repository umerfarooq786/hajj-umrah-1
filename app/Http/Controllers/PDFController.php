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
            'show_detail'=> json_decode($request->show_detail), 
            'hotelBookingResults'=>json_decode(decrypt($request->hotelBookingResults), true),

            'MadinahhotelBookingResults'=>json_decode($request->MadinahhotelBookingResults), 
            'JeddahhotelBookingResults'=>json_decode($request->JeddahhotelBookingResults), 
            'RoutesData'=>json_decode($request->RoutesData), 
            'grandtotal'=>json_decode($request->grandtotal),             
        ];
        return view('pdf.pdfDocument', $data);
        // $pdf = PDF::loadView('pdf.pdfDocument', $data);
        // return $pdf->download('document.pdf');
    }
}
