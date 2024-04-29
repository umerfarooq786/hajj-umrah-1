@extends('website_layouts.master')

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/hotelDetailSlider.css') }}">
@endsection

@section('content')
    <div class="w-[95%] md:w-[80%] mx-auto space-y-10 my-20">

        <h2 class="font-semibold text-2xl">Vehicle 1</h2>

        <div class="w-full h-[600px]">
            @include('website_layouts.partials._HotelDetailSlider2')
        </div>

        {{-- Routes Pricing Section --}}
        <div>
            <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start mt-3">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                Route
                            </th>
                            <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                Rate
                            </th>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                A - B
                            </th>
                            <th scope="row"
                                class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                10 (SAR)
                            </th>
                        </tr>

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                C - D
                            </th>
                            <th scope="row"
                                class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                10 (SAR)
                            </th>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                E - F
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
    </div>
@endsection
