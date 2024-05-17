<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\CalculatedResultMail;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        
        // return "ali";
        // return $request->all();
        $data = [
            'currency' => json_decode(decrypt($request->currency), true),
            'show_detail' => json_decode(decrypt($request->show_detail), true),
            'hotelBookingResults' => json_decode(decrypt($request->hotelBookingResults), true),
            'MadinahhotelBookingResults' => json_decode(decrypt($request->MadinahhotelBookingResults), true),
            'JeddahhotelBookingResults' => json_decode(decrypt($request->JeddahhotelBookingResults), true),
            'sar_to_pkr' => json_decode(decrypt($request->sar_to_pkr), true),
            'sar_to_usd' => json_decode(decrypt($request->sar_to_usd), true),
            'email' => json_decode(decrypt($request->email), true),
            'contact' => json_decode(decrypt($request->contact), true),
            'RoutesData' => json_decode(decrypt($request->RoutesData), true),
            'grandtotal' => json_decode(decrypt($request->grandtotal), true),
        ];

        // generating incoice id
        $timestamp = now()->format('YmdHis');
        $random = substr(str_shuffle('0123456789'), 0, 8); 
        $invoice_number = "{$timestamp}{$random}";

        $data['unique_invoice'] = $invoice_number;
        // dd($data);
        try {
            // Generate the PDF
            $pdf = PDF::loadView('pdf.pdfDocument', $data);
            $pdfPath = public_path('calculations/' . $invoice_number . '.pdf');
            $pdf->save($pdfPath);

            // Prepare the email
            $mail = new CalculatedResultMail($data);
            $mail->from('example@gmail.com', 'Hajj & Ummrah');

            // Attach the PDF to the email
            $mail->attach($pdfPath, [
                'as' => 'document.pdf',
                'mime' => 'application/pdf',
            ]);

            // Send the email
            Mail::to('fastlinetourss.pk@gmail.com')->send($mail);
            \File::delete($pdfPath);

            
            try {
                $pdf = \PDF::loadView('pdf.pdfDocument', $data);
                return $pdf->download('document.pdf');
            } catch (\Exception $e) {
                \Log::error("Error generating PDF: " . $e->getMessage());
                return back()->withErrors('Error generating PDF: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            \Log::error("Error handling PDF or sending email: " . $e->getMessage());
            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }
}
