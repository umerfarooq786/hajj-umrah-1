@extends('website_layouts.master')

@section('content')

<div class="w-[95%] md:w-[70%] lg:w-[60%]  mx-auto space-y-10 my-20">
    <div class="bg-gray-100 shadow-lg w-full min-h-[250px] h-max flex flex-col lg:flex-row items-center  ">
        <img src="{{asset('images/hotels/test-hotel.jpg')}}" alt="" class="lg:h-[250px]  lg:w-[30%]  object-cover">
        <div class="space-y-5 px-10 py-5">
            <h4 class="font-semibold text-xl">Hotel Name</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quo commodi sint praesentium vero iure, quam libero dolores eius. Alias eaque magnam maxime incidunt eos nulla aperiam suscipit doloribus molestias.</p>
            <a href="/hotel/1" class="bg-[#9a1d21] inline-block cursor-pointer text-white py-2 px-7 rounded-md hover:bg-opacity-90">View Details</a>            
        </div>
    </div>  

    <div class="bg-gray-100 shadow-lg w-full min-h-[250px] h-max flex flex-col lg:flex-row items-center  ">
        <img src="{{asset('images/hotels/test-hotel.jpg')}}" alt="" class="lg:h-[250px]  lg:w-[30%]  object-cover">
        <div class="space-y-5 px-10 py-5">
            <h4 class="font-semibold text-xl">Hotel Name</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quo commodi sint praesentium vero iure, quam libero dolores eius. Alias eaque magnam maxime incidunt eos nulla aperiam suscipit doloribus molestias.</p>
            <a href="/hotel/1" class="bg-[#9a1d21] inline-block cursor-pointer text-white py-2 px-7 rounded-md hover:bg-opacity-90">View Details</a>            
        </div>
    </div>  

    <div class="bg-gray-100 shadow-lg w-full min-h-[250px] h-max flex flex-col lg:flex-row items-center  ">
        <img src="{{asset('images/hotels/test-hotel.jpg')}}" alt="" class="lg:h-[250px]  lg:w-[30%]  object-cover">
        <div class="space-y-5 px-10 py-5">
            <h4 class="font-semibold text-xl">Hotel Name</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quo commodi sint praesentium vero iure, quam libero dolores eius. Alias eaque magnam maxime incidunt eos nulla aperiam suscipit doloribus molestias.</p>
            <a href="/hotel/1" class="bg-[#9a1d21] inline-block cursor-pointer text-white py-2 px-7 rounded-md hover:bg-opacity-90">View Details</a>            
        </div>
    </div>  

</div>


@endsection