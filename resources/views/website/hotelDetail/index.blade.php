@extends('website_layouts.master')

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/hotelDetailSlider.css') }}">
@endsection

@section('content')

<div class="w-[95%] md:w-[80%] mx-auto space-y-10 my-20">
    <h2 class="font-semibold text-2xl">Hotel Name</h2>
    <div class="w-full h-[600px]">
        @include('website_layouts.partials._HotelDetailSlider1')
    </div>

    <div>
        <h4 class="font-semibold text-xl pb-3">Excerpt</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo error provident asperiores saepe aliquam expedita modi omnis magnam et perferendis sed quibusdam mollitia, culpa rerum cum voluptas eaque. Itaque, molestiae!</p>
    </div>

    <div >
        <iframe class="w-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3401.522605738512!2d74.33849297469594!3d31.50980344766572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919045c800b7a65%3A0x9bfe5a537cfceea4!2sMonal%20Lahore!5e0!3m2!1sen!2s!4v1707749268899!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>


@endsection