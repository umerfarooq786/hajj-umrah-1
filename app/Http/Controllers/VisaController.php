<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visa;
use App\Models\CurrencyConversion;


class VisaController extends Controller
{
    public function visa_charges()
    {
        $visa = Visa::first();
        return view('admin.visa.charges', compact('visa'));
    }
    public function update_visa_charges(Request $request)
    {
        $current_currency = CurrencyConversion::first();
        $visa = Visa::find($request->id);

        $visa->hajj_charges = $request->hajj_charges;
        $visa->umrah_charges = $request->umrah_charges;
        $visa->show_hajj = $request->show_hajj ?? 0;
        $visa->current_currency = $current_currency->default_currency;

        $visa->save();
        return redirect()->route('admin.visa_charges')->with('success', 'Visa Charges has been updated successfully!');
    }
}
