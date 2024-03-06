<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Room;
use App\Models\Route;
use App\Models\Transport;
use App\Models\TransportType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CostController extends Controller
{

    public function calculate_package()
    {
        $rooms = Room::all();
        $routes = Route::all();
        $makkah_hotels = Hotel::where('city', 'makkah')->get();
        $madina_hotels = Hotel::where('city', 'madina')->get();
        $transport_types = TransportType::all();

        return view("website.custom-package.index", compact('rooms', 'madina_hotels', 'makkah_hotels', 'routes', 'transport_types'));
    }

    public function calculate_package_result()
    {
        return view("website.custom-package.result");
    }

    public function calculate(Request $request)
    {
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

        if ($makkah_id) {
            $hotelRoom = HotelRoom::where('hotel_id', $makkah_id)->where('room_id', $makkah_hotel_room_type_id)->get();

            foreach ($hotelRoom as $hotelRooms) {
                $startDate = Carbon::parse($makkah_hotel_start_date);
                $endDate = Carbon::parse($makkah_hotel_end_date);
                $validityDate = Carbon::parse($hotelRooms->validity);
            }
            if ($validityDate->between($startDate, $endDate)) {
                $hotel_room_price = $hotelRooms->weekdays_price;
            } else {
                $errorMessage = "Sorry, No hotel room available between the selected start and end dates.";
                return back()->withErrors([$errorMessage]);}
        } elseif ($madinah_id) {
            $hotelRoom = HotelRoom::where('hotel_id', $madinah_id)->where('room_id', $madinah_hotel_room_type_id)->get();

            $startDate = Carbon::parse($madinah_hotel_start_date);
            $endDate = Carbon::parse($madinah_hotel_end_date);
            foreach ($hotelRoom as $hotelRooms) {
                $validityDate = Carbon::parse($hotelRooms->validity);
            }
            if ($validityDate->between($startDate, $endDate)) {
                $daysDifference = $startDate->diffInDays($endDate);
                $hotel_room_price = $hotelRooms->weekdays_price * $daysDifference;
                $hotel_room_perday_price = $hotelRooms->weekdays_price;
            } else {
                $errorMessage = "Sorry, No hotel room available between the selected start and end dates.";
                return back()->withErrors([$errorMessage]);
            }
        }
        $transports = Transport::where('route_id', $route_id)
            ->where('transport_type_id', $vehicle_id)
            ->get();

        if ($transports->isNotEmpty()) {
            foreach ($transports as $transport) {
                $cost = $transport->costs()
                    ->where('validity', '>=', $travel_date)
                    ->orderByRaw('ABS(DATEDIFF(validity, ?))', [$travel_date])
                    ->first();

                if ($cost) {
                    // Assign the transport cost and break the loop
                    $transport_cost = $cost->cost;
                    break;
                }
            }

            if (!isset($transport_cost)) {
                $errorMessage = "Sorry, No Transport available between the given date.";
                return back()->withErrors([$errorMessage]);
            }
        } else {
            $errorMessage = "Sorry, No Transport available between the given date.";
            return back()->withErrors([$errorMessage]);
        }

        $visa = ($visa == 'umrah') ? 2500 : (($visa == 'hajj') ? 3500 : null);

        $total_cost = $hotel_room_price + $transport_cost + $visa;

        return view('website.custom-package.result', compact('total_cost', 'hotel_room_perday_price', 'hotel_room_price', 'transport_cost', 'visa'));
    }
}
