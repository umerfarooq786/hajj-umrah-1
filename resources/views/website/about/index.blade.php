@extends('website_layouts.master')

@section('content')
    <div class="w-[85%] md:w-[75%] mx-auto my-14">
        <!-- about us section -->
        <div class="space-y-3">
            <h4 class="text-sm text-red-500 text-center font-semibold">ABOUT US</h4>
            <h2 class="text-center text-[#1f1f1f] font-semibold text-2xl">Established on 2015</h2>
            <p class="py-5 text-[#7a7a7a] text-[15px]">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, nostrum quaerat vero non laboriosam incidunt velit nemo ipsam perspiciatis fugit nisi deserunt itaque tempore odit exercitationem harum aut possimus at? Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit voluptates sint ab eligendi quidem illum libero, tempora enim dolore mollitia architecto eveniet aperiam incidunt adipisci? Recusandae neque quod minima! Asperiores. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque necessitatibus enim corporis impedit doloremque incidunt ex, ut nostrum vero temporibus at in, <br><br>
                architecto laudantium modi, quo dolor aperiam! Voluptatum, pariatur? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel ea a esse sint quibusdam rerum! Nemo, officiis recusandae expedita voluptatem doloribus voluptate ea quis voluptatibus doloremque mollitia maiores. Iusto, sapiente! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatibus, explicabo cumque veniam fugit natus alias ducimus voluptas facilis eaque, consequatur magni mollitia esse totam nihil, hic quisquam voluptate iusto illo! Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis quos ipsam optio delectus, <br><br>
            </p>
        </div>

        <!-- Slider1 -->
        @include('website_layouts.partials._AboutSlider1')


         <!-- about us section -->
         <div class="space-y-3 mt-10">
            <h4 class="text-sm text-red-500 text-center font-semibold">TEAM</h4>
            <h2 class="text-center text-[#1f1f1f] font-semibold text-2xl">Board Management</h2>            
        </div>


        <!-- Slider2 -->
        <div class="relative">
            @include('website_layouts.partials._AboutSlider2')

        </div>

    </div>

@endsection