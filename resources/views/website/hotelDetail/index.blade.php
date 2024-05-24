@extends('website_layouts.master')

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/hotelDetailSlider.css') }}">
    <style>
        .currency-content {
            display: none;
        }

        #contentSAR {
            display: block;
        }

        .failure-section {
            display: none;
        }

        .success-section-sar {
            display: none;
        }

        .success-section-usd {
            display: none;
        }

        .success-section-pkr {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="w-[95%] md:w-[80%] mx-auto space-y-10 my-20">

        <h2 class="font-semibold text-2xl">{{ $hotel->name }}</h2>
        <span class="text-gray1">Note: {{ $hotel->note }}</span>
        <div class="w-full h-[600px]">
            @include('website_layouts.partials._HotelDetailSlider1', ['hotel_images' => $hotel_images])
        </div>

        <div>
            <h4 class="font-semibold text-xl pb-3">{{ $hotel->excerpt }}</h4>
            <p>{!! $hotel->description !!}</p>
        </div>



        <select id="currencySelect"
            class="appearance-none w-[120px] cursor-pointer bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 leading-5 focus:outline-none focus:ring-0 focus:border-gray-300 sm:text-sm">
            <option value="SAR">SAR</option>
            <option value="USD">USD</option>
            <option value="PKR">PKR</option>
        </select>
        @if ($hotel_rooms->isNotEmpty())
            @if ($hotel->city == 'makkah')
                <div class="stay">
                    <div>
                        <h4 class="font-semibold text-[20px]">Accomodation Pricing</h4>
                        <form action="{{ route('search.makkahhotels') }}" class="flex gap-5 mt-5 ">
                            @csrf
                            <div class=" flex items-center relative lg:w-[150px]">
                                <input type="hidden" id="hotelId" value="{{ $hotel->id }}">
                                <input type="hidden" id="searched" value="0">
                                <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                <input type="text" id="start_date" name="makkah_hotel_start_date"
                                    placeholder="Start Date"
                                    class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                            </div>
                            <div class=" flex items-center relative lg:w-[150px]">
                                <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                <input type="text" id="end_date" name="makkah_hotel_end_date" placeholder="End Date"
                                    class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                            </div>
                            <select id="makkah_hotel_room_type" name="makkah_hotel_room_type"
                                class="place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 ">
                                <option value="">Select Room Type</option>
                                <option value="1">Single</option>
                                <option value="2">Double</option>
                                <option value="3">Triple</option>
                                <option value="4">Quad</option>
                            </select>
                            <button class="bg-[#c2242a] text-white py-2 px-5 rounded-md hover:bg-opacity-85">Search</button>
                        </form>
                    </div>
                    <br>
                    {{-- Accomodation Result Success section --}}
                    <div class="success-section-sar p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>

                    <div class="success-section-usd p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>

                    <div class="success-section-pkr p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>
                    {{-- Accommodation Result Failure section --}}
                    <div class="failure-section p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>

                    <div class="begin-section p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                        Accommodation Price Will Appear Here After Search. . .
                    </div>
                </div>
            @endif
            @if ($hotel->city == 'madinah')
                <div class="stay">
                    <div>
                        <h4 class="font-semibold text-[20px]">Accomodation Pricing</h4>
                        <form id="madinahform" action="{{ route('search.madinahhotels') }}" class="flex gap-5 mt-5 ">
                            @csrf
                            <div class=" flex items-center relative lg:w-[150px]">
                                <input type="hidden" id="hotelId" value="{{ $hotel->id }}">
                                <input type="hidden" id="searched" value="0">
                                <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                <input type="text" id="start_date" name="madinah_hotel_start_date"
                                    placeholder="Start Date"
                                    class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                            </div>
                            <div class=" flex items-center relative lg:w-[150px]">
                                <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                <input type="text" id="end_date" name="madinah_hotel_end_date" placeholder="End Date"
                                    class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                            </div>
                            <select id="madinah_hotel_room_type" name="madinah_hotel_room_type"
                                class="place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 ">
                                <option value="">Select Room Type</option>
                                <option value="1">Single</option>
                                <option value="2">Double</option>
                                <option value="3">Triple</option>
                                <option value="4">Quad</option>
                            </select>
                            <button class="bg-[#c2242a] text-white py-2 px-5 rounded-md hover:bg-opacity-85">Search</button>
                        </form>
                    </div>
                    <br>
                    {{-- Accomodation Result Success section --}}
                    <div class="success-section-sar p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>

                    <div class="success-section-usd p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>

                    <div class="success-section-pkr p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>
                    {{-- Accommodation Result Failure section --}}
                    <div class="failure-section p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>

                    <div class="begin-section p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                        Accommodation Price Will Appear Here After Search. . .
                    </div>
                </div>
            @endif

            @if ($hotel->city == 'jeddah')
                <div class="stay">
                    <div>
                        <h4 class="font-semibold text-[20px]">Accomodation Pricing</h4>
                        <form id="jeddahform" action="{{ route('search.jeddahhotels') }}" class="flex gap-5 mt-5 ">
                            @csrf
                            <div class=" flex items-center relative lg:w-[150px]">
                                <input type="hidden" id="hotelId" value="{{ $hotel->id }}">
                                <input type="hidden" id="searched" value="0">
                                <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                <input type="text" id="start_date" name="jeddah_hotel_start_date"
                                    placeholder="Start Date"
                                    class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                            </div>
                            <div class=" flex items-center relative lg:w-[150px]">
                                <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                <input type="text" id="end_date" name="jeddah_hotel_end_date" placeholder="End Date"
                                    class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                            </div>
                            <select id="jeddah_hotel_room_type" name="jeddah_hotel_room_type"
                                class="place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 ">
                                <option value="">Select Room Type</option>
                                <option value="1">Single</option>
                                <option value="2">Double</option>
                                <option value="3">Triple</option>
                                <option value="4">Quad</option>
                            </select>
                            <button
                                class="bg-[#c2242a] text-white py-2 px-5 rounded-md hover:bg-opacity-85">Search</button>
                        </form>
                    </div>
                    <br>
                    {{-- Accomodation Result Success section --}}
                    <div class="success-section-sar p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>

                    <div class="success-section-usd p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>

                    <div class="success-section-pkr p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>
                    {{-- Accommodation Result Failure section --}}
                    <div class="failure-section p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                    </div>

                    <div class="begin-section p-5 rounded-2xl w-[60%] border border-gray-200 text-center">
                        Accommodation Price Will Appear Here After Search. . .
                    </div>
                </div>
            @endif
        @endif

        <div id="contentSAR" class="currency-content">
            <br>
            @if ($meals->isNotEmpty())
                <div>
                    <h4 class="font-semibold text-[20px]">Meals Pricing (Single Person)</h4>
                    <div class="relative overflow-x-auto w-[60%] border border-gray-200 self-start mt-3">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-900 dark:text-white">
                                <tr>
                                    <th class="px-6 py-4 font-bold whitespace-nowrap">
                                        Type
                                    </th>
                                    <th class="px-6 py-4 font-bold whitespace-nowrap">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meals as $meal)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap dark:text-white font-medium">
                                            {{ $meal->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap dark:text-white font-medium">
                                            {{ $meal->price }} (SAR)
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        <div id="contentUSD" class="currency-content">
            {{-- Meals Pricing Section --}}
            <br>
            @if ($meals->isNotEmpty())
                <div>
                    <h4 class="font-semibold text-[20px]">Meals Pricing (Single Person)</h4>
                    <div class="relative overflow-x-auto w-[60%] border border-gray-200 self-start mt-3">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-900 dark:text-white">
                                <tr>
                                    <th class="px-6 py-4 font-bold whitespace-nowrap">
                                        Type
                                    </th>
                                    <th class="px-6 py-4 font-bold whitespace-nowrap">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meals as $meal)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap dark:text-white font-medium">
                                            {{ $meal->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap dark:text-white font-medium">
                                            {{ $meal->price * $sar_to_usd }} (USD)
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        <div id="contentPKR" class="currency-content">
            {{-- Meals Pricing Section --}}
            <br>
            @if ($meals->isNotEmpty())
                <div>
                    <h4 class="font-semibold text-[20px]">Meals Pricing (Single Person)</h4>
                    <div class="relative overflow-x-auto w-[60%] border border-gray-200 self-start mt-3">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-900 dark:text-white">
                                <tr>
                                    <th class="px-6 py-4 font-bold whitespace-nowrap">
                                        Type
                                    </th>
                                    <th class="px-6 py-4 font-bold whitespace-nowrap">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meals as $meal)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap dark:text-white font-medium">
                                            {{ $meal->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap dark:text-white font-medium">
                                            {{ $meal->price * $sar_to_pkr }} (PKR)
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>


        <div class="flex">
            {!! $hotel->google_map !!}
        </div>
    </div>



    <script>
        
    </script>
    <script>
        const initialFields = document.querySelectorAll('.stay');
        const initFlatpickr = function(element) {
            const startDateInput = flatpickr(element.querySelector(".startDate"), {
                minDate: "today",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    endDateInput.disabled = false;

                    const minEndDate = instance.selectedDates[0];
                    minEndDate.setDate(minEndDate.getDate() + 1);
                    endDateInput.set("minDate", minEndDate);
                }
            });

            const endDateInput = flatpickr(element.querySelector(".endDate"), {
                dateFormat: "Y-m-d",
                disable: [new Date()],
            });
        };

        initialFields.forEach(initFlatpickr);

        document.getElementById('currencySelect').addEventListener('change', function() {
            // Hide all divs first
            document.querySelectorAll('.currency-content').forEach(function(div) {
                div.style.display = 'none';
            });

            // Show the div corresponding to the selected currency
            var selectedCurrency = this.value;
            var sarText = $('#searched').val();
            if (sarText == "1") {
                if (selectedCurrency == 'SAR') {
                    $('.success-section-sar').show();
                    $('.success-section-pkr').hide();
                    $('.success-section-usd').hide();
                }
                if (selectedCurrency == 'USD') {
                    $('.success-section-sar').hide();
                    $('.success-section-pkr').hide();
                    $('.success-section-usd').show();
                }
                if (selectedCurrency == 'PKR') {
                    $('.success-section-sar').hide();
                    $('.success-section-pkr').show();
                    $('.success-section-usd').hide();
                }
            }
            document.getElementById('content' + selectedCurrency).style.display = 'block';
        });
    </script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                var room = $('#makkah_hotel_room_type').val();
                if (startDate === "" || endDate === "" || room === "") {
                    $('.failure-section').html(
                        "Please Select All Dropdown Values To Get Calculated Result.");
                    $('.failure-section').show();
                    $('.success-section-sar').hide();
                    $('.begin-section').hide();
                    $('#searched').val('0');
                } else {

                    $('.success-section-sar').hide();
                    $('.success-section-pkr').hide();
                    $('.success-section-usd').hide();
                    $('.failure-section').hide();
                    var formData = $(this).serialize(); // Serialize form data
                    var hotelId = $('#hotelId').val(); // Get the value of the hidden input field

                    // Append the hotelId to the formData
                    formData += '&hotel_id=' + hotelId; // Make AJAX request
                    $.ajax({
                        url: '{{ route('search.makkahhotels') }}',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle success response
                            // Example: Display a success message
                            if (response) {
                                console.log(response);
                                if (response.price) {
                                    var formattedSAR = response.price.toFixed(1);
                                    var pkr = response.sar_to_pkr * response.price;
                                    var formattedPKR = pkr.toFixed(1);
                                    var usd = response.sar_to_usd * response.price;
                                    var formattedUSD = usd.toFixed(1);
                                    $('.success-section-sar').html(
                                        'Accommodation price between the selected range is <b>' +
                                        formattedSAR + ' (SAR)</b>');
                                    $('.success-section-pkr').html(
                                        'Accommodation price between the selected range is <b>' +
                                        formattedPKR + ' (PKR)</b>');
                                    $('.success-section-usd').html(
                                        'Accommodation price between the selected range is <b>' +
                                        formattedUSD + ' (USD)</b>');
                                    $('.success-section-sar').show(); // Hide failure section
                                    $('.failure-section').hide(); // Hide failure section
                                    $('.begin-section').hide();
                                    $('#searched').val('1');
                                }
                                if (response.result) {
                                    $('.failure-section').html(response.result);
                                    $('.failure-section').show();
                                    $('.success-section-sar').hide();
                                    $('.begin-section').hide();
                                    $('#searched').val('0');
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.error(xhr.responseText);
                            // Display error message
                            $('.failure-section').html(
                                'An error occurred while processing the request');
                            $('.success-section').hide(); // Hide success section
                        }
                    });
                }
            });
            $('#madinahform').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                var room = $('#madinah_hotel_room_type').val();
                if (startDate === "" || endDate === "" || room === "") {
                    $('.failure-section').html(
                        "Please Select All Dropdown Values To Get Calculated Result.");
                    $('.failure-section').show();
                    $('.success-section-sar').hide();
                    $('.begin-section').hide();
                    $('#searched').val('0');
                } else {
                    $('.success-section-sar').hide();
                    $('.success-section-pkr').hide();
                    $('.success-section-usd').hide();
                    $('.failure-section').hide();
                    var formData = $(this).serialize(); // Serialize form data
                    var hotelId = $('#hotelId').val(); // Get the value of the hidden input field

                    // Append the hotelId to the formData
                    formData += '&hotel_id=' + hotelId; // Make AJAX request
                    console.log(formData);
                    $.ajax({
                        url: '{{ route('search.madinahhotels') }}',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle success response
                            // Example: Display a success message
                            if (response) {
                                console.log(response);
                                if (response.price) {
                                    var formattedSAR = response.price.toFixed(1);
                                    var pkr = response.sar_to_pkr * response.price;
                                    var formattedPKR = pkr.toFixed(1);
                                    var usd = response.sar_to_usd * response.price;
                                    var formattedUSD = usd.toFixed(1);
                                    $('.success-section-sar').html(
                                        'Accommodation price between the selected range is <b>' +
                                        formattedSAR + ' (SAR)</b>');
                                    $('.success-section-pkr').html(
                                        'Accommodation price between the selected range is <b>' +
                                        formattedPKR + ' (PKR)</b>');
                                    $('.success-section-usd').html(
                                        'Accommodation price between the selected range is <b>' +
                                        formattedUSD + ' (USD)</b>');
                                    $('.success-section-sar').show(); // Hide failure section
                                    $('.failure-section').hide(); // Hide failure section
                                    $('.begin-section').hide();
                                    $('#searched').val('1');
                                }
                                if (response.result) {
                                    $('.failure-section').html(response.result);
                                    $('.failure-section').show();
                                    $('.success-section-sar').hide();
                                    $('.begin-section').hide();
                                    $('#searched').val('0');
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.error(xhr.responseText);
                            // Display error message
                            $('.failure-section').html(
                                'An error occurred while processing the request');
                            $('.success-section').hide(); // Hide success section
                        }
                    });
                }
            });

            $('#jeddahform').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                var room = $('#jeddah_hotel_room_type').val();
                if (startDate === "" || endDate === "" || room === "") {
                    $('.failure-section').html(
                        "Please Select All Dropdown Values To Get Calculated Result.");
                    $('.failure-section').show();
                    $('.success-section-sar').hide();
                    $('.begin-section').hide();
                    $('#searched').val('0');
                } else {
                    $('.success-section-sar').hide();
                    $('.success-section-pkr').hide();
                    $('.success-section-usd').hide();
                    $('.failure-section').hide();
                    var formData = $(this).serialize(); // Serialize form data
                    var hotelId = $('#hotelId').val(); // Get the value of the hidden input field

                    // Append the hotelId to the formData
                    formData += '&hotel_id=' + hotelId; // Make AJAX request
                    console.log(formData);
                    $.ajax({
                        url: '{{ route('search.jeddahhotels') }}',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle success response
                            // Example: Display a success message
                            if (response) {
                                console.log(response);
                                if (response.price) {
                                    var formattedSAR = response.price.toFixed(1);
                                    var pkr = response.sar_to_pkr * response.price;
                                    var formattedPKR = pkr.toFixed(1);
                                    var usd = response.sar_to_usd * response.price;
                                    var formattedUSD = usd.toFixed(1);
                                    $('.success-section-sar').html(
                                        'Accommodation price between the selected range is <b>' +
                                        formattedSAR + ' (SAR)</b>');
                                    $('.success-section-pkr').html(
                                        'Accommodation price between the selected range is <b>' +
                                        formattedPKR + ' (PKR)</b>');
                                    $('.success-section-usd').html(
                                        'Accommodation price between the selected range is <b>' +
                                        formattedUSD + ' (USD)</b>');
                                    $('.success-section-sar').show(); // Hide failure section
                                    $('.failure-section').hide(); // Hide failure section
                                    $('.begin-section').hide();
                                    $('#searched').val('1');
                                }
                                if (response.result) {
                                    $('.failure-section').html(response.result);
                                    $('.failure-section').show();
                                    $('.success-section-sar').hide();
                                    $('.begin-section').hide();
                                    $('#searched').val('0');
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.error(xhr.responseText);
                            // Display error message
                            $('.failure-section').html(
                                'An error occurred while processing the request');
                            $('.success-section').hide(); // Hide success section
                        }
                    });
                }
            });
        });
    </script>

@endsection
