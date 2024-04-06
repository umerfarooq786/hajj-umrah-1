@extends('website_layouts.master')

@section('custom_styles')
    <!-- Any custom styles go here -->
@endsection

@section('content')
    <div class="w-[95%] md:w-[80%] lg:w-[60%] mx-auto py-10 flex flex-col items-center justify-start gap-5 ">
        <h2 class="text-green-600">Note: The rates may vary, kindly contact admin by clicking
            <a href="/contact" class="text-red-600">this link</a>
        </h2>

        <!-- Currency selection dropdown -->
        <div class=" w-full flex items-center justify-between px-6">
            <select id="currencySelect"
                class="appearance-none w-[120px] cursor-pointer bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 leading-5 focus:outline-none focus:ring-0 focus:border-gray-300 sm:text-sm">
                <option value="SAR">SAR</option>
                <option value="USD">USD</option>
                <option value="PKR">PKR</option>
            </select>
            <button class="bg-[#c02428] text-white py-2 px-5 rounded-md hover:bg-opacity-80">Download</button>
        </div>


        {{-- table starts --}}
        <div class="relative overflow-x-auto w-full">
            <table class="w-full  text-sm text-left rtl:text-right text-gray-500  ">
                <tbody>
                    <tr class="bg-white border-b  ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            Total Cost
                        </th>
                        <td class="px-6 py-4 text-right" id="totalCost">
                            {{ $total_cost }} SAR
                        </td>
                    </tr>
                    @if ($makkah_hotel_room_price != '0')
                        <tr class="bg-white border-b  ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                Makkah Hotel Room Price
                            </th>
                            <td class="px-6 py-4 text-right" id="makahHotelRoomPrice">
                                {{ $makkah_hotel_room_price }} SAR
                            </td>
                        </tr>
                        <tr class="bg-white border-b  ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                Makkah Hotel Room Per Day Price
                            </th>
                            <td class="px-6 py-4 text-right" id="makkahHotelRoomPriceDay">
                                {{ $makkah_hotel_room_perday_price }} SAR
                            </td>
                        </tr>
                    @endif

                    @if ($madinah_hotel_room_price != '0')
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                Madinah Hotel Room Price
                            </th>
                            <td class="px-6 py-4 text-right" id="madinahHotelRoomPrice">
                                {{ $madinah_hotel_room_price }} SAR
                            </td>

                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                Madinah Hotel Room Per Day Price
                            </th>
                            <td class="px-6 py-4 text-right" id="madinahHotelRoomPriceDay">
                                {{ $madinah_hotel_room_perday_price }} SAR
                            </td>
                        </tr>
                    @endif

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            Meal Cost
                        </th>
                        <td class="px-6 py-4 text-right" id="mealPrices">
                            {{ $mealPrices }} SAR
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            Transport Cost
                        </th>
                        <td class="px-6 py-4 text-right" id="transportPrice">
                            {{ $transport_cost }} SAR
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            Visa Cost
                        </th>
                        <td class="px-6 py-4 text-right" id="visa">
                            {{ $visa }} SAR
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            Visa Cost Per Person
                        </th>
                        <td class="px-6 py-4 text-right" id="visa_per_person">
                            {{ $visa_per_person }} SAR
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Displayed costs -->
        {{-- <p id="totalCost"><b>Total Cost:</b> {{ $total_cost }} SAR</p>
        @if ($makkah_hotel_room_price != '0')
            <p id="makahHotelRoomPrice"><b>Makkah Hotel Room Price:</b> {{ $makkah_hotel_room_price }} SAR</p>
            <p id="makkahHotelRoomPriceDay"><b>Makkah Hotel Room Per Day Price:</b> {{ $makkah_hotel_room_perday_price }}
                SAR
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
        <p id="visa_per_person"><b>Visa Cost Per Person:</b> {{ $visa_per_person }} SAR</p> --}}
    </div>

    <!-- JavaScript for currency conversion -->
    <script>
        // Add event listener for currency selection dropdown


        document.getElementById('currencySelect').addEventListener('change', function() {
            let totalCost, makahHotelRoomPrice, makkahHotelRoomPriceDay, madinahHotelRoomPrice,
                madinahHotelRoomPriceDay,
                mealPrices, transportPrice, visa, visa_per_person = 0;

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
                    makkah_hotel_room_price = {{ $makkah_hotel_room_price }};
                    makkah_hotel_room_perday_price = {{ $makkah_hotel_room_perday_price }};
                    madinah_hotel_room_price = {{ $madinah_hotel_room_price }};
                    madinah_hotel_room_perday_price = {{ $madinah_hotel_room_perday_price }};
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
            let totalCostElement = document.getElementById('totalCost');
            let makahHotelRoomPriceElement = document.getElementById('makahHotelRoomPrice');
            let makkahHotelRoomPriceDayElement = document.getElementById('makkahHotelRoomPriceDay');
            let madinahHotelRoomPriceElement = document.getElementById('madinahHotelRoomPrice');
            let madinahHotelRoomPriceDayElement = document.getElementById('madinahHotelRoomPriceDay');
            let mealPricesElement = document.getElementById('mealPrices');
            let transportPriceElement = document.getElementById('transportPrice');
            let visaElement = document.getElementById('visa');
            let visa_per_personElement = document.getElementById('visa_per_person');

            if (totalCostElement) {
                totalCostElement.innerHTML = total_cost.toFixed(0) + ' ' + selectedCurrency;
            }
            if (makahHotelRoomPriceElement) {
                makahHotelRoomPriceElement.innerHTML = makkah_hotel_room_price
                    .toFixed(0) + ' ' + selectedCurrency;
            }
            if (makkahHotelRoomPriceDayElement) {
                makkahHotelRoomPriceDayElement.innerHTML = makkah_hotel_room_perday_price.toFixed(0) + ' ' +
                    selectedCurrency;

            }
            if (madinahHotelRoomPriceElement) {
                madinahHotelRoomPriceElement.innerHTML = madinah_hotel_room_price.toFixed(0) + ' ' +
                    selectedCurrency;
            }
            if (madinahHotelRoomPriceDayElement) {
                madinahHotelRoomPriceDayElement.innerHTML = madinah_hotel_room_perday_price.toFixed(0) + ' ' +
                    selectedCurrency;
            }
            if (mealPricesElement) {
                mealPricesElement.innerHTML = mealPrices.toFixed(0) + ' ' + selectedCurrency;
            }
            if (transportPriceElement) {
                transportPriceElement.innerHTML = transport_cost.toFixed(0) + ' ' + selectedCurrency;
            }
            if (visaElement) {
                visaElement.innerHTML = visa.toFixed(0) + ' ' + selectedCurrency;
            }
            if (visa_per_personElement) {
                visa_per_personElement.innerHTML = visa_per_person.toFixed(0) + ' ' + selectedCurrency;
            }
            // Update other cost elements accordingly
        });
    </script>
@endsection
