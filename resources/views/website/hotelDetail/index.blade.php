@extends('website_layouts.master')

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/hotelDetailSlider.css') }}">
@endsection

@section('content')
    <div class="w-[95%] md:w-[80%] mx-auto space-y-10 my-20">

        <h2 class="font-semibold text-2xl">{{ $hotel->name }}</h2>
        <span class="text-gray1">Note: {{ $hotel->note }}</span>
        <div class="w-full h-[600px]">
            @include('website_layouts.partials._HotelDetailSlider1', ['hotel_images' => $hotel_images])
        </div>

        <div>
            <h4 class="font-semibold text-xl pb-3">{{ $hotel->excerpt }}</h4>
            <p>{!! $hotel->description !!}</p>
        </div>



        <select id="currencySelect"
            class="appearance-none w-[120px] cursor-pointer bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 leading-5 focus:outline-none focus:ring-0 focus:border-gray-300 sm:text-sm">
            <option value="SAR">SAR</option>
            <option value="USD">USD</option>
            <option value="PKR">PKR</option>
        </select>
        {{-- Accomodation Pricing Section --}}
        @if ($hotel_rooms->isNotEmpty())
            <div>
                <h4 class="font-semibold text-[20px]">Accomodation Pricing</h4>
                {{-- <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start mt-3">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Type
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Week Days Rate
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                    Weekend Days Rate
                                </th>
                            </tr>
                            @foreach ($hotel_rooms as $room)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                        {{ $room->room_name }}
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                        {{ $room->weekdays_price }} (SAR)
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900  whitespace-nowrap dark:text-white font-medium">
                                        {{ $room->weekend_price }} (SAR)
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}


                <form action="" class="flex gap-5 mt-5 ">
                    <div class=" flex items-center relative lg:w-[150px]">
                        <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                        <input type="text" id="start_date" name="makkah_hotel_start_date" placeholder="Start Date"
                            class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    </div>
                    <div class=" flex items-center relative lg:w-[150px]">
                        <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                        <input type="text" id="end_date" name="makkah_hotel_end_date" placeholder="End Date"
                            class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    </div>
                    <select id="madinah_hotel_room_type" name="madinah_hotel_room_type[]"
                        class="place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 ">
                        <option value="">Select Room Type</option>
                        <option value="1">Single</option>
                        <option value="2">Double</option>
                        <option value="3">Triple</option>
                        <option value="4">Quad</option>
                    </select>
                    <button class="bg-[#c2242a] text-white py-2 px-5 rounded-md hover:bg-opacity-85">Search</button>
                </form>
            </div>

            {{-- Accomodation Result Success section --}}
            <div class="  p-5 rounded-2xl w-[60%] border border-gray-200">
                Accomodation price between the seleced range is <b>1243 (SAR)</b>
            </div>

            {{-- Accomodation Result Failure section --}}
            <div class="  p-5 rounded-2xl w-[60%] border border-gray-200">
                Accomodation not available from xx-xx-xxx to xx-xx-xxxx <b>1243 (SAR)</b>
            </div>
        @endif

        {{-- Meals Pricing Section --}}
        @if ($meals->isNotEmpty())
            <div>
                <h4 class="font-semibold text-[20px]">Meals Pricing</h4>
                <div class="relative overflow-x-auto w-[60%] border border-gray-200 self-start mt-3">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-900 dark:text-white">
                            <tr>
                                <th class="px-6 py-4 font-bold whitespace-nowrap">
                                    Type
                                </th>
                                <th class="px-6 py-4 font-bold whitespace-nowrap">
                                    Price
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meals as $meal)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap dark:text-white font-medium">
                                        {{ $meal->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap dark:text-white font-medium">
                                        {{ $meal->price }} (SAR)
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif


        <div class="flex">
            {!! $hotel->google_map !!}
        </div>
    </div>



    <script>
        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            disable: [new Date()],
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            disable: [new Date()],
        });
    </script>
@endsection
