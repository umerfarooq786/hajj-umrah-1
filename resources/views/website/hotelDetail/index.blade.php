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

        {{-- Accomodation Pricing Section --}}
        <div>
            <h4 class="font-semibold text-[20px]">Acomodation Pricing</h4>
            <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start mt-3">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                Type
                            </th>
                            <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                Week Days Rate
                            </th>
                            <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                Weekend Days Rate
                            </th>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                Single Room
                            </th>
                            <th scope="row"
                                class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                100 (SAR)
                            </th>
                            <th scope="row"
                                class="px-6 py-4 text-gray-900  whitespace-nowrap dark:text-white font-medium">
                                120 (SAR)
                            </th>
                        </tr>

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                Double Room
                            </th>
                            <th scope="row"
                                class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                100 (SAR)
                            </th>
                            <th scope="row"
                                class="px-6 py-4 text-gray-900  whitespace-nowrap dark:text-white font-medium">
                                120 (SAR)
                            </th>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                Triple Room
                            </th>
                            <th scope="row"
                                class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                100 (SAR)
                            </th>
                            <th scope="row"
                                class="px-6 py-4 text-gray-900  whitespace-nowrap dark:text-white font-medium">
                                120 (SAR)
                            </th>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                Quad Room
                            </th>
                            <th scope="row"
                                class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                100 (SAR)
                            </th>
                            <th scope="row"
                                class="px-6 py-4 text-gray-900  whitespace-nowrap dark:text-white font-medium">
                                120 (SAR)
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Meals Pricing Section --}}
        <div>
            <h4 class="font-semibold text-[20px]">Meals Pricing</h4>
            <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start mt-3">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                Type
                            </th>
                            <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                Price
                            </th>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                Breakfast
                            </th>
                            <th scope="row"
                                class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                10 (SAR)
                            </th>
                        </tr>

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                Half Meal
                            </th>
                            <th scope="row"
                                class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                10 (SAR)
                            </th>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                Full Meal
                            </th>
                            <th scope="row"
                                class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                10 (SAR)
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-red-500 flex">
            {!! $hotel->google_map !!}
        </div>
    </div>
@endsection
