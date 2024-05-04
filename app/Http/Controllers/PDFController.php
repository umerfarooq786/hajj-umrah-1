<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Log;

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

        // generating incoice id
        $timestamp = now()->format('YmdHis');
        $random = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $invoice_number = "INV-{$timestamp}-{$random}";
        
        $data['unique_invoice'] = $invoice_number;

        

        // return view('pdf.pdfDocument', $data);
        try {
            $pdf = \PDF::loadView('pdf.pdfDocument', $data);
            return $pdf->download('document.pdf');
        } catch (\Exception $e) {
            \Log::error("Error generating PDF: " . $e->getMessage());
            return back()->withErrors('Error generating PDF: ' . $e->getMessage());
        }
    }
}
