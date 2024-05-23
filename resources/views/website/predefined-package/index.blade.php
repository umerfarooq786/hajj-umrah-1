@extends('website_layouts.master')

@section('content')
    <div class="w-[95%] md:w-[80%]  mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 my-20">

        @foreach ($packages as $package)
            <div class="h-[500px] w-full">
                <h2 class="font-semibold">{{ $package->name }}</h2>
                {{-- <img src="{{ asset('uploads/' . $package->image) }}" class="h-full w-full object-contain" alt=""> --}}
                <a href="{{ asset('uploads/' . $package->image) }}" data-lightbox="gallery">
                    {{-- <img src="{{ asset('storage/' . $image->path) }}" alt="Image" class="w-32 h-32 object-cover cursor-pointer"> --}}
                    <img src="{{ asset('uploads/' . $package->image) }}" class="h-full w-full object-contain" alt="">
                </a>
            </div>
        @endforeach
    </div>
@endsection


@section('script')
@endsection
