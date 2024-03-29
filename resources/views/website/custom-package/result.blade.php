@extends('website_layouts.master')

@section('custom_styles')
    <!-- Any custom styles go here -->
@endsection

@section('content')
    <div class="w-[80%] mx-auto py-10">
        <h2 class="text-green-600">Note: The rates may vary, kindly contact admin by clicking 
            <a href="/contact" class="text-red-600">this link</a> </h2>
            
        <!-- Currency selection dropdown -->
        <select id="currencySelect">
            <option value="SAR">SAR</option>
            <option value="USD">USD</option>
            <option value="PKR">PKR</option>
        </select>

        <!-- Displayed costs -->
        <p id="totalCost"><b>Total Cost:</b> {{ $total_cost }} SAR</p>
        @if ($makkah_hotel_room_price != '0')
            <p id="makahHotelRoomPrice"><b>Makkah Hotel Room Price:</b> {{ $makkah_hotel_room_price }} SAR</p>
            <p id="makkahHotelRoomPriceDay"><b>Makkah Hotel Room Per Day Price:</b> {{ $makkah_hotel_room_perday_price }} SAR
            </p>
        @endif
        @if ($madinah_hotel_room_price != '0')
            <p id="madinahHotelRoomPrice"><b>Madinah Hotel Room Price:</b> {{ $madinah_hotel_room_price }} SAR</p>
            <p id="madinahHotelRoomPriceDay"><b>Madinah Hotel Room Per Day Price:</b> {{ $madinah_hotel_room_perday_price }}
                SAR</p>
        @endif
        <p id="mealPrices"><b>Meal Cost:</b> {{ $mealPrices }} SAR</p>
        <p id="transportPrice"><b>Transport Cost:</b> {{ $transport_cost }} SAR</p>
        <p id="visa"><b>Visa Cost:</b> {{ $visa }} SAR</p>
        <p id="visa_per_person"><b>Visa Cost Per Person:</b> {{ $visa_per_person }} SAR</p>
    </div>

    <!-- JavaScript for currency conversion -->
    <script>
        // Add event listener for currency selection dropdown
        document.getElementById('currencySelect').addEventListener('change', function() {
            // Get the selected currency
            var selectedCurrency = this.value;

            // Perform calculations based on the selected currency
            switch (selectedCurrency) {
                case 'USD':
                    // Convert costs to USD based on the conversion rate
                    usd_price = {{ $sar_to_usd }};
                    total_cost = {{ $total_cost }} * usd_price;
                    makkah_hotel_room_price = {{ $makkah_hotel_room_price }} * usd_price;
                    makkah_hotel_room_perday_price = {{ $makkah_hotel_room_perday_price }} * usd_price;
                    madinah_hotel_room_price = {{ $madinah_hotel_room_price }} * usd_price;
                    madinah_hotel_room_perday_price = {{ $madinah_hotel_room_perday_price }} * usd_price;
                    transport_cost = {{ $transport_cost }} * usd_price;
                    mealPrices = {{ $mealPrices }} * usd_price;
                    visa = {{ $visa }} * usd_price;
                    visa_per_person = {{ $visa_per_person }} * usd_price;
                    // Adjust other costs accordingly
                    break;
                case 'PKR':
                    // Convert costs to PKR based on the conversion rate
                    pkr_price = {{ $sar_to_pkr }};
                    total_cost = {{ $total_cost }} * pkr_price;
                    makkah_hotel_room_price = {{ $makkah_hotel_room_price }} * pkr_price;
                    makkah_hotel_room_perday_price = {{ $makkah_hotel_room_perday_price }} * pkr_price;
                    madinah_hotel_room_price = {{ $madinah_hotel_room_price }} * pkr_price;
                    madinah_hotel_room_perday_price = {{ $madinah_hotel_room_perday_price }} * pkr_price;
                    mealPrices = {{ $mealPrices }} * pkr_price;
                    transport_cost = {{ $transport_cost }} * pkr_price;
                    visa = {{ $visa }} * pkr_price;
                    visa_per_person = {{ $visa_per_person }} * pkr_price;
                    // Adjust other costs accordingly
                    break;
                case 'SAR':
                    // Convert costs to PKR based on the conversion rate
                    total_cost = {{ $total_cost }};
                    makkah_hotel_room_price = {{ $makkah_hotel_room_price }} ;
                    makkah_hotel_room_perday_price = {{ $makkah_hotel_room_perday_price }} ;
                    madinah_hotel_room_price = {{ $madinah_hotel_room_price }} ;
                    madinah_hotel_room_perday_price = {{ $madinah_hotel_room_perday_price }} ;
                    mealPrices = {{ $mealPrices }};
                    transport_cost = {{ $transport_cost }};
                    visa = {{ $visa }};
                    visa_per_person = {{ $visa_per_person }};
                    // Adjust other costs accordingly
                    break;
                    // SAR is the default currency, no conversion needed
                default:
                    break;
            }

            // Update the displayed costs on the page
            document.getElementById('totalCost').innerHTML = '<b>Total Cost:</b> ' + total_cost.toFixed(2) + ' ' +
                selectedCurrency;
            document.getElementById('makahHotelRoomPrice').innerHTML = '<b>Makkah Hotel Room Price:</b> ' +
                makkah_hotel_room_price
                .toFixed(2) + ' ' + selectedCurrency;
            document.getElementById('makkahHotelRoomPriceDay').innerHTML =
                '<b>Makkah Hotel Room Per Day Price:</b> ' +
                makkah_hotel_room_perday_price.toFixed(2) + ' ' + selectedCurrency;
            document.getElementById('madinahHotelRoomPrice').innerHTML = '<b>Madinah Hotel Room Price:</b> ' +
                madinah_hotel_room_price
                .toFixed(2) + ' ' + selectedCurrency;
            document.getElementById('madinahHotelRoomPriceDay').innerHTML =
                '<b>Makkah Hotel Room Per Day Price:</b> ' +
                madinah_hotel_room_perday_price.toFixed(2) + ' ' + selectedCurrency;
            document.getElementById('mealPrices').innerHTML = '<b>Meal Cost:</b> ' + mealPrices
                .toFixed(2) + ' ' + selectedCurrency;
            document.getElementById('transportPrice').innerHTML = '<b>Transport Cost:</b> ' + transport_cost
                .toFixed(2) + ' ' + selectedCurrency;
            document.getElementById('visa').innerHTML = '<b>Visa Cost:</b> ' + visa.toFixed(2) + ' ' +
                selectedCurrency;
            document.getElementById('visa_per_person').innerHTML = '<b>Visa Cost Per Person:</b> ' + visa_per_person.toFixed(2) + ' ' +
                selectedCurrency;   
            // Update other cost elements accordingly
        });
    </script>
@endsection

