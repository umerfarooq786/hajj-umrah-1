<?php

namespace App\Http\Controllers;

use App\Models\CurrencyConversion;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Room;
use App\Models\Route;
use App\Models\Transport;
use App\Models\Visa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CostController extends Controller
{

    public function calculate_package()
    {
        $rooms = Room::all();
        $routes = Route::all();
        $makkah_hotels = Hotel::where('city', 'makkah')->where('display', '1')->get();
        $madina_hotels = Hotel::where('city', 'madina')->where('display', '1')->get();
        $transport_types = Transport::with('transportType')->get();

        return view("website.custom-package.index", compact('rooms', 'madina_hotels', 'makkah_hotels', 'routes', 'transport_types'));
    }

    public function calculate_package_result()
    {
        return view("website.custom-package.result");
    }

    public function calculate(Request $request)
    {
        // dd($request->all());
        $no_of_persons = $request->no_of_persons;
        $makkah_id = $request->makkah_hotel;
        $makkah_hotel_room_type_id = $request->makkah_hotel_room_type;
        $makkah_hotel_start_date = $request->makkah_hotel_start_date;
        $makkah_hotel_end_date = $request->makkah_hotel_end_date;

        $madinah_id = $request->madinah_hotel;
        $madinah_hotel_room_type_id = $request->madinah_hotel_room_type;
        $madinah_hotel_start_date = $request->madinah_hotel_start_date;
        $madinah_hotel_end_date = $request->madinah_hotel_end_date;

        $route_id = $request->route;
        $vehicle_id = $request->vehicle;
        $travel_date = $request->travel_date;

        $visa = $request->visa;

        $makkah_hotel_room_price = 0;
        $madinah_hotel_room_price = 0;
        $makkah_hotel_room_perday_price = 0;
        $madinah_hotel_room_perday_price = 0;

        if (($makkah_id || $madinah_id) && $route_id && $visa) {
            if ($makkah_id) {
                $hotelRoom = HotelRoom::where('hotel_id', $makkah_id)->where('room_id', $makkah_hotel_room_type_id)->get();

                $validityFound = 0;
                foreach ($hotelRoom as $hotelRooms) {
                    $startDate = Carbon::parse($makkah_hotel_start_date);
                    $endDate = Carbon::parse($makkah_hotel_end_date);
                    $validityDate = Carbon::parse($hotelRooms->validity);
                    if ($validityDate->between($startDate, $endDate)) {
                        $daysDifference = $startDate->diffInDays($endDate);
                        $makkah_hotel_room_price = $hotelRooms->weekdays_price * $daysDifference;
                        $makkah_hotel_room_perday_price = $hotelRooms->weekdays_price;
                        $validityFound = 1;
                    }
                }
                if ($validityFound == 1) {
                } else {
                    $errorMessage = "Sorry, No makkah hotel room available between the selected start and end dates.";
                    return back()->withErrors([$errorMessage]);
                }
            } 
            if ($madinah_id) {
                $hotelRoom = HotelRoom::where('hotel_id', $madinah_id)->where('room_id', $madinah_hotel_room_type_id)->get();

                $startDate = Carbon::parse($madinah_hotel_start_date);
                $endDate = Carbon::parse($madinah_hotel_end_date);
                $Madinah_validityFound = 0;
                foreach ($hotelRoom as $hotelRooms) {
                    $validityDate = Carbon::parse($hotelRooms->validity);
                    if ($validityDate->between($startDate, $endDate)) {
                        $daysDifference = $startDate->diffInDays($endDate);
                        $madinah_hotel_room_price = $hotelRooms->weekdays_price * $daysDifference;
                        $madinah_hotel_room_perday_price = $hotelRooms->weekdays_price;
                        $Madinah_validityFound = 1;
                    }
                }

                if ($Madinah_validityFound == 1) {
                    
                } else {
                    $errorMessage = "Sorry, No madinah hotel room available between the selected start and end dates.";
                    return back()->withErrors([$errorMessage]);
                }
            }

            $routes = $request->input('route');
            $vehicles = $request->input('vehicle');
            $travel_dates = $request->input('travel_date');
            $transport_cost = 0;
            $transport_cost = 0;
            foreach ($routes as $key => $route) {
                $routeName = Route::where('id', $routes[$key])->pluck('name');
                $routeName = $routeName[0];
                $transports = Transport::where('route_id', $routes[$key])
                    ->where('transport_type_id', $vehicles[$key])
                    ->get();

                if ($transports->isNotEmpty()) {
                    foreach ($transports as $transport) {
                        $cost = $transport->costs()
                            ->where('validity', '>=', $travel_dates[$key])
                            ->orderByRaw('ABS(DATEDIFF(validity, ?))', [$travel_dates[$key]])
                            ->first();

                        if ($cost) {
                            // Assign the transport cost and break the loop
                            $transport_cost = $cost->cost;
                            $transport_cost = $transport_cost + $transport_cost;
                            break;
                        }
                    }

                    if (!isset($transport_cost)) {

                        $errorMessage = "Sorry, No Transport ( {{$routeName}} ) available between the given date.";
                        return back()->withErrors([$errorMessage]);
                    }
                } else {
                    $errorMessage = "Sorry, No Transport ( {$routeName} ) available between the given date.";
                    return back()->withErrors([$errorMessage]);
                }
            }
            $visaCharges = Visa::where('id', '1')->get();
            foreach ($visaCharges as $visaCharge) {
                $hajj_charges = $visaCharge->hajj_charges;
                $umrah_charges = $visaCharge->umrah_charges;
            }

            $visa = ($visa == 'umrah') ? $umrah_charges : (($visa == 'hajj') ? $hajj_charges : null);
            $visa_per_person = $visa;
            $visa = $visa * $no_of_persons;

            $total_cost = $madinah_hotel_room_price + $makkah_hotel_room_price + $transport_cost + $visa;
            $CurrencyConversion = CurrencyConversion::all();
            foreach ($CurrencyConversion as $CurrencyConversions) {
                $sar_to_pkr = $CurrencyConversions->sar_to_pkr;
                $sar_to_usd = $CurrencyConversions->sar_to_usd;
            }
        } else {
            $errorMessage = "Please select options to get calculated value.";
            return back()->withErrors([$errorMessage]);
        }
        return view('website.custom-package.result', compact('total_cost', 'sar_to_pkr', 'sar_to_usd', 'makkah_hotel_room_perday_price', 'madinah_hotel_room_perday_price' , 'makkah_hotel_room_price', 'madinah_hotel_room_price', 'transport_cost', 'visa', 'visa_per_person'));
    }

    public function hotel_room_type(Request $request)
    {

        $selectedValue = $request->input('selectedValue');

        $hotelRooms = HotelRoom::where('hotel_id', $selectedValue)
            ->distinct('room_id')
            ->get(['room_id']);
        // Iterate through the hotel rooms and retrieve the room names
        $roomNames = [];
        foreach ($hotelRooms as $hotelRoom) {
            // Access the room name through the relationship
            $roomName = $hotelRoom->room;
            $roomNames[] = $roomName;
        }

        // Return the response with the data
        return response()->json(['data' => $roomNames]);

    }
}
