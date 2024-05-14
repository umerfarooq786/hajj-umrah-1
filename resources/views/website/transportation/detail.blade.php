@extends('website_layouts.master')

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/hotelDetailSlider.css') }}">
@endsection

@section('content')
    <div class="w-[95%] md:w-[80%] mx-auto space-y-10 my-20">
        <h2 class="font-semibold text-2xl">{{ $vehicle->name }}</h2>
        <div class="w-full h-[600px]">
            @include('website_layouts.partials._HotelDetailSlider2')
        </div>

        <select id="currencySelect"
            class="appearance-none w-[120px] cursor-pointer bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 leading-5 focus:outline-none focus:ring-0 focus:border-gray-300 sm:text-sm">
            <option value="SAR">SAR</option>
            <option value="USD">USD</option>
            <option value="PKR">PKR</option>
        </select>

        {{-- Routes Pricing Section --}}
        <div>
            <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start mt-3">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        @if ($vehicle->transport)
                            @foreach ($vehicle->transport as $transport)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Route
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Rate
                                    </th>
                                </tr>
                                @if ($transport->display == '1')
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                            {{ $transport->route->name }}
                                        </th>
                                        @php
                                            $lastCost = $transport->costs->last();
                                        @endphp
                                        <th scope="row"
                                            class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                            {{ $lastCost->cost }} (SAR)
                                        </th>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <div class="space-y-1">
                                <div class="w-full flex items-center justify-between">
                                    <span>No Routes Available For This Transport Yet.</span>
                                </div>
                            </div>
                        @endif
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
