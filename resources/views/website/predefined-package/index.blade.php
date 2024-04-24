@extends('website_layouts.master')

@section('content')
    <div class="w-[95%] md:w-[80%]  mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 my-20">

        @foreach ($packages as $package)
            <img src="{{ asset('uploads/' . $package->image) }}" class="h-[500px] object-contain" alt="">
        @endforeach
    </div>
@endsection


@section('script')
@endsection
