@extends('website_layouts.master')

@section('custom_styles')
    <!-- Any custom styles go here -->
@endsection

@section('content')
    <style>
        .currency-content {
            display: none;
        }

        #contentSAR {
            display: block;
        }
    </style>
    <div class="w-[95%] md:w-[90%] lg:w-[80%] mx-auto py-10 flex flex-col items-center justify-start gap-5 ">
        <h2 class="text-green-600">Note: The rates may vary, kindly contact admin by clicking
            <a href="{{ url('contact') }}" class="text-red-600">this link</a>
        </h2>

        <!-- Currency selection dropdown -->
        <div class=" w-full flex items-center justify-between px-6">
            <select id="currencySelect"
                class="appearance-none w-[120px] cursor-pointer bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 leading-5 focus:outline-none focus:ring-0 focus:border-gray-300 sm:text-sm">
                <option value="SAR">SAR</option>
                <option value="USD">USD</option>
                <option value="PKR">PKR</option>
            </select>

            {{-- {{ dd($hotelBookingResults) }} --}}
            <form action="{{ route('download.pdf') }}" method="post">
                @csrf
                <input type="hidden" name="show_detail" value={{ encrypt(json_encode($show_detail)) }}>
                <input type="hidden" name="hotelBookingResults" value={{ encrypt(json_encode($hotelBookingResults)) }}>

                <input type="hidden" name="MadinahhotelBookingResults"
                    value={{ encrypt(json_encode($MadinahhotelBookingResults)) }}>
                <input type="hidden" name="JeddahhotelBookingResults"
                    value={{ encrypt(json_encode($JeddahhotelBookingResults)) }}>
                <input type="hidden" name="RoutesData" value={{ encrypt(json_encode($RoutesData)) }}>
                <input type="hidden" name="grandtotal" value={{ encrypt(json_encode($grandtotal)) }}>

                <button type="submit" id="downloadButton"
                    class="bg-[#c02428] text-white py-2 px-5 rounded-md hover:bg-opacity-80"
                    onclick="hideButton()">Download</button>
            </form>
        </div>

        {{-- {{ dd($hotelBookingResults) }} --}}
        <div id="contentSAR" class="currency-content">
            @if ($show_detail == '1')
                <h4 class="font-bold self-start mt-5">Accomodation Details</h4>
                <div class="relative overflow-x-auto  border border-gray1 w-full self-start">
                    {{-- Accomodation Table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    City
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Hotel Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Room Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Meals
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Check In
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Check Out
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Rate
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    M.Rate
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotelBookingResults as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['city'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['hotel'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['room_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['meals'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkout'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white" id='makkah_rate'>
                                        <b>SAR</b> {{ $result['rate'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='makkah_m_rate'>
                                        <b>SAR</b> {{ $result['meal_rate'] }}
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($MadinahhotelBookingResults as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['city'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['hotel'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['room_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['meals'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkout'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white" id='madinah_rate'>
                                        <b>SAR</b> {{ $result['rate'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='makdinah_m_rate'>
                                        <b>SAR</b> {{ $result['meal_rate'] }}
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($JeddahhotelBookingResults as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['city'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['hotel'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['room_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['meals'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkout'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white" id='jaddah_rate'>
                                        <b>SAR</b> {{ $result['rate'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='jaddah_m_rate'>
                                        <b>SAR</b> {{ $result['meal_rate'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Transportation table starts --}}
                <h4 class="font-bold self-start mt-5">Transportation Details</h4>
                <div class="relative overflow-x-auto w-auto border border-gray1 self-start">
                    {{-- Accomodation Table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Route
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Vehicle
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Rate
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($RoutesData as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['date'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['route'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['vehicle'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id="vehicle_rate">
                                        <b>SAR</b> {{ $result['rate'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{-- Grand Total table starts --}}
            <h4 class="font-bold mt-5 self-start">Total Charges</h4>
            <div class="relative overflow-x-auto w-auto border border-gray1 self-start ">
                {{-- Accomodation Table --}}
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        @foreach ($grandtotal as $result)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Accommodation
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="accommodation">
                                    <b>SAR</b> {{ $result['accommodation'] }}
                                </th>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Meals
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="meals">
                                    <b>SAR</b> {{ $result['meals'] }}
                                </th>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Transportation
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="transportation">
                                    <b>SAR</b> {{ $result['transportation'] }}
                                </th>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Grand Total Payable
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="total">
                                    <b>SAR</b> {{ $result['grandtotal'] }}

                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="contentUSD" class="currency-content">
            @if ($show_detail == '1')
                <h4 class="font-bold self-start mt-5">Accomodation Details</h4>
                <div class="relative overflow-x-auto  border border-gray1 w-full self-start">
                    {{-- Accomodation Table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    City
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Hotel Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Room Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Meals
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Check In
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Check Out
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Rate
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    M.Rate
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotelBookingResults as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['city'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['hotel'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['room_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['meals'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkout'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='makkah_rate'>
                                        <b>USD</b> {{ $result['rate'] * $sar_to_usd }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='makkah_m_rate'>
                                        <b>USD</b> {{ $result['meal_rate'] * $sar_to_usd }}
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($MadinahhotelBookingResults as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['city'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['hotel'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['room_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['meals'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkout'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='madinah_rate'>
                                        <b>USD</b> {{ $result['rate'] * $sar_to_usd }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='makdinah_m_rate'>
                                        <b>USD</b> {{ $result['meal_rate'] * $sar_to_usd }}
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($JeddahhotelBookingResults as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['city'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['hotel'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['room_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['meals'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkout'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='jaddah_rate'>
                                        <b>USD</b> {{ $result['rate'] * $sar_to_usd }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='jaddah_m_rate'>
                                        <b>USD</b> {{ $result['meal_rate'] * $sar_to_usd }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Transportation table starts --}}
                <h4 class="font-bold self-start mt-5">Transportation Details</h4>
                <div class="relative overflow-x-auto w-auto border border-gray1 self-start">
                    {{-- Accomodation Table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Route
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Vehicle
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Rate
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($RoutesData as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['date'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['route'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['vehicle'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id="vehicle_rate">
                                        <b>USD</b> {{ $result['rate'] * $sar_to_usd }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{-- Grand Total table starts --}}
            <h4 class="font-bold mt-5 self-start">Total Charges</h4>
            <div class="relative overflow-x-auto w-auto border border-gray1 self-start ">
                {{-- Accomodation Table --}}
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        @foreach ($grandtotal as $result)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Accommodation
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="accommodation">
                                    <b>USD</b> {{ $result['accommodation'] * $sar_to_usd }}
                                </th>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Meals
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="meals">
                                    <b>USD</b> {{ $result['meals'] * $sar_to_usd }}
                                </th>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Transportation
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="transportation">
                                    <b>USD</b> {{ $result['transportation'] * $sar_to_usd }}
                                </th>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Grand Total Payable
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="total">
                                    <b>USD</b> {{ $result['grandtotal'] * $sar_to_usd }}

                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="contentPKR" class="currency-content">
            @if ($show_detail == '1')
                <h4 class="font-bold self-start mt-5">Accomodation Details</h4>
                <div class="relative overflow-x-auto  border border-gray1 w-full self-start">
                    {{-- Accomodation Table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    City
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Hotel Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Room Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Meals
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Check In
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Check Out
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Rate
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    M.Rate
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotelBookingResults as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['city'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['hotel'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['room_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['meals'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkout'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='makkah_rate'>
                                        <b>PKR</b> {{ $result['rate'] * $sar_to_pkr }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='makkah_m_rate'>
                                        <b>PKR</b> {{ $result['meal_rate'] * $sar_to_pkr }}
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($MadinahhotelBookingResults as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['city'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['hotel'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['room_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['meals'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkout'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='madinah_rate'>
                                        <b>PKR</b> {{ $result['rate'] * $sar_to_pkr }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='makdinah_m_rate'>
                                        <b>PKR</b> {{ $result['meal_rate'] * $sar_to_pkr }}
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($JeddahhotelBookingResults as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['city'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['hotel'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['room_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['meals'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['checkout'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='jaddah_rate'>
                                        <b>PKR</b> {{ $result['rate'] * $sar_to_pkr }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id='jaddah_m_rate'>
                                        <b>PKR</b> {{ $result['meal_rate'] * $sar_to_pkr }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Transportation table starts --}}
                <h4 class="font-bold self-start mt-5">Transportation Details</h4>
                <div class="relative overflow-x-auto w-auto border border-gray1 self-start">
                    {{-- Accomodation Table --}}
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Route
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Vehicle
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Rate
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($RoutesData as $result)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['date'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['route'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                        {{ $result['vehicle'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white"
                                        id="vehicle_rate">
                                        <b>PKR</b> {{ $result['rate'] * $sar_to_pkr }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{-- Grand Total table starts --}}
            <h4 class="font-bold mt-5 self-start">Total Charges</h4>
            <div class="relative overflow-x-auto w-auto border border-gray1 self-start ">
                {{-- Accomodation Table --}}
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        @foreach ($grandtotal as $result)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Accommodation
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="accommodation">
                                    <b>PKR</b> {{ $result['accommodation'] * $sar_to_pkr }}
                                </th>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Meals
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="meals">
                                    <b>PKR</b> {{ $result['meals'] * $sar_to_pkr }}
                                </th>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Transportation
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="transportation">
                                    <b>PKR</b> {{ $result['transportation'] * $sar_to_pkr }}
                                </th>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Grand Total Payable
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium"
                                    id="total">
                                    <b>PKR</b> {{ $result['grandtotal'] * $sar_to_pkr }}

                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>

    <!-- JavaScript for currency conversion -->
    <script>
        document.getElementById('currencySelect').addEventListener('change', function() {
            // Hide all divs first
            document.querySelectorAll('.currency-content').forEach(function(div) {
                div.style.display = 'none';
            });

            // Show the div corresponding to the selected currency
            var selectedCurrency = this.value;
            document.getElementById('content' + selectedCurrency).style.display = 'block';
        });

        // for hiding download button on clicking 
        function hideButton() {
            var button = document.getElementById('downloadButton');
            button.style.display = 'none';
        }
    </script>
@endsection
