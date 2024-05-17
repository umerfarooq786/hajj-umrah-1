@extends('website_layouts.master')

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/teamSlider.css') }}">
@endsection
@section('content')
    <div class="w-[85%] md:w-[75%] mx-auto my-14">
        <!-- about us section -->
        <div class="space-y-3">
            {{-- <h4 class="text-sm text-red-500 text-center font-semibold">ABOUT US</h4> --}}
            <h2 class="text-center text-red-500 font-semibold text-2xl">ABOUT US</h2>
            <p class="py-5 text-[#7a7a7a] text-[15px] text-justify">
                Fastline Travel & Tours is your go-to place for all your travel needs. We've been helping people explore the
                world for over 20 years, creating unforgettable experiences along the way. Whether it's a family vacation, a
                business trip, or a spiritual journey like Umrah, we've got you covered with our personalized services and
                attention to detail.

            </p>
        </div>

        {{-- Services section --}}
        <div class="mt-20 flex flex-col lg:flex-row items-center justify-center h-[350px]  w-full gap-5">
            <div class="flex lg:w-[70%] h-full max-lg:mt-20 bg-red-400">
                <img src="{{ asset('images/about/5.jpeg') }}" class="h-[100%] w-[100%] object-cover object-top"
                    alt="">
                {{-- <img src="{{ asset('images/about/6.jpeg') }}" class="h-[100%] w-[50%] object-contain" alt=""> --}}
            </div>
            <div class="h-full lg:w-[40%] flex flex-col  justify-center lg:gap-10 pr-5">
                <h4 class="font-bold text-xl text-red-500">Umrah Services</h4>
                <p class="text-justify text-[15px] text-[#7a7a7a]">At Fastline Travel & Tours, we specialize in making your
                    Umrah journey smooth and memorable. We
                    understand the importance of this spiritual experience and provide all the support you need to make it
                    fulfilling. From visa assistance to accommodation and guided tours, we take care of every aspect so you
                    can focus on your prayers and devotion.</p>
            </div>
        </div>


        <div class="mt-20 flex flex-col-reverse lg:flex-row-reverse items-center justify-center h-[350px]  w-full gap-5">
            <div class="flex lg:w-[70%] h-full max-lg:mt-20">
                <img src="{{ asset('images/about/4.png') }}" class="h-[100%] w-[100%] object-cover" alt="">
                {{-- <img src="{{ asset('images/about/4.png') }}" class="h-[100%] w-[50%] object-cover" alt=""> --}}
            </div>
            <div class="h-full lg:w-[40%] flex flex-col  justify-center lg:gap-10 pr-5">
                <h4 class="font-bold text-xl text-red-500">Transportation Services</h4>
                <p class="text-justify text-[15px] text-[#7a7a7a]">Need a ride? We've got it sorted! Our reliable transport
                    service ensures you get where you need to go comfortably and safely. Whether it's airport pickups, local
                    transfers, or customized itineraries, our fleet of vehicles and experienced drivers are at your service,
                    ensuring a hassle-free travel experience from start to finish.</p>
            </div>
        </div>


        <div class="my-20 flex flex-col lg:flex-row items-center justify-center h-[350px]  w-full gap-5">
            <div class="flex lg:w-[70%] h-full max-lg:mt-20">
                <img src="{{ asset('images/about/1.jpg') }}" class="h-[100%] w-[50%] object-cover" alt="">
                <img src="{{ asset('images/about/2.jpg') }}" class="h-[100%] w-[50%] object-cover" alt="">
            </div>
            <div class="h-full lg:w-[40%] flex flex-col  justify-center lg:gap-10 pr-5">
                <h4 class="font-bold text-xl text-red-500">Hotel booking</h4>
                <p class="text-justify text-[15px] text-[#7a7a7a]">Finding the perfect place to stay is easy with Fastline
                    Travel & Tours.
                    We offer a
                    wide range of hotel
                    options to suit your budget and preferences, from cozy bed-and-breakfasts to luxurious resorts. Our
                    dedicated team ensures that your accommodation meets your expectations, allowing you to relax and enjoy
                    your trip worry-free.</p>
            </div>
        </div>




        <!-- Slider1 -->
        @include('website_layouts.partials._AboutSlider1')


        <!-- about us section -->
        <div class="space-y-3 mt-10">
            <h4 class="text-sm text-red-500 text-center font-semibold">TEAM</h4>
            <h2 class="text-center text-[#1f1f1f] font-semibold text-2xl">Board Management</h2>
        </div>


        <!-- Slider2 -->
        <div class="relative mt-10">
            @include('website_layouts.partials._AboutSlider2')
        </div>


        <!-- Awards section -->
        {{-- <div class="space-y-3 mt-10">
            <h4 class="text-sm text-red-500 text-center font-semibold">AWARDS</h4>
            <h2 class="text-center text-[#1f1f1f] font-semibold text-2xl">Awards and Mention</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-16 mt-10 py-20 max-sm:px-10 border-t border-t-gray-200">
            <h4 class="font-semibold">2022</h4>
            <p class="text-gray-400 text-[16px] leading-8">Travel Agency of the Year Umrah Agency of the Year Travel Agency
                Awarded Travel</p>
            <p class="text-gray-400 text-[16px] leading-8">Travel Agency of the Year Umrah Agency of the Year Travel Agency
                Awarded Travel</p>
            <p class="text-gray-400 text-[16px] leading-8">Travel Agency of the Year Umrah Agency of the Year Travel Agency
                Awarded Travel</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-16 mt-10 py-20 max-sm:px-10 border-t border-t-gray-200">
            <h4 class="font-semibold">2023</h4>
            <p class="text-gray-400 text-[16px] leading-8">Travel Agency of the Year Umrah Agency of the Year Travel Agency
                Awarded Travel</p>
            <p class="text-gray-400 text-[16px] leading-8">Travel Agency of the Year Umrah Agency of the Year Travel Agency
                Awarded Travel</p>
            <p class="text-gray-400 text-[16px] leading-8">Travel Agency of the Year Umrah Agency of the Year Travel Agency
                Awarded Travel</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-16 mt-10 py-20 max-sm:px-10 border-t border-t-gray-200">
            <h4 class="font-semibold">2024</h4>
            <p class="text-gray-400 text-[16px] leading-8">Travel Agency of the Year Umrah Agency of the Year Travel Agency
                Awarded Travel</p>
            <p class="text-gray-400 text-[16px] leading-8">Travel Agency of the Year Umrah Agency of the Year Travel Agency
                Awarded Travel</p>
            <p class="text-gray-400 text-[16px] leading-8">Travel Agency of the Year Umrah Agency of the Year Travel Agency
                Awarded Travel</p>
        </div> --}}

    </div>
@endsection
