@extends('website_layouts.master')

@section('custom_styles')
@endsection

@section('content')
    <div>
        <p><b>Total Cost:</b> {{ $total_cost }} SAR</p>
        <p><b>Hotel Room Price:</b> {{ $hotel_room_price }} SAR</p>
        <p><b>Hotel Room Per Day Price:</b> {{ $hotel_room_perday_price }} SAR</p>
        <p><b>Transport Cost:</b> {{ $transport_cost }} SAR</p>
        <p><b>Visa Cost:</b> {{ $visa }} SAR</p>
    </div>
@endsection
