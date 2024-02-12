@extends('website_layouts.master')

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/hotelDetailSlider.css') }}">
@endsection

@section('content')

<div class="w-[95%] md:w-[80%] mx-auto space-y-10 my-20">
    <div class="w-full h-[600px]">
        @include('website_layouts.partials._HotelDetailSlider1')
    </div>

</div>


@endsection