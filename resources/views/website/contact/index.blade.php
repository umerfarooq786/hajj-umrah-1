@extends('website_layouts.master')

@section('content')

<div class="w-[95%] md:w-[80%]  mx-auto grid grid-cols-1 lg:grid-cols-2 gap-5 my-20">
    <div class="border border-gray-200 rounded-[4px] py-16 px-10 space-y-10">
        <img src="{{asset('images/logo.png')}}" alt="logo" class="h-[60px]">
        
        <div class="space-y-2">
            <h4 class="font-semibold">BUSINESS ADDRESS</h4>
            <p class="text-sm text-gray-500 font-semibold">LONDON OXFORD STREET, 012 UNITED KINGDOM.</p>
        </div>

        <div class="space-y-2">
            <h4 class="font-semibold">BUSINESS E-MAIL</h4>
            <p class="text-sm text-gray-500 font-semibold">ASTERIA@MAIL.CA</p>
        </div>

        <div class="space-y-2">
            <h4 class="font-semibold">PHONE</h4>
            <p class="text-sm text-gray-500 font-semibold">+1 222 333 456</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="#" class="bg-[#1f1f1f] h-[35px] w-[35px]  flex items-center justify-center rounded-full hover:bg-red-500 group transition-all duration-300">
                <i class="fa-brands fa-facebook-f text-red-500 text-[12px] group-hover:text-[#1f1f1f] transition-all" ></i>
            </a>
            <a href="#" class="bg-[#1f1f1f] h-[35px] w-[35px]  flex items-center justify-center rounded-full hover:bg-red-500 group transition-all duration-300">
                <i class="fa-brands fa-twitter text-red-500 text-[12px] group-hover:text-[#1f1f1f] transition-all" ></i>
            </a>
            <a href="#" class="bg-[#1f1f1f] h-[35px] w-[35px]  flex items-center justify-center rounded-full hover:bg-red-500 group transition-all duration-300">
                <i class="fa-brands fa-instagram text-red-500 text-[12px] group-hover:text-[#1f1f1f] transition-all" ></i>
            </a>
            <a href="#" class="bg-[#1f1f1f] h-[35px] w-[35px]  flex items-center justify-center rounded-full hover:bg-red-500 group transition-all duration-300">
                <i class="fa-brands fa-whatsapp text-red-500 text-[12px] group-hover:text-[#1f1f1f] transition-all" ></i>
            </a>
        </div>
    </div>    
    <div class="border border-gray-200 rounded-[4px] py-16 px-10 space-y-10">
        <form>
            <div class="flex flex-col md:flex-row gap-8">
                <div class="space-y-2">
                    <label  class="font-bold text-sm" for="first_name">First Name</label>
                    <input type="text" id="first_name" placeholder="First name here" class=" border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5  w-full">
                </div>

                <div class="space-y-2">
                    <label  class="font-bold text-sm" for="last_name">Last Name</label>
                    <input type="text" id="last_name" placeholder="First name here" class=" border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5 w-full">
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-8 mt-5">
                <div class="space-y-2">
                    <label  class="font-bold text-sm" for="email">Email Address</label>
                    <input type="text" id="email" placeholder="First name here" class=" border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5  w-full">
                </div>

                <div class="space-y-2">
                    <label  class="font-bold text-sm" for="subject">Subject</label>
                    <input type="text" id="subject" placeholder="First name here" class=" border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5 w-full">
                </div>
            </div>

            <div class="space-y-2 mt-5">
                <label  class="font-bold text-sm" for="comments">Comments / Questions</label>
                <textarea name="" id="comments" class="h-[200px] border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5 w-full"></textarea>
            </div>
            
        </form>
    </div>
</div>

@endsection