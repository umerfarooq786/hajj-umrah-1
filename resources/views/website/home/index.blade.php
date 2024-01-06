@extends('website_layouts.master')

@section('content')

@include('website_layouts.partials._HeroSlider')

<!-- special offers ssection -->
<div class="content-header row bg-white">
    <div class="w-[75%] mx-auto flex flex-col items-center justify-center py-20">
        <h4 class="text-red-500 text-[16px] font-semibold">Special Offers</h4>
        <h2 class="text-[27px] font-bold">Hajj and Umrah Special Offer</h2>
        <div class="flex max-sm:flex-col items-center justify-center  gap-10 mt-8">
            <div class="specal-offer-box border rounded-md overflow-hidden">
                <img src="{{asset('images/home/so1.jpg')}}" alt="logo" class="object-cover rounded-md">
                <div>
                    <h4>Umrah Package</h4>
                    <div>
                        <img src="{{asset('images/home/hotel1.png')}}" alt="">
                        <div>
                            <p class="text-[13px] font-bold">MECCA: <span class="text-[12px]">(QUARD ROOM)</span></p>
                            <p class="text-[15px] font-semibold text-[#006FDC]">200 M To Masjidil Haram</p>
                        </div>
                    </div>
                    <div>
                        <img src="{{asset('images/home/hotel.png')}}" alt="">
                        <div>
                            <p class="text-[13px] font-bold">MEDINA: <span class="text-[12px]">(QUARD ROOM)</span></p>
                            <p class="text-[15px] font-semibold text-[#006FDC]">200 M To Masjidil Haram</p>                            
                        </div>
                    </div>
                    <p> 
                        <del class="text-gray-400 text-[16px]">16.000 USD/Pax</del> 
                        <span class="text-[18px] font-bold text-[#006FDC]">15.000 USD/Pax</span> 
                    </p>
                    <a href="" class="bg-[#e2efff] text-[12px] uppercase py-4 px-6 rounded-full hover:bg-red-500 hover:text-white inline-block mt-3 mb-7">Apply Now</a>
                </div>
            </div>
            <div class="specal-offer-box border rounded-md overflow-hidden">
                <img src="{{asset('images/home/so1.jpg')}}" alt="logo" class="object-cover rounded-md">
                <div>
                    <h4>Umrah Package</h4>
                    <div>
                        <img src="{{asset('images/home/hotel1.png')}}" alt="">
                        <div>
                            <p class="text-[13px] font-bold">MECCA: <span class="text-[12px]">(QUARD ROOM)</span></p>
                            <p class="text-[15px] font-semibold text-[#006FDC]">200 M To Masjidil Haram</p>
                        </div>
                    </div>
                    <div>
                        <img src="{{asset('images/home/hotel.png')}}" alt="">
                        <div>
                            <p class="text-[13px] font-bold">MEDINA: <span class="text-[12px]">(QUARD ROOM)</span></p>
                            <p class="text-[15px] font-semibold text-[#006FDC]">200 M To Masjidil Haram</p>                            
                        </div>
                    </div>
                    <p> 
                        <del class="text-gray-400 text-[16px]">16.000 USD/Pax</del> 
                        <span class="text-[18px] font-bold text-[#006FDC]">15.000 USD/Pax</span> 
                    </p>
                    <a href="" class="bg-[#e2efff] text-[12px] uppercase py-4 px-6 rounded-full hover:bg-red-500 hover:text-white inline-block mt-3 mb-7">Apply Now</a>
                </div>
            </div>
            
            
        </div>
        
    </div>
</div>


@endsection