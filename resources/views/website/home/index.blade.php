@extends('website_layouts.master')
@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/specialOfferSlider.css') }}">
@endsection
@section('content')
    <!-- special offers ssection -->
    @if(!$package->isEmpty())
    <div class="content-header row bg-white" id="pre-defined">
        <div class="w-[75%] mx-auto flex flex-col items-center justify-center py-20">
            <h4 class="text-red-500 text-[16px] font-semibold">Special Offers</h4>
            <h2 class="text-[27px] font-bold">Hajj and Umrah Special Offer</h2>
            <div class="w-full h-[350px] special-offers">
                @include('website_layouts.partials._SpecialOffersSlider', ['package' => $package])
            </div>
        </div>
    </div>
    @endif

    <!-- What we offer section -->
    <div class="bg-[#e2efff] flex">
        <div class=" mx-auto py-10 max-md:px-10 max-lg:px-20 lg:pl-44 lg:w-[50%]">
            <h4 class="text-red-500 text-[13px] font-semibold pb-3">FEATURED</h4>
            <h2 class="text-[27px] font-semibold">What Do We Offer?</h2>
            <p class="text-gray-500 mt-3 text-justify">Embark on your pilgrimage with confidence through our tailored Hajj and Umrah packages, designed to seamlessly accommodate your spiritual journey. Our offerings encompass every aspect of your sacred voyage, from meticulously arranged accommodations to reliable transportation and insightful guided tours. With our unwavering commitment to exceptional service, personalized assistance, and unwavering support, we ensure your pilgrimage experience is not just fulfilling but truly transformative.</p>
            <a href="/contact"
                class="inline-block mt-5 py-3 px-5 rounded-full uppercase bg-red-500 hover:bg-opacity-80 text-xs text-white">Contact Us</a>
            <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex space-x-4">
                    <img src="{{ asset('images/home/luggage.png') }}" alt="logo"
                        class="object-contain h-[40px] w-[50px]">
                    <div>
                        <h4 class="text-[18px] font-semibold">Free Luggage</h4>
                        <p class="text-[14px] text-gray-500 ">Enjoy the added convenience of free luggage allowances, easing your travel burdens as you embark on your sacred pilgrimage.</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <img src="{{ asset('images/home/customer-care.png') }}" alt="logo"
                        class="object-contain h-[40px] w-[50px]">
                    <div>
                        <h4 class="text-[18px] font-semibold">Customer Support</h4>
                        <p class="text-[14px] text-gray-500">Receive unparalleled customer support, ensuring all your inquiries and needs are promptly addressed throughout your pilgrimage journey.</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <img src="{{ asset('images/home/reception-bell.png') }}" alt="logo"
                        class="object-contain h-[40px] w-[50px]">
                    <div>
                        <h4 class="text-[18px] font-semibold">Hotels</h4>
                        <p class="text-[14px] text-gray-500">Discover handpicked accommodations meticulously selected to provide comfort and convenience, enhancing your pilgrimage experience with memorable stays at top-rated hotels.</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <img src="{{ asset('images/home/kaaba.png') }}" alt="logo" class="object-contain h-[40px] w-[50px]">
                    <div>
                        <h4 class="text-[18px] font-semibold">Tours</h4>
                        <p class="text-[14px] text-gray-500">Embark on enlightening tours to sacred sites, enhancing your spiritual journey with insightful guidance, all supported by attentive customer assistance.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-lg:hidden w-[50%]  bg-no-repeat "
            style="background-image:url({{ asset('images/home/masjid.png') }}); background-position: -504px ">
        </div>
    </div>


    <!-- section 3 -->
    <div class=" bg-white">
        <div class="flex max-lg:flex-col w-[80%] mx-auto py-20 gap-20">
            <div class="lg:w-[40%]">
                <img src="{{ asset('images/home/13-1.jpg') }}" alt="logo" class="h-full w-full object-cover rounded-md">
            </div>
            <div class=" lg:w-[60%]">
                <h4 class="text-red-500 text-[13px] font-semibold pb-3">ABOUT</h4>
                <h2 class="text-[27px] font-semibold lg:w-[60%]">The Smart Way to Go Umrah and Hajj</h2>
                <p class="text-gray-500 mt-3 leading-7">Experience the epitome of pilgrimage convenience with "The Smart Way to Go Umrah and Hajj", where meticulous planning meets seamless execution, ensuring an enriching and hassle-free journey to the holiest of sites.</p>
                <div class="flex gap-3 mt-8">
                    <img src="{{ asset('images/home/tick.svg') }}">
                    <p class="text-[14px] text-gray-500">Streamlined logistics for effortless travel arrangements.</p>
                </div>
                <div class="flex gap-3 mt-2">
                    <img src="{{ asset('images/home/tick.svg') }}">
                    <p class="text-[14px] text-gray-500">Personalized guidance for a fulfilling spiritual experience.</p>
                </div>
                <div class="flex gap-3 mt-2">
                    <img src="{{ asset('images/home/tick.svg') }}">
                    <p class="text-[14px] text-gray-500">Expert support every step of the way for peace of mind pilgrimage.</p>
                </div>

                <a href="/contact"
                    class="inline-block mt-8 py-3 px-5 rounded-full uppercase bg-red-500 hover:bg-opacity-80 text-xs text-white">Contact Us</a>
            </div>
        </div>
    </div>


     <!-- Testimonial section -->
     @if(!$testimonial->isEmpty())
     <div class="content-header row bg-white">
        <div class="w-[75%] mx-auto flex flex-col items-center justify-center pb-10">
            <h4 class="text-red-500 text-[16px] font-semibold">TESTIMONIAL</h4>
            <h2 class="text-[27px] font-bold">What did they say?</h2>
            <div class="w-full h-[350px] testimonials ">
                @include('website_layouts.partials._TestimonialsSlider', ['testimonial' => $testimonial])
            </div>
        </div>
    </div>
     @endif
    <!-- section 4 -->
    <!-- <div class=" bg-white pb-20 text-center">
        <h4 class="text-red-500 text-[16px] font-semibold pb-3">UMRAH</h4>
        <h2 class="text-[27px] font-semibold">Umrah and Hajj Package</h2>

        <div class="w-[80%] mx-auto mt-10 text-left">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="rounded-md overflow-hidden border border-gray-200 pb-7 shadow-sm">
                    <div class="bg-[#2a2a2a] text-white p-8 relative h-[150px]">
                        <h4 class="text-[22px] font-bold">Umrah</h4>
                        <p class="text-red-500 mt-[-5px]">$2000 USD / Person</p>
                        <a href="#"
                            class="py-4 px-7 rounded-sm bg-[#e2efff] inline-block text-xs font-semibold text-black absolute bottom-[-20px]">GET
                            STARTED</a>
                    </div>
                    <div class="px-5">
                        <div class="flex gap-3 mt-14 items-center">
                            <img src="{{ asset('images/home/tick2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Private Airport Transfers</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">International Airfare</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Umrah Visa</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/tick2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Land Transportation</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/tick2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Accodomation</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Lunch</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Dinner</p>
                        </div>


                    </div>
                </div>

                <div class="rounded-md overflow-hidden border border-gray-200 pb-7 shadow-sm">
                    <div class="bg-red-500 text-white p-8 relative h-[150px]">
                        <h4 class="text-black text-[22px]  font-bold">Hajj</h4>
                        <p class="text-white mt-[-5px] ">$8000 USD / Person</p>
                        <a href="#"
                            class="py-4 px-7 rounded-sm bg-[#2a2a2a] inline-block text-xs font-semibold text-white absolute bottom-[-20px]">GET
                            STARTED</a>
                    </div>
                    <div class="px-5">
                        <div class="flex gap-3 mt-14 items-center">
                            <img src="{{ asset('images/home/tick2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Private Airport Transfers</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">International Airfare</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Umrah Visa</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/tick2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Land Transportation</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/tick2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Accodomation</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Lunch</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Dinner</p>
                        </div>


                    </div>
                </div>


                <div class="rounded-md overflow-hidden border border-gray-200 pb-7 shadow-sm">
                    <div class="bg-[#e2efff] text-white p-8 relative h-[150px]">
                        <h4 class="text-[22px] text-black font-bold">Umrah</h4>
                        <p class="text-red-500 mt-[-5px]">$2000 USD / Person</p>
                        <a href="#"
                            class="py-4 px-7 rounded-sm bg-red-500 inline-block text-xs font-semibold text-white absolute bottom-[-20px]">GET
                            STARTED</a>
                    </div>
                    <div class="px-5">
                        <div class="flex gap-3 mt-14 items-center">
                            <img src="{{ asset('images/home/tick2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Private Airport Transfers</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">International Airfare</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Umrah Visa</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/tick2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Land Transportation</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/tick2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Accodomation</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Lunch</p>
                        </div>

                        <div class="flex gap-3 mt-5 items-center">
                            <img src="{{ asset('images/home/cross2.png') }}" class='h-[25px] w-[25px]'>
                            <p class="text-[14px] text-gray-500">Dinner</p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div> -->
@endsection
@section('script')
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
    <link href="{{asset('app-assets/toastr/toastr.css') }}" rel="stylesheet" />
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
    @if (Session::get('success'))
        <script>
            $(document).ready(function() {
                toastr.success('<?php echo Session::get('success'); ?>', 'Zindawork Says', {
                    timeOut: 2000
                })
            });
        </script>
    @endif
@endsection
