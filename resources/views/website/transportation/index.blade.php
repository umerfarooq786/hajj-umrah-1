<!-- use Illuminate\Support\Str; -->
@extends('website_layouts.master')

@section('content')
    <div class="w-[95%] md:w-[70%] lg:w-[60%]  mx-auto space-y-10 my-20">
        <div class="bg-gray-100 shadow-lg w-full min-h-[250px] h-max flex flex-col lg:flex-row items-center  ">
            <img src="{{ asset('images/hotels/default-hotel.jpg') }}" alt=""
                class="lg:h-[250px]  lg:w-[30%]  object-cover">

            <div class="space-y-10 px-10 py-5 w-full">
                <div class="space-y-1">
                    <div class=" w-full flex items-center justify-between">
                        <span>Route A - B</span>
                        <span>100 (SAR)</span>
                    </div>
                    <div class=" w-full flex items-center justify-between">
                        <span>Route A - B</span>
                        <span>100 (SAR)</span>
                    </div>
                    <div class=" w-full flex items-center justify-between">
                        <span>Route A - B</span>
                        <span>100 (SAR)</span>
                    </div>
                </div>

                <a href="transportation/1"
                    class="bg-[#9a1d21]  inline-block cursor-pointer text-white py-2 px-7 rounded-md hover:bg-opacity-90">View
                    Details</a>

            </div>
        </div>


        {{-- {{ $hotels->links() }} --}}

    </div>
@endsection
