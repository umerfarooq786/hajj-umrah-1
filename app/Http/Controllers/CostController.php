<?php

namespace App\Http\Controllers;

use App\Models\CurrencyConversion;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Maktab;
use App\Models\Meal;
use App\Models\Room;
use App\Models\Route;
use App\Models\Transport;
use App\Models\Vehicle;
use App\Models\Visa;
use App\Models\Weekend;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class CostController extends Controller
{

    public function calculate_package()
    {
        $rooms = Room::all();
        $routes = Route::all();
        $makkah_hotels = Hotel::where('city', 'makkah')->where('display', '1')->get();
        $madina_hotels = Hotel::where('city', 'madinah')->where('display', '1')->get();
        $jeddah_hotels = Hotel::where('city', 'jeddah')->where('display', '1')->get();
        $transport_types = Vehicle::all();
        $mealData = Meal::all();
        return view("website.custom-package.index", compact('rooms', 'madina_hotels', 'makkah_hotels', 'jeddah_hotels', 'routes', 'transport_types', 'mealData'));
    }

    public function calculate_package_hajj()
    {
        $rooms = Room::all();
        $routes = Route::all();
        $makkah_hotels = Hotel::where('city', 'makkah')->where('display', '1')->get();
        $madina_hotels = Hotel::where('city', 'madinah')->where('display', '1')->get();
        $jeddah_hotels = Hotel::where('city', 'jeddah')->where('display', '1')->get();
        $transport_types = Vehicle::all();
        $maktabs = Maktab::all();
        $mealData = Meal::all();
        $showpage = Visa::all();
        return view("website.custom-package.index1", compact('rooms', 'madina_hotels', 'makkah_hotels', 'jeddah_hotels', 'routes', 'transport_types', 'mealData', 'showpage', 'maktabs'));
    }

    public function calculate_package_result()
    {
        return view("website.custom-package.result");
    }

    public function calculate_package_result2()
    {
        return view("website.custom-package.result2");
    }

    public function calculate(Request $request)
    {
        // dd($request->all());
        $no_of_persons = $request->no_of_persons;
        $email = $request->email;
        $contact = $request->contact;
        $makkah_id = $request->makkah_hotel;
        $makkah_hotel_room_type_id = $request->makkah_hotel_room_type;
        $makkah_hotel_start_date = $request->makkah_hotel_start_date;
        $makkah_hotel_end_date = $request->makkah_hotel_end_date;

        $madinah_id = $request->madinah_hotel;
        $madinah_hotel_room_type_id = $request->madinah_hotel_room_type;
        $madinah_hotel_start_date = $request->madinah_hotel_start_date;
        $madinah_hotel_end_date = $request->madinah_hotel_end_date;

        $jeddah_id = $request->jeddah_hotel;
        $jeddah_hotel_room_type_id = $request->jeddah_hotel_room_type;
        $jeddah_hotel_start_date = $request->jeddah_hotel_start_date;
        $jeddah_hotel_end_date = $request->jeddah_hotel_end_date;
        $route_id = $request->route;
        $vehicle_id = $request->vehicle;
        $travel_date = $request->travel_date;

        $makkah_hotel_room_price = 0;
        $madinah_hotel_room_price = 0;
        $jeddah_hotel_room_price = 0;
        $visa = $request->visa;
        $maktab = $request->maktab;
        $transport_cost = 0;
        $MadinahdaysDifference = 0;
        $jeddahdaysDifference = 0;

        $errorMessage = '';

        $total_hotel_cost = 0;
        $total_meal_cost = 0;
        $total_transport_cost = 0;


        $validator = Validator::make($request->all(), [
            'no_of_persons' => 'required|numeric|min:1'
        ], [
            'no_of_persons.required' => 'Sorry, please select the number of persons first.',
            'no_of_persons.numeric' => 'The number of persons must be a number.',
            'no_of_persons.min' => 'The number of persons must be at least 1.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($makkah_id || $madinah_id || $jeddah_id || $route_id) {

            $hotelBookingResults = array();
            if ($makkah_id[0] != NULL) {
                $MealCounter = 0;
                foreach ($request->makkah_hotel as $index => $makkah_id) {
                    $mealPrices = 0;
                    $MealCounter = $index;
                    $makkah_hotel_room_type_id = $request->makkah_hotel_room_type[$index];
                    $makkah_hotel_start_date = $request->makkah_hotel_start_date[$index];
                    $makkah_hotel_end_date = $request->makkah_hotel_end_date[$index];
                    if ($makkah_hotel_room_type_id != NULL && $makkah_hotel_start_date != NULL && $makkah_hotel_end_date != NULL) {
                        if ($makkah_id) {
                            $mealsName = '';

                            $hotelRoom = HotelRoom::with('room')  // Eager load the 'room' relationship
                                ->where('hotel_id', $makkah_id)
                                ->where('room_id', $makkah_hotel_room_type_id)
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
                                $makkah_hotel_room_price_final = 0;
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
                                        $makkah_hotel_room_price_final += $makkah_hotel_room_price;
                                        $total_hotel_cost += $makkah_hotel_room_price;
                                        $makkah_hotel_room_perday_price = $hotelRooms->weekdays_price;
                                        $makkah_hotel_meal_type_id = $request->makkah_hotel_meal_type[$MealCounter];

                                        if ($makkah_hotel_meal_type_id) {
                                            $meal = Meal::with('mealType')
                                                ->where('hotel_id', $makkah_id)
                                                ->where('meal_type_id', $makkah_hotel_meal_type_id)->first();
                                            // dd($meal);
                                            if ($meal) {
                                                $mealsName .= ($mealsName ? ', ' : '') . $meal->mealType->name;
                                                $mealPrices += $meal->price * $intersectionDays; // Add your logic to handle days if needed

                                            }
                                            // dd($MealCounter);
                                        }


                                        $validityFound = 1;
                                        // dd($weekenDaysCunt);
                                    }
                                }
                                $mealPrices = $mealPrices * $makkah_hotel_room_type_id;
                                $commissionAmount = ($commision / 100) * $mealPrices;
                                $mealPrices = $mealPrices + $commissionAmount;
                                $total_meal_cost += $mealPrices;
                                $makkah_hotel_start_date = Carbon::createFromFormat('Y-m-d', $makkah_hotel_start_date)->format('d-m-Y');
                                $makkah_hotel_end_date = Carbon::createFromFormat('Y-m-d', $makkah_hotel_end_date)->format('d-m-Y');
                                $hotelBookingResults[] = [
                                    'city' => 'Makkah',
                                    'hotel' => $hotelName,
                                    'room_type' => $makkahRoom,
                                    'meals' => $mealsName,
                                    'checkin' => $makkah_hotel_start_date,
                                    'checkout' => $makkah_hotel_end_date,
                                    'rate' => $makkah_hotel_room_price_final,
                                    'meal_rate' => $mealPrices
                                ];
                            } else {
                                $textDateRanges = '';
                                $startDate = null;
                                $endDate = '';

                                // Iterate through the dates
                                foreach ($uncoveredDates as $date) {
                                    // Parse the date
                                    $formattedDate = date('j F Y', strtotime($date));

                                    // If startDate is not set, set it
                                    if ($startDate === null) {
                                        $startDate = $formattedDate;
                                        $endDate = $formattedDate;
                                        continue; // Skip the rest of the loop iteration
                                    }

                                    // Check if the current date is consecutive to the previous date
                                    $currentDate = date('Y-m-d', strtotime($date));
                                    $previousDate = date('Y-m-d', strtotime($endDate));
                                    $diff = date_diff(date_create($currentDate), date_create($previousDate));

                                    if ($diff->days === 1) {
                                        // If consecutive, update endDate
                                        $endDate = $formattedDate;
                                    } else {
                                        // If not consecutive, add the range to textDateRanges
                                        $textDateRanges .= ($startDate == $endDate) ? $startDate : $startDate . ' to ' . $endDate;
                                        $textDateRanges .= ' <br> ';
                                        $startDate = $formattedDate;
                                        $endDate = $formattedDate;
                                    }
                                }

                                // Add the last range to textDateRanges
                                $textDateRanges .= ($startDate == $endDate) ? $startDate : $startDate . ' to ' . $endDate;
                                $errorMessage = "Sorry, According to your given dates <b>$makkah_hotel_start_date - $makkah_hotel_end_date</b> of Makkah Hotel. We have not availabilty of this room in given dates bellow: <br> $textDateRanges";
                                return back()->withErrors([$errorMessage])->withInput();
                            }
                        }
                    } else {
                        $errorMessage = "</b> Please select all dropdown values of slected hotels for the calculated result. (Meals are optional) <br>";
                        return back()->withErrors([$errorMessage])->withInput();
                    }
                }
            }


            $MadinahhotelBookingResults = array();
            if ($madinah_id[0] != NULL) {
                $MealCounter = 0;
                foreach ($request->madinah_hotel as $index => $madinah_id) {
                    $MealCounter = $index;
                    $mealPrices = 0;
                    $madinah_hotel_room_type_id = $request->madinah_hotel_room_type[$index];
                    $madinah_hotel_start_date = $request->madinah_hotel_start_date[$index];
                    $madinah_hotel_end_date = $request->madinah_hotel_end_date[$index];
                    if ($madinah_hotel_room_type_id != NULL && $madinah_hotel_start_date != NULL && $madinah_hotel_end_date != NULL) {
                        $mealsName = '';
                        $hotelRoom = HotelRoom::with('room')
                            ->where('hotel_id', $madinah_id)
                            ->where('room_id', $madinah_hotel_room_type_id)
                            ->get();

                        $hotelName = Hotel::findOrFail($madinah_id);
                        $commision = $hotelName->commision;
                        $hotelName = $hotelName->name;
                        $validityFound = 0;
                        $totalPrice = 0;
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
                            $madinah_hotel_room_price_final = 0;

                            foreach ($hotelRoom as $hotelRooms) {
                                // $endDate->addDay();
                                $madinahRoom = $hotelRooms->room->name;
                                $validityStartDate = Carbon::parse($hotelRooms->validity_start);
                                $validityEndDate = Carbon::parse($hotelRooms->validity_end);
                                $weekenDaysCunt = 0;
                                if ($validityStartDate <= $endDate && $validityEndDate >= $startDate) {
                                    $intersectionStart = max($startDate, $validityStartDate);
                                    $intersectionEnd = min($endDate, $validityEndDate);
                                    if ($intersectionEnd < $endDate) {
                                        $intersectionDays = $intersectionStart->diffInDays($intersectionEnd) + 1;
                                    } else {
                                        $intersectionDays = $intersectionStart->diffInDays($intersectionEnd);
                                    }
                                    $MadinahdaysDifference += $intersectionDays;
                                    $weekends = Weekend::first();
                                    $weekends = $weekends['name'];
                                    $nameArray = json_decode($weekends);
                                    $day1 = $day2 = $day3 = $day4 = $day5 = $day6 = $day7 = null;

                                    foreach ($nameArray as $index => $day) {
                                        ${'day' . ($index + 1)} = $day;
                                    }
                                    $weekenDaysCunt = 0;
                                    // dd($intersectionEnd);
                                    if ($endDate != $validityEndDate && $endDate >= $validityEndDate) {
                                        $intersectionEnd->addDay();
                                    }
                                    for ($i = 1; $i <= 7; $i++) {
                                        $day = ${'day' . $i};
                                        if (!is_null($day)) {
                                            $numDays = $intersectionStart->diffInDaysFiltered(function (Carbon $date) use ($day) {
                                                return $date->isDayOfWeek($day);
                                            }, $intersectionEnd);
                                            $weekenDaysCunt += $numDays;
                                        }
                                    }
                                    $weekdays = $intersectionDays - $weekenDaysCunt;
                                    $weekendDays = $weekenDaysCunt;
                                    // dd($intersectionDays);

                                    $madinah_hotel_room_price_weekdays = $hotelRooms->weekdays_price * $weekdays;
                                    $madinah_hotel_room_price_weekendDays = $hotelRooms->weekend_price * $weekendDays;
                                    $madinah_hotel_room_price = $madinah_hotel_room_price_weekdays + $madinah_hotel_room_price_weekendDays;
                                    $commissionAmount = ($commision / 100) * $madinah_hotel_room_price;
                                    $madinah_hotel_room_price = $madinah_hotel_room_price + $commissionAmount;
                                    $madinah_hotel_room_price_final += $madinah_hotel_room_price;
                                    $total_hotel_cost += $madinah_hotel_room_price;
                                    $madinah_hotel_room_perday_price = $hotelRooms->weekdays_price;

                                    $madinah_hotel_meal_type_id = $request->madinah_hotel_meal_type[$MealCounter];

                                    if ($madinah_hotel_meal_type_id) {
                                        $meal = Meal::with('mealType')
                                            ->where('hotel_id', $madinah_id)
                                            ->where('meal_type_id', $madinah_hotel_meal_type_id)->first();
                                        // dd($meal);
                                        if ($meal) {
                                            $mealsName .= ($mealsName ? ', ' : '') . $meal->mealType->name;
                                            $mealPrices += $meal->price * $intersectionDays; // Add your logic to handle days if needed

                                        }
                                        // dd($MealCounter);
                                    }
                                }
                            }
                            $mealPrices = $mealPrices * $madinah_hotel_room_type_id;
                            $commissionAmount = ($commision / 100) * $mealPrices;
                            $mealPrices = $mealPrices + $commissionAmount;
                            $total_meal_cost += $mealPrices;
                            $madinah_hotel_start_date = Carbon::createFromFormat('Y-m-d', $madinah_hotel_start_date)->format('d-m-Y');
                            $madinah_hotel_end_date = Carbon::createFromFormat('Y-m-d', $madinah_hotel_end_date)->format('d-m-Y');
                            $MadinahhotelBookingResults[] = [
                                'city' => 'Madinah',
                                'hotel' => $hotelName,
                                'room_type' => $madinahRoom,
                                'meals' => $mealsName,
                                'checkin' => $madinah_hotel_start_date,
                                'checkout' => $madinah_hotel_end_date,
                                'rate' => $madinah_hotel_room_price_final,
                                'meal_rate' => $mealPrices
                            ];
                            $MealCounter++;
                        } else {
                            $textDateRanges = '';
                            $startDate = null;
                            $endDate = '';

                            // Iterate through the dates
                            foreach ($uncoveredDates as $date) {
                                // Parse the date
                                $formattedDate = date('j F Y', strtotime($date));

                                // If startDate is not set, set it
                                if ($startDate === null) {
                                    $startDate = $formattedDate;
                                    $endDate = $formattedDate;
                                    continue; // Skip the rest of the loop iteration
                                }

                                // Check if the current date is consecutive to the previous date
                                $currentDate = date('Y-m-d', strtotime($date));
                                $previousDate = date('Y-m-d', strtotime($endDate));
                                $diff = date_diff(date_create($currentDate), date_create($previousDate));

                                if ($diff->days === 1) {
                                    // If consecutive, update endDate
                                    $endDate = $formattedDate;
                                } else {
                                    // If not consecutive, add the range to textDateRanges
                                    $textDateRanges .= ($startDate == $endDate) ? $startDate : $startDate . ' to ' . $endDate;
                                    $textDateRanges .= ' <br> ';
                                    $startDate = $formattedDate;
                                    $endDate = $formattedDate;
                                }
                            }

                            // Add the last range to textDateRanges
                            $textDateRanges .= ($startDate == $endDate) ? $startDate : $startDate . ' to ' . $endDate;
                            $errorMessage = "Sorry, According to your given dates <b>$madinah_hotel_start_date - $madinah_hotel_end_date</b> of Madinah Hotel. We have not availabilty of this room in given dates bellow: <br> $textDateRanges";
                            return back()->withErrors([$errorMessage])->withInput();
                        }
                    } else {
                        $errorMessage = "</b> Please select all dropdown values of slected hotels for the calculated result. (Meals are optional) <br>";
                        return back()->withErrors([$errorMessage])->withInput();
                    }
                }
            }


            $JeddahhotelBookingResults = array();
            if ($jeddah_id[0] != NULL) {
                $MealCounter = 0;
                foreach ($request->jeddah_hotel as $index => $jeddah_id) {
                    $MealCounter = $index;
                    $mealPrices = 0;
                    $jeddah_hotel_room_type_id = $request->jeddah_hotel_room_type[$index];
                    $jeddah_hotel_start_date = $request->jeddah_hotel_start_date[$index];
                    $jeddah_hotel_end_date = $request->jeddah_hotel_end_date[$index];
                    if ($jeddah_hotel_room_type_id != NULL && $jeddah_hotel_start_date != NULL && $jeddah_hotel_end_date != NULL) {
                        $mealsName = '';
                        $hotelRoom = HotelRoom::with('room')
                            ->where('hotel_id', $jeddah_id)
                            ->where('room_id', $jeddah_hotel_room_type_id)
                            ->get();
                        $hotelName = Hotel::findOrFail($jeddah_id);
                        $commision = $hotelName->commision;
                        $hotelName = $hotelName->name;
                        $validityFound = 0;
                        $totalPrice = 0;
                        $uncoveredDates = [];
                        $startDate = Carbon::parse($jeddah_hotel_start_date);
                        $endDate = Carbon::parse($jeddah_hotel_end_date);
                        // To find dates which is not applicable or comming in validities
                        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                            $dateString = $date->toDateString();
                            $dateIsCovered = false;
                            // Check if the current date falls within any validity period
                            foreach ($hotelRoom as $hotelRooms) {
                                $jeddahRoom = $hotelRooms->room->name;
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
                            $jeddah_hotel_room_price_final = 0;
                            foreach ($hotelRoom as $hotelRooms) {
                                // $endDate->addDay();

                                $validityStartDate = Carbon::parse($hotelRooms->validity_start);
                                $validityEndDate = Carbon::parse($hotelRooms->validity_end);
                                $weekenDaysCunt = 0;
                                if ($validityStartDate <= $endDate && $validityEndDate >= $startDate) {
                                    $intersectionStart = max($startDate, $validityStartDate);
                                    $intersectionEnd = min($endDate, $validityEndDate);
                                    if ($intersectionEnd < $endDate) {
                                        $intersectionDays = $intersectionStart->diffInDays($intersectionEnd) + 1;
                                    } else {
                                        $intersectionDays = $intersectionStart->diffInDays($intersectionEnd);
                                    }
                                    $jeddahdaysDifference += $intersectionDays;
                                    $weekends = Weekend::first();
                                    $weekends = $weekends['name'];
                                    $nameArray = json_decode($weekends);
                                    $day1 = $day2 = $day3 = $day4 = $day5 = $day6 = $day7 = null;

                                    foreach ($nameArray as $index => $day) {
                                        ${'day' . ($index + 1)} = $day;
                                    }
                                    $weekenDaysCunt = 0;
                                    // dd($intersectionEnd);
                                    if ($endDate != $validityEndDate && $endDate >= $validityEndDate) {
                                        $intersectionEnd->addDay();
                                    }
                                    for ($i = 1; $i <= 7; $i++) {
                                        $day = ${'day' . $i};
                                        if (!is_null($day)) {
                                            $numDays = $intersectionStart->diffInDaysFiltered(function (Carbon $date) use ($day) {
                                                return $date->isDayOfWeek($day);
                                            }, $intersectionEnd);
                                            $weekenDaysCunt += $numDays;
                                        }
                                    }
                                    $weekdays = $intersectionDays - $weekenDaysCunt;
                                    $weekendDays = $weekenDaysCunt;
                                    // dd($intersectionDays);

                                    $jeddah_hotel_room_price_weekdays = $hotelRooms->weekdays_price * $weekdays;
                                    $jeddah_hotel_room_price_weekendDays = $hotelRooms->weekend_price * $weekendDays;
                                    $jeddah_hotel_room_price = $jeddah_hotel_room_price_weekdays + $jeddah_hotel_room_price_weekendDays;
                                    $commissionAmount = ($commision / 100) * $jeddah_hotel_room_price;
                                    $jeddah_hotel_room_price = $jeddah_hotel_room_price + $commissionAmount;
                                    $jeddah_hotel_room_price_final += $jeddah_hotel_room_price;
                                    $total_hotel_cost += $jeddah_hotel_room_price;
                                    $jeddah_hotel_room_perday_price = $hotelRooms->weekdays_price;

                                    $jeddah_hotel_meal_type_id = $request->jeddah_hotel_meal_type[$MealCounter];

                                    if ($jeddah_hotel_meal_type_id) {
                                        $meal = Meal::with('mealType')
                                            ->where('hotel_id', $jeddah_id)
                                            ->where('meal_type_id', $jeddah_hotel_meal_type_id)->first();
                                        // dd($meal);
                                        if ($meal) {
                                            $mealsName .= ($mealsName ? ', ' : '') . $meal->mealType->name;
                                            $mealPrices += $meal->price * $intersectionDays; // Add your logic to handle days if needed

                                        }
                                        // dd($MealCounter);
                                    }
                                    $validityFound = 1;
                                }
                            }
                            $mealPrices = $mealPrices * $jeddah_hotel_room_type_id;
                            $commissionAmount = ($commision / 100) * $mealPrices;
                            $mealPrices = $mealPrices + $commissionAmount;
                            $total_meal_cost += $mealPrices;
                            $jeddah_hotel_start_date = Carbon::createFromFormat('Y-m-d', $jeddah_hotel_start_date)->format('d-m-Y');
                            $jeddah_hotel_end_date = Carbon::createFromFormat('Y-m-d', $jeddah_hotel_end_date)->format('d-m-Y');
                            $JeddahhotelBookingResults[] = [
                                'city' => 'Jaddah',
                                'hotel' => $hotelName,
                                'room_type' => $jeddahRoom,
                                'meals' => $mealsName,
                                'checkin' => $jeddah_hotel_start_date,
                                'checkout' => $jeddah_hotel_end_date,
                                'rate' => $jeddah_hotel_room_price_final,
                                'meal_rate' => $mealPrices
                            ];
                            $MealCounter++;
                        } else {
                            $textDateRanges = '';
                            $startDate = null;
                            $endDate = '';

                            // Iterate through the dates
                            foreach ($uncoveredDates as $date) {
                                // Parse the date
                                $formattedDate = date('j F Y', strtotime($date));

                                // If startDate is not set, set it
                                if ($startDate === null) {
                                    $startDate = $formattedDate;
                                    $endDate = $formattedDate;
                                    continue; // Skip the rest of the loop iteration
                                }

                                // Check if the current date is consecutive to the previous date
                                $currentDate = date('Y-m-d', strtotime($date));
                                $previousDate = date('Y-m-d', strtotime($endDate));
                                $diff = date_diff(date_create($currentDate), date_create($previousDate));

                                if ($diff->days === 1) {
                                    // If consecutive, update endDate
                                    $endDate = $formattedDate;
                                } else {
                                    // If not consecutive, add the range to textDateRanges
                                    $textDateRanges .= ($startDate == $endDate) ? $startDate : $startDate . ' to ' . $endDate;
                                    $textDateRanges .= ' <br> ';
                                    $startDate = $formattedDate;
                                    $endDate = $formattedDate;
                                }
                            }

                            // Add the last range to textDateRanges
                            $textDateRanges .= ($startDate == $endDate) ? $startDate : $startDate . ' to ' . $endDate;
                            $errorMessage = "Sorry, According to your given dates <b>$jeddah_hotel_start_date - $jeddah_hotel_end_date</b> of Jeddah Hotel. We have not availabilty of this room in given dates bellow: <br> $textDateRanges";
                            return back()->withErrors([$errorMessage])->withInput();
                        }
                    } else {
                        $errorMessage = "</b> Please select all dropdown values of slected hotels for the calculated result. (Meals are optional) <br>";
                        return back()->withErrors([$errorMessage])->withInput();
                    }
                }
            }

            // return view('website.custom-package.result2', [
            //     'hotelBookingResults' => $hotelBookingResults,
            //     'MadinahhotelBookingResults' => $MadinahhotelBookingResults,
            //     'JeddahhotelBookingResults' => $JeddahhotelBookingResults
            // ]);


            $RoutesData = array();
            $routes = $request->input('route');
            // 
            if ($routes[0] != null) {
                $vehicles = $request->input('vehicle');
                $travel_dates = $request->input('travel_date');
                $transport_cost = 0;
                foreach ($routes as $key => $route) {
                    $routeName = Route::where('id', $routes[$key])->pluck('name');
                    $routeName = $routeName[0];
                    $vehicle = '';
                    $travel_date = '';

                    $transports = Transport::with('vehicles')
                        ->where('route_id', $routes[$key])
                        ->where('vehicle_id', $vehicles[$key])
                        ->get();
                    $vehicle = $vehicles[$key];
                    // dd($transports->vehicles->name);
                    foreach ($transports as $transport) {
                        $vehicleName = $transport->vehicles->name;
                    }
                    $travel_date = $travel_dates[$key];
                    if ($vehicle == NULL && $travel_date == NULL) {
                        $errorMessage = "</b> Please select all dropdown values of slected Transport for the calculated result.<br>";
                        return back()->withErrors([$errorMessage])->withInput();
                    }
                    if ($transports->isNotEmpty()) {
                        foreach ($transports as $transport) {

                            // dd($travel_date);
                            $commision = $transport->commision;
                            $cost = $transport->costs()
                                ->where('validity_start', '<=', $travel_dates[$key]) // Check if travel date is after or on validity start
                                ->where('validity_end', '>=', $travel_dates[$key]) // Check if travel date is before or on validity end
                                ->orderByRaw('ABS(DATEDIFF(validity_start, ?))', [$travel_dates[$key]]) // Order by the difference between travel date and validity start
                                ->first();
                            if ($cost != null) {
                                $totalCost = $cost->cost; // Assuming 'amount' is the field where the cost is stored
                                $commissionAmount = ($commision / 100) * $totalCost;
                                $costWithCommission = $totalCost + $commissionAmount;
                                // Assign the transport cost and break the loop
                                $new_transport_cost = $costWithCommission;
                                $transport_cost += $new_transport_cost;
                                break;
                            } else {
                                $errorMessage = "</b> Sorry, No transport Available from <b>" . $routeName . "</b> on <b>" . $travel_dates[$key] . "</b>.<br>";
                                return back()->withErrors([$errorMessage])->withInput();
                            }
                        }
                        if ($transport_cost == 0) {
                            $errorMessage = "Sorry, No Transport ( {{$routeName}} ) available between the given date.";
                            return back()->withErrors([$errorMessage]);
                        }
                        $travel_date = Carbon::createFromFormat('Y-m-d', $travel_date)->format('d-m-Y');
                        $RoutesData[] = [
                            'date' => $travel_date,
                            'route' => $routeName,
                            'vehicle' => $vehicleName,
                            'rate' => $new_transport_cost,
                        ];
                    } else {
                        $errorMessage = "Sorry, No Transport ( {$routeName} ) available between the given date.";
                        return back()->withErrors([$errorMessage]);
                    }
                }
                $total_transport_cost += $transport_cost;
            }

            $visaCharges = Visa::where('id', '1')->get();
            foreach ($visaCharges as $visaCharge) {
                $show_detail = $visaCharge->show_detail;
                $hajj_charges = $visaCharge->hajj_charges;
                $commision = $visaCharge->hajj_commision;
                $commissionAmount = ($commision / 100) * $hajj_charges;
                $hajj_charges = $hajj_charges + $commissionAmount;

                $umrah_charges = $visaCharge->umrah_charges;
                $commision = $visaCharge->umrah_commision;
                $commissionAmount = ($commision / 100) * $umrah_charges;
                $umrah_charges = $umrah_charges + $commissionAmount;
            }

            if ($maktab != null) {
                $maktab = Maktab::findOrFail($maktab);
                $visa = $maktab->cost;
            } else {
                $visa = ($visa == 'umrah') ? $umrah_charges : (($visa == 'hajj') ? $hajj_charges : null);
            }
            $visa_per_person = $visa;
            $visa = $visa * $no_of_persons;

            $grandtotal = array();
            $grandtotalPayable = $total_hotel_cost + $total_meal_cost + $total_transport_cost + $visa;
            $grandtotal[] = [
                'accommodation' => $total_hotel_cost,
                'meals' => $total_meal_cost,
                'transportation' => $total_transport_cost,
                'grandtotal' => $grandtotalPayable,
                'visaperhead' => $visa_per_person,
                'visa' => $visa,
            ];

            $CurrencyConversion = CurrencyConversion::all();
            foreach ($CurrencyConversion as $CurrencyConversions) {
                $sar_to_pkr = $CurrencyConversions->sar_to_pkr;
                $sar_to_usd = $CurrencyConversions->sar_to_usd;
            }



            return view('website.custom-package.result2', [
                'hotelBookingResults' => $hotelBookingResults,
                'MadinahhotelBookingResults' => $MadinahhotelBookingResults,
                'JeddahhotelBookingResults' => $JeddahhotelBookingResults,
                'RoutesData' => $RoutesData,
                'grandtotal' => $grandtotal,
                'sar_to_pkr' => $sar_to_pkr,
                'sar_to_usd' => $sar_to_usd,
                'email' => $email,
                'contact' => $contact,
                'show_detail' => $show_detail
            ]);
        } else {
            $errorMessage = "Please select options to get calculated value.";
            return back()->withErrors([$errorMessage]);
        }
        // return view('website.custom-package.result', compact('total_cost', 'sar_to_pkr', 'sar_to_usd', 'makkah_hotel_room_perday_price', 'madinah_hotel_room_perday_price', 'jeddah_hotel_room_perday_price', 'makkah_hotel_room_price', 'madinah_hotel_room_price', 'jeddah_hotel_room_price', 'transport_cost', 'visa', 'mealPrices', 'visa_per_person', 'makkah_hotel_start_date', 'makkah_hotel_end_date', 'madinah_hotel_start_date', 'madinah_hotel_end_date', 'jeddah_hotel_start_date', 'jeddah_hotel_end_date'));
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

    public function hotel_note(Request $request)
    {
        $selectedValue = $request->input('selectedValue');

        $hotel = Hotel::where('id', $selectedValue)->first();
        $note = $hotel->note;

        // Return the response with the data
        return response()->json($note);
    }

    public function hotel_meal_type(Request $request)
    {

        $selectedValue = $request->input('selectedValue');

        $hotelMeals = Meal::where('hotel_id', $selectedValue)
            ->where('display', '1')
            ->distinct('meal_type_id')
            ->with('mealType') // Corrected relationship name
            ->get(['meal_type_id']);

        $mealNames = [];

        foreach ($hotelMeals as $hotelMeal) {
            // Access the meal name through the relationship
            $mealNames[] = [
                'id' => $hotelMeal->mealType->id,
                'name' => $hotelMeal->mealType->name,
            ];
        }

        return response()->json(['data' => $mealNames]);
    }

    public function route_vehicle(Request $request)
    {
        $selectedValue = $request->input('selectedValue');

        // Find the route with the given ID
        $route = Route::find($selectedValue);

        // Check if the route exists
        if ($route) {
            // Retrieve all vehicles associated with the route
            $vehicles = $route->transports()->get(); // Retrieve all associated vehicles

            // Check if any vehicles are associated with the route
            if ($vehicles->isNotEmpty()) {
                // Retrieve the names of all associated vehicles
                $vehicleNames = $vehicles->toArray();

                // Return the route and associated vehicle names as JSON response
                return response()->json(['data' =>  $vehicleNames]);
            } else {
                // Return a JSON response indicating that no vehicles are associated with the route
                return response()->json(['data' => 'nothing']);
            }
        } else {
            // Return a JSON response indicating that the route was not found
            return response()->json(['error' => 'Route not found'], 404);
        }
    }
}
