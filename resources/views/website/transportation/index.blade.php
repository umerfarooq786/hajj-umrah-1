<!-- use Illuminate\Support\Str; -->
@extends('website_layouts.master')

@section('content')
    <div class="w-[95%] md:w-[70%] lg:w-[60%]  mx-auto space-y-10 my-20">
        @if ($vehicles->isNotEmpty())
            @foreach ($vehicles as $vehicle)
                @if ($vehicle->display == '1')
                    <span class="text-xl font-semibold text-gray-800">
                        {{ $vehicle->name }}
                    </span>
                    <div class="bg-gray-100 shadow-lg w-full min-h-[250px] h-max flex flex-col lg:flex-row items-center  ">
                        @foreach ($vehicle->images as $image)
                            <img src="{{ asset('uploads/' . $image->name) }}" alt=""
                                class="lg:h-[250px]  lg:w-[30%]  object-cover">
                        @endforeach
                        <div class="space-y-10 px-10 py-5 w-full">
                            @php $displayCount = 0; @endphp
                            @foreach ($vehicle->transport as $transport)
                                @if ($transport->display == '1')
                                    @php
                                        if ($displayCount >= 3) {
                                            // Check if the display count is already 3
                                            break; // Stop the loop if 3 are already displayed
                                        }
                                        $displayCount++; // Increment the counter
                                    @endphp
                                    <div class="space-y-1">
                                        <div class="w-full flex items-center justify-between">
                                            <span>{{ $transport->route->name }}</span>
                                            @php
                                                $lastCost = $transport->costs->last();
                                            @endphp
                                            <span>{{ $lastCost->cost }} (SAR)</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="space-y-1">
                                <div class="w-full flex items-center justify-between">
                                    <span>No Routes Available For This Transport Yet.</span>
                                </div>
                            </div>
                            <a href="transportation/1"
                                class="bg-[#9a1d21]  inline-block cursor-pointer text-white py-2 px-7 rounded-md hover:bg-opacity-90">View
                                Details</a>

                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        {{-- {{ $hotels->links() }} --}}

    </div>
@endsection
