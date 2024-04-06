@extends('website_layouts.master')

@section('custom_styles')
    <!-- Any custom styles go here -->
@endsection

@section('content')
    <div class="w-[80%] mx-auto py-10">
        <h2 class="text-green-600">Note: The rates may vary, kindly contact admin by clicking
            <a href="/contact" class="text-red-600">this link</a>
        </h2>

        <!-- Currency selection dropdown -->
        <select id="currencySelect">
            <option value="SAR">SAR</option>
            <option value="USD">USD</option>
            <option value="PKR">PKR</option>
        </select>



        <div class="relative overflow-x-auto">
            <table class="w-[500px] text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Total Cost
                        </th>
                        <td class="px-6 py-4" id="totalCost">
                            {{ $total_cost }} SAR
                        </td>
                    </tr>
                    @if ($makkah_hotel_room_price != '0')
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Makkah Hotel Room Price
                            </th>
                            <td class="px-6 py-4" id="makahHotelRoomPrice">
                                {{ $makkah_hotel_room_price }} SAR
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Makkah Hotel Room Per Day Price
                            </th>
                            <td class="px-6 py-4" id="makkahHotelRoomPriceDay">
                                {{ $makkah_hotel_room_perday_price }} SAR
                            </td>
                        </tr>
                    @endif

                    @if ($madinah_hotel_room_price != '0')
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Madinah Hotel Room Price
                            </th>
                            <td class="px-6 py-4" id="madinahHotelRoomPrice">
                                {{ $madinah_hotel_room_price }} SAR
                            </td>

                        </tr>
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Madinah Hotel Room Per Day Price
                            </th>
                            <td class="px-6 py-4" id="madinahHotelRoomPriceDay">
                                {{ $madinah_hotel_room_perday_price }} SAR
                            </td>
                        </tr>
                    @endif

                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Meal Cost
                        </th>
                        <td class="px-6 py-4" id="mealPrices">
                            {{ $mealPrices }} SAR
                        </td>
                    </tr>

                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Transport Cost
                        </th>
                        <td class="px-6 py-4" id="transportPrice">
                            {{ $transport_cost }} SAR
                        </td>
                    </tr>

                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Visa Cost
                        </th>
                        <td class="px-6 py-4" id="visa">
                            {{ $visa }} SAR
                        </td>
                    </tr>

                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Visa Cost Per Person
                        </th>
                        <td class="px-6 py-4" id="visa_per_person">
                            {{ $visa_per_person }} SAR
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- JavaScript for currency conversion -->
    <script>
        document.getElementById('currencySelect').addEventListener('change', function() {
            var selectedCurrency = this.value;

            switch (selectedCurrency) {
                case 'USD':
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
                    break;
                case 'PKR':
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
                    break;
                case 'SAR':
                    total_cost = {{ $total_cost }};
                    makkah_hotel_room_price = {{ $makkah_hotel_room_price }};
                    makkah_hotel_room_perday_price = {{ $makkah_hotel_room_perday_price }};
                    madinah_hotel_room_price = {{ $madinah_hotel_room_price }};
                    madinah_hotel_room_perday_price = {{ $madinah_hotel_room_perday_price }};
                    mealPrices = {{ $mealPrices }};
                    transport_cost = {{ $transport_cost }};
                    visa = {{ $visa }};
                    visa_per_person = {{ $visa_per_person }};
                    break;
                default:
                    break;
            }

            document.getElementById('totalCost').innerHTML = total_cost.toFixed(2) + ' ' +
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
            document.getElementById('visa_per_person').innerHTML = '<b>Visa Cost Per Person:</b> ' + visa_per_person
                .toFixed(2) + ' ' +
                selectedCurrency;
            Update other cost elements accordingly
        });
    </script>
@endsection
