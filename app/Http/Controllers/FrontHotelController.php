<?php

namespace App\Http\Controllers;

use App\Models\CurrencyConversion;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Image;
use App\Models\Vehicle;
use App\Models\Weekend;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FrontHotelController extends Controller
{
    public function index($city)
    {
        $hotels = Hotel::where('city', $city)->where('display', '1')->paginate(10);
        return view('website.hotels.index', ['hotels' => $hotels]);
    }

    public function singleHotel($id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel_images = Image::where('hotel_id', $hotel->id)->get();

        $hotel_rooms = DB::table('hotel_rooms')
            ->join('rooms', 'rooms.id', '=', 'hotel_rooms.room_id')
            ->join('hotels', 'hotels.id', '=', 'hotel_rooms.hotel_id')
            ->select('hotel_rooms.*', 'rooms.id as room_id', 'rooms.name as room_name')
            ->where('hotel_rooms.hotel_id', $hotel->id)
            ->where('hotels.displayPrice', '1')
            ->orderBy('hotel_rooms.validity_start')
            ->orderBy('rooms.id')
            ->get();


        $meals = DB::table('meals')
            ->join('meal_types', 'meal_types.id', '=', 'meals.meal_type_id')
            ->join('hotels', 'hotels.id', '=', 'meals.hotel_id')
            ->select('meals.*', 'meal_types.id as meal_id', 'meal_types.name as name')
            ->where('meals.hotel_id', $hotel->id)
            ->where('hotels.displayPrice', '1')
            ->orderBy('meal_types.id')
            ->get();

        $CurrencyConversion = CurrencyConversion::all();
        foreach ($CurrencyConversion as $CurrencyConversions) {
            $sar_to_pkr = $CurrencyConversions->sar_to_pkr;
            $sar_to_usd = $CurrencyConversions->sar_to_usd;
        }
        // dd($meals);
        return view('website.hotelDetail.index', [
            'hotel' => $hotel,
            'hotel_images' => $hotel_images,
            'hotel_rooms' => $hotel_rooms,
            'meals' => $meals,
            'sar_to_pkr' => $sar_to_pkr,
            'sar_to_usd' => $sar_to_usd
        ]);
    }

    public function searchMakkahRoom(Request $request)
    {
        // Process form data and perform search
        // For example, you can retrieve input values like this:
        $makkah_id = $request->input('hotel_id');
        $makkah_hotel_start_date = $request->input('makkah_hotel_start_date');
        $makkah_hotel_end_date = $request->input('makkah_hotel_end_date');
        $roomType = $request->input('makkah_hotel_room_type');
        $total_hotel_cost = 0;
        if ($makkah_id) {
            $mealsName = '';
            $hotelRoom = HotelRoom::with('room')  // Eager load the 'room' relationship
                ->where('hotel_id', $makkah_id)
                ->where('room_id', $roomType)
                ->get();

            $hotelName = Hotel::findOrFail($makkah_id);
            $commision = $hotelName->commision;
            $hotelName = $hotelName->name;

            $uncoveredDates = [];
            $startDate = Carbon::parse($makkah_hotel_start_date);
            $endDate = Carbon::parse($makkah_hotel_end_date);

            // To find dates which is not applicable or comming in validities
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $dateString = $date->toDateString();
                $dateIsCovered = false;
                // Check if the current date falls within any validity period
                foreach ($hotelRoom as $hotelRooms) {
                    $validityStartDate = Carbon::parse($hotelRooms->validity_start);
                    $validityEndDate = Carbon::parse($hotelRooms->validity_end);

                    if ($date->between($validityStartDate, $validityEndDate)) {
                        $dateIsCovered = true;
                        break;
                    }
                }
                // If the date is not covered by any validity period, add it to the uncovered dates array
                if (!$dateIsCovered) {
                    $uncoveredDates[] = $dateString;
                }
            }

            if (count($uncoveredDates) == 0) {
                foreach ($hotelRoom as $hotelRooms) {

                    $validityStartDate = Carbon::parse($hotelRooms->validity_start);
                    $validityEndDate = Carbon::parse($hotelRooms->validity_end);
                    $makkahRoom = $hotelRooms->room->name;
                    if ($validityStartDate < $endDate && $validityEndDate > $startDate) {
                        $intersectionStart = max($startDate, $validityStartDate);
                        $intersectionEnd = min($endDate, $validityEndDate);
                        if ($intersectionEnd < $endDate) {
                            $intersectionDays = $intersectionStart->diffInDays($intersectionEnd) + 1;
                        } else {
                            $intersectionDays = $intersectionStart->diffInDays($intersectionEnd);
                        }
                        // $MakkahdaysDifference += $intersectionDays;
                        $weekends = Weekend::first();
                        $weekends = $weekends['name'];
                        $nameArray = json_decode($weekends);
                        $day1 = $day2 = $day3 = $day4 = $day5 = $day6 = $day7 = null;

                        foreach ($nameArray as $index => $day) {
                            ${'day' . ($index + 1)} = $day;
                        }

                        $weekenDaysCunt = 0;

                        if ($endDate != $validityEndDate && $endDate >= $validityEndDate) {
                            $intersectionEnd->addDay();
                        }
                        for ($i = 1; $i <= 7; $i++) {
                            $day = ${'day' . $i};
                            if (!is_null($day)) {
                                $day = strtolower($day);
                                $numDays = $intersectionStart->diffInDaysFiltered(function (Carbon $date) use ($day) {
                                    return $date->isDayOfWeek($day);
                                }, $intersectionEnd);
                                $weekenDaysCunt += $numDays;
                            }
                        }
                        $weekdays = $intersectionDays - $weekenDaysCunt;
                        $weekendDays = $weekenDaysCunt;
                        $makkah_hotel_room_price_weekdays = $hotelRooms->weekdays_price * $weekdays;
                        $makkah_hotel_room_price_weekendDays = $hotelRooms->weekend_price * $weekendDays;
                        $makkah_hotel_room_price = $makkah_hotel_room_price_weekdays + $makkah_hotel_room_price_weekendDays;
                        $commissionAmount = ($commision / 100) * $makkah_hotel_room_price;
                        $makkah_hotel_room_price = $makkah_hotel_room_price + $commissionAmount;
                        $total_hotel_cost += $makkah_hotel_room_price;

                        $CurrencyConversion = CurrencyConversion::all();
                        foreach ($CurrencyConversion as $CurrencyConversions) {
                            $sar_to_pkr = $CurrencyConversions->sar_to_pkr;
                            $sar_to_usd = $CurrencyConversions->sar_to_usd;
                        }
                    }
                }
            } else {
                $firstDate = Carbon::createFromFormat('Y-m-d', reset($uncoveredDates))->format('d F Y');
                $lastDate = Carbon::createFromFormat('Y-m-d', end($uncoveredDates))->format('d F Y');
                $errorMessage = "Sorry, No makkah hotel room available from $firstDate to $lastDate.";
                return response()->json(['result' => $errorMessage]);
            }
        }

        return response()->json([
            'price' => $total_hotel_cost,
            'sar_to_pkr' => $sar_to_pkr,
            'sar_to_usd' => $sar_to_usd
        ]);
    }
    
    public function searchMadinahRoom(Request $request)
    {
        // Process form data and perform search
        // For example, you can retrieve input values like this:
        $madinah_id = $request->input('hotel_id');
        $madinah_hotel_start_date = $request->input('madinah_hotel_start_date');
        $madinah_hotel_end_date = $request->input('madinah_hotel_end_date');
        $roomType = $request->input('madinah_hotel_room_type');
        $total_hotel_cost = 0;
        if ($madinah_id) {
            $mealsName = '';
            $hotelRoom = HotelRoom::with('room')  // Eager load the 'room' relationship
                ->where('hotel_id', $madinah_id)
                ->where('room_id', $roomType)
                ->get();

            $hotelName = Hotel::findOrFail($madinah_id);
            $commision = $hotelName->commision;
            $hotelName = $hotelName->name;

            $uncoveredDates = [];
            $startDate = Carbon::parse($madinah_hotel_start_date);
            $endDate = Carbon::parse($madinah_hotel_end_date);

            // To find dates which is not applicable or comming in validities
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $dateString = $date->toDateString();
                $dateIsCovered = false;
                // Check if the current date falls within any validity period
                foreach ($hotelRoom as $hotelRooms) {
                    $validityStartDate = Carbon::parse($hotelRooms->validity_start);
                    $validityEndDate = Carbon::parse($hotelRooms->validity_end);

                    if ($date->between($validityStartDate, $validityEndDate)) {
                        $dateIsCovered = true;
                        break;
                    }
                }
                // If the date is not covered by any validity period, add it to the uncovered dates array
                if (!$dateIsCovered) {
                    $uncoveredDates[] = $dateString;
                }
            }

            if (count($uncoveredDates) == 0) {
                foreach ($hotelRoom as $hotelRooms) {

                    $validityStartDate = Carbon::parse($hotelRooms->validity_start);
                    $validityEndDate = Carbon::parse($hotelRooms->validity_end);
                    $madinahRoom = $hotelRooms->room->name;
                    if ($validityStartDate < $endDate && $validityEndDate > $startDate) {
                        $intersectionStart = max($startDate, $validityStartDate);
                        $intersectionEnd = min($endDate, $validityEndDate);
                        if ($intersectionEnd < $endDate) {
                            $intersectionDays = $intersectionStart->diffInDays($intersectionEnd) + 1;
                        } else {
                            $intersectionDays = $intersectionStart->diffInDays($intersectionEnd);
                        }
                        // $madinahdaysDifference += $intersectionDays;
                        $weekends = Weekend::first();
                        $weekends = $weekends['name'];
                        $nameArray = json_decode($weekends);
                        $day1 = $day2 = $day3 = $day4 = $day5 = $day6 = $day7 = null;

                        foreach ($nameArray as $index => $day) {
                            ${'day' . ($index + 1)} = $day;
                        }

                        $weekenDaysCunt = 0;

                        if ($endDate != $validityEndDate && $endDate >= $validityEndDate) {
                            $intersectionEnd->addDay();
                        }
                        for ($i = 1; $i <= 7; $i++) {
                            $day = ${'day' . $i};
                            if (!is_null($day)) {
                                $day = strtolower($day);
                                $numDays = $intersectionStart->diffInDaysFiltered(function (Carbon $date) use ($day) {
                                    return $date->isDayOfWeek($day);
                                }, $intersectionEnd);
                                $weekenDaysCunt += $numDays;
                            }
                        }
                        $weekdays = $intersectionDays - $weekenDaysCunt;
                        $weekendDays = $weekenDaysCunt;
                        $madinah_hotel_room_price_weekdays = $hotelRooms->weekdays_price * $weekdays;
                        $madinah_hotel_room_price_weekendDays = $hotelRooms->weekend_price * $weekendDays;
                        $madinah_hotel_room_price = $madinah_hotel_room_price_weekdays + $madinah_hotel_room_price_weekendDays;
                        $commissionAmount = ($commision / 100) * $madinah_hotel_room_price;
                        $madinah_hotel_room_price = $madinah_hotel_room_price + $commissionAmount;
                        $total_hotel_cost += $madinah_hotel_room_price;

                        $CurrencyConversion = CurrencyConversion::all();
                        foreach ($CurrencyConversion as $CurrencyConversions) {
                            $sar_to_pkr = $CurrencyConversions->sar_to_pkr;
                            $sar_to_usd = $CurrencyConversions->sar_to_usd;
                        }
                    }
                }
            } else {
                $firstDate = Carbon::createFromFormat('Y-m-d', reset($uncoveredDates))->format('d F Y');
                $lastDate = Carbon::createFromFormat('Y-m-d', end($uncoveredDates))->format('d F Y');
                $errorMessage = "Sorry, No Madinah hotel room available from $firstDate to $lastDate.";
                return response()->json(['result' => $errorMessage]);
            }
        }

        return response()->json([
            'price' => $total_hotel_cost,
            'sar_to_pkr' => $sar_to_pkr,
            'sar_to_usd' => $sar_to_usd
        ]);
    }
    
    public function searchJeddahRoom(Request $request)
    {
        // Process form data and perform search
        // For example, you can retrieve input values like this:
        $jeddah_id = $request->input('hotel_id');
        $jeddah_hotel_start_date = $request->input('jeddah_hotel_start_date');
        $jeddah_hotel_end_date = $request->input('jeddah_hotel_end_date');
        $roomType = $request->input('jeddah_hotel_room_type');
        $total_hotel_cost = 0;
        if ($jeddah_id) {
            $mealsName = '';
            $hotelRoom = HotelRoom::with('room')  // Eager load the 'room' relationship
                ->where('hotel_id', $jeddah_id)
                ->where('room_id', $roomType)
                ->get();

            $hotelName = Hotel::findOrFail($jeddah_id);
            $commision = $hotelName->commision;
            $hotelName = $hotelName->name;

            $uncoveredDates = [];
            $startDate = Carbon::parse($jeddah_hotel_start_date);
            $endDate = Carbon::parse($jeddah_hotel_end_date);

            // To find dates which is not applicable or comming in validities
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $dateString = $date->toDateString();
                $dateIsCovered = false;
                // Check if the current date falls within any validity period
                foreach ($hotelRoom as $hotelRooms) {
                    $validityStartDate = Carbon::parse($hotelRooms->validity_start);
                    $validityEndDate = Carbon::parse($hotelRooms->validity_end);

                    if ($date->between($validityStartDate, $validityEndDate)) {
                        $dateIsCovered = true;
                        break;
                    }
                }
                // If the date is not covered by any validity period, add it to the uncovered dates array
                if (!$dateIsCovered) {
                    $uncoveredDates[] = $dateString;
                }
            }

            if (count($uncoveredDates) == 0) {
                foreach ($hotelRoom as $hotelRooms) {

                    $validityStartDate = Carbon::parse($hotelRooms->validity_start);
                    $validityEndDate = Carbon::parse($hotelRooms->validity_end);
                    $jeddahRoom = $hotelRooms->room->name;
                    if ($validityStartDate < $endDate && $validityEndDate > $startDate) {
                        $intersectionStart = max($startDate, $validityStartDate);
                        $intersectionEnd = min($endDate, $validityEndDate);
                        if ($intersectionEnd < $endDate) {
                            $intersectionDays = $intersectionStart->diffInDays($intersectionEnd) + 1;
                        } else {
                            $intersectionDays = $intersectionStart->diffInDays($intersectionEnd);
                        }
                        // $jeddahdaysDifference += $intersectionDays;
                        $weekends = Weekend::first();
                        $weekends = $weekends['name'];
                        $nameArray = json_decode($weekends);
                        $day1 = $day2 = $day3 = $day4 = $day5 = $day6 = $day7 = null;

                        foreach ($nameArray as $index => $day) {
                            ${'day' . ($index + 1)} = $day;
                        }

                        $weekenDaysCunt = 0;

                        if ($endDate != $validityEndDate && $endDate >= $validityEndDate) {
                            $intersectionEnd->addDay();
                        }
                        for ($i = 1; $i <= 7; $i++) {
                            $day = ${'day' . $i};
                            if (!is_null($day)) {
                                $day = strtolower($day);
                                $numDays = $intersectionStart->diffInDaysFiltered(function (Carbon $date) use ($day) {
                                    return $date->isDayOfWeek($day);
                                }, $intersectionEnd);
                                $weekenDaysCunt += $numDays;
                            }
                        }
                        $weekdays = $intersectionDays - $weekenDaysCunt;
                        $weekendDays = $weekenDaysCunt;
                        $jeddah_hotel_room_price_weekdays = $hotelRooms->weekdays_price * $weekdays;
                        $jeddah_hotel_room_price_weekendDays = $hotelRooms->weekend_price * $weekendDays;
                        $jeddah_hotel_room_price = $jeddah_hotel_room_price_weekdays + $jeddah_hotel_room_price_weekendDays;
                        $commissionAmount = ($commision / 100) * $jeddah_hotel_room_price;
                        $jeddah_hotel_room_price = $jeddah_hotel_room_price + $commissionAmount;
                        $total_hotel_cost += $jeddah_hotel_room_price;

                        $CurrencyConversion = CurrencyConversion::all();
                        foreach ($CurrencyConversion as $CurrencyConversions) {
                            $sar_to_pkr = $CurrencyConversions->sar_to_pkr;
                            $sar_to_usd = $CurrencyConversions->sar_to_usd;
                        }
                    }
                }
            } else {
                $firstDate = Carbon::createFromFormat('Y-m-d', reset($uncoveredDates))->format('d F Y');
                $lastDate = Carbon::createFromFormat('Y-m-d', end($uncoveredDates))->format('d F Y');
                $errorMessage = "Sorry, No Jeddah hotel room available from $firstDate to $lastDate.";
                return response()->json(['result' => $errorMessage]);
            }
        }

        return response()->json([
            'price' => $total_hotel_cost,
            'sar_to_pkr' => $sar_to_pkr,
            'sar_to_usd' => $sar_to_usd
        ]);
    }

    public function transportation()
    {
        $vehicles = Vehicle::with('images', 'transport.route', 'transport.costs')->get();
        // dd($vehicles);
        return view('website.transportation.index', ['vehicles' => $vehicles]);
    }

    public function singleTransportation($id)
    {
        $vehicle = Vehicle::with(['images', 'transport.route', 'transport.costs'])
            ->where('id', $id)
            ->firstOrFail();
        $CurrencyConversion = CurrencyConversion::all();
        foreach ($CurrencyConversion as $CurrencyConversions) {
            $sar_to_pkr = $CurrencyConversions->sar_to_pkr;
            $sar_to_usd = $CurrencyConversions->sar_to_usd;
        }
        // dd($vehicles);
        return view('website.transportation.detail', [
            'vehicle' => $vehicle,
            'sar_to_pkr' => $sar_to_pkr,
            'sar_to_usd' => $sar_to_usd
        ]);
    }

    public function predefinedUmrah(Request $request)
    {
        $packages = Package::where('type', 'umrah')->get();
        return view('website.predefined-package.index', ['packages' => $packages]);
    }

    public function predefinedHajj(Request $request)
    {
        $packages = Package::where('type', 'hajj')->get();
        return view('website.predefined-package.index', ['packages' => $packages]);
    }
}
