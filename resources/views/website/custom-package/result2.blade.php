@extends('website_layouts.master')

@section('custom_styles')
    <!-- Any custom styles go here -->
@endsection

@section('content')
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
            <form action="{{ route('download.pdf') }}" method="post">
                @csrf
                {{-- <input type="hidden" name="total_cost" value="{{ $total_cost }}">
                <input type="hidden" name="makkah_hotel_room_price" value="{{ $makkah_hotel_room_price }}">
                <input type="hidden" name="makkah_hotel_room_perday_price" value="{{ $makkah_hotel_room_perday_price }}">
                <input type="hidden" name="madinah_hotel_room_price" value="{{ $madinah_hotel_room_price }}">
                <input type="hidden" name="madinah_hotel_room_perday_price" value="{{ $madinah_hotel_room_perday_price }}">
                <input type="hidden" name="mealPrices" value="{{ $mealPrices }}">
                <input type="hidden" name="transport_cost" value="{{ $transport_cost }}">
                <input type="hidden" name="visa" value="{{ $visa }}">
                <input type="hidden" name="visa_per_person" value="{{ $visa_per_person }}"> --}}
                {{-- <button type="submit"
                    class="bg-[#c02428] text-white py-2 px-5 rounded-md hover:bg-opacity-80">Download</button> --}}
            </form>
        </div>


        {{-- Accomodation table starts --}}
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
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Makkah
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Hotel 1
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Single Bed
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Lunch, Breakfast, Dinner
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            14-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            850
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            100
                        </th>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Makkah
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Hotel 1
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Single Bed
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Lunch, Breakfast, Dinner
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            14-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            850
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            100
                        </th>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Makkah
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Hotel 2
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Single Bed
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Lunch, Breakfast, Dinner
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            14-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            850
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            100
                        </th>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Madinah
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Hotel 1
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Single Bed
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Lunch, Breakfast, Dinner
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            14-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            850
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            100
                        </th>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Madinah
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Hotel 2
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Single Bed
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Lunch, Breakfast, Dinner
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            14-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            850
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            100
                        </th>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Jeddah
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Hotel 1
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Single Bed
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Lunch, Breakfast, Dinner
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            14-Jun-16
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            850
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            100
                        </th>

                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Transportation table starts --}}
        <h4 class="font-bold self-start mt-5">Transportation Details</h4>
        <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start">
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
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <td class="px-6 py-4">
                            A - B
                        </td>
                        <td class="px-6 py-4">
                            3 Seater
                        </td>
                        <td class="px-6 py-4">
                            100
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <td class="px-6 py-4">
                            A - B
                        </td>
                        <td class="px-6 py-4">
                            3 Seater
                        </td>
                        <td class="px-6 py-4">
                            100
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <td class="px-6 py-4">
                            A - B
                        </td>
                        <td class="px-6 py-4">
                            3 Seater
                        </td>
                        <td class="px-6 py-4">
                            100
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            11-Jun-16
                        </th>
                        <td class="px-6 py-4">
                            A - B
                        </td>
                        <td class="px-6 py-4">
                            3 Seater
                        </td>
                        <td class="px-6 py-4">
                            100
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        {{-- Grand Total table starts --}}
        <h4 class="font-bold mt-5 self-start">Total Charges</h4>
        <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start ">
            {{-- Accomodation Table --}}
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                            Accommodation
                        </th>
                        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                            6580
                        </th>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                            Meals
                        </th>
                        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                            100
                        </th>

                    </tr>

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                            Transportation
                        </th>
                        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                            200
                        </th>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                            Grand Total Payable
                        </th>
                        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                            6880
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>



    </div>

    <!-- JavaScript for currency conversion -->
    <script>
        // Add event listener for currency selection dropdown
    </script>
@endsection
