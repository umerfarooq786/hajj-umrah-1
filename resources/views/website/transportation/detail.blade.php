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
        <h2 class="font-semibold text-2xl">{{ $vehicle->name }} ({{ $vehicle->capacity }}-person)</h2>
        <div class="w-full h-[600px]">
            @include('website_layouts.partials._HotelDetailSlider2')
        </div>

        <select id="currencySelect"
            class="appearance-none w-[120px] cursor-pointer bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 leading-5 focus:outline-none focus:ring-0 focus:border-gray-300 sm:text-sm">
            <option value="SAR">SAR</option>
            <option value="USD">USD</option>
            <option value="PKR">PKR</option>
        </select>

        {{-- Routes Pricing Section --}}
        {{-- <div id="contentSAR" class="currency-content">
            <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start mt-3">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        @if ($vehicle->transport)
                            @foreach ($vehicle->transport as $transport)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Route
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Rate
                                    </th>
                                </tr>
                                @if ($transport->display == '1')
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                            {{ $transport->route->name }}
                                        </th>
                                        @php
                                            $lastCost = $transport->costs->last();
                                        @endphp
                                        <th scope="row"
                                            class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                            {{ $lastCost->cost }} (SAR)
                                        </th>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <div class="space-y-1">
                                <div class="w-full flex items-center justify-between">
                                    <span>No Routes Available For This Transport Yet.</span>
                                </div>
                            </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div id="contentUSD" class="currency-content">
            <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start mt-3">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        @if ($vehicle->transport)
                            @foreach ($vehicle->transport as $transport)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Route
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Rate
                                    </th>
                                </tr>
                                @if ($transport->display == '1')
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                            {{ $transport->route->name }}
                                        </th>
                                        @php
                                            $lastCost = $transport->costs->last();
                                        @endphp
                                        <th scope="row"
                                            class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                            {{ $lastCost->cost * $sar_to_usd}} (USD)
                                        </th>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <div class="space-y-1">
                                <div class="w-full flex items-center justify-between">
                                    <span>No Routes Available For This Transport Yet.</span>
                                </div>
                            </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div id="contentPKR" class="currency-content">
            <div class="relative overflow-x-auto w-[60%] border border-gray1 self-start mt-3">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        @if ($vehicle->transport)
                            @foreach ($vehicle->transport as $transport)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Route
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                                        Rate
                                    </th>
                                </tr>
                                @if ($transport->display == '1')
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                            {{ $transport->route->name }}
                                        </th>
                                        @php
                                            $lastCost = $transport->costs->last();
                                        @endphp
                                        <th scope="row"
                                            class="px-6 py-4  text-gray-900 whitespace-nowrap dark:text-white font-medium">
                                            {{ $lastCost->cost * $sar_to_pkr}} (PKR)
                                        </th>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <div class="space-y-1">
                                <div class="w-full flex items-center justify-between">
                                    <span>No Routes Available For This Transport Yet.</span>
                                </div>
                            </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div> --}}

        <div>
            <div>
                <div>
                    <h4 class="font-semibold text-[20px]">Transport Pricing</h4>
                    <input type="hidden" id="searched" name="searched" value="0">
                    <form id="transport-pricing-form" action="{{ route('search.route_price') }}" method="POST"
                        class="mt-5">
                        @csrf
                        <div id="form-container">
                            <div class="transport-form flex gap-5 mb-3">
                                <div class="flex items-center relative lg:w-[150px]">
                                    <input type="hidden" id="vehicle_id" name="vehicle_id[]" value="{{ $vehicle->id }}">
                                    <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                    <input type="text" id="start_date" name="start_date[]" placeholder="Start Date"
                                        class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400"
                                        required>
                                </div>

                                <select id="route" name="route[]"
                                    class="place lg:w-[180px] border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                    <option value="">Select Route</option>
                                    @if ($vehicle->transport)
                                        @foreach ($vehicle->transport as $transport)
                                            @if ($transport->display == '1')
                                                <option value="{{ $transport->route->id }}">{{ $transport->route->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <button type="button"
                                    class="remove-form bg-red-500 text-white py-2 px-5 rounded-md hover:bg-opacity-85">Remove</button>
                            </div>
                        </div>
                        <button type="button" id="add-more"
                            class="bg-gray-500 text-white py-2 px-5 rounded-md hover:bg-opacity-85">Add More</button>
                        <button type="submit"
                            class="bg-[#c2242a] text-white py-2 px-5 rounded-md hover:bg-opacity-85 mt-3">Search</button>
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

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr for the initial start date input
            flatpickr(".startDate", {
                dateFormat: "d-m-Y",
                minDate: "today",
            });

            function initializeFlatpickr(input) {
                flatpickr(input, {
                    dateFormat: "d-m-Y",
                    minDate: "today",
                });
            }

            document.getElementById('add-more').addEventListener('click', function(e) {
                e.preventDefault();

                // Clone the form
                let formContainer = document.getElementById('form-container');
                let form = formContainer.querySelector('.transport-form');
                let clone = form.cloneNode(true);

                // Reset the values of the cloned form
                clone.querySelectorAll('input, select').forEach((element) => {
                    if (element.tagName === 'INPUT') {
                        element.value = '';
                    } else if (element.tagName === 'SELECT') {
                        element.selectedIndex = 0;
                    }
                });

                // Append the cloned form to the container
                formContainer.appendChild(clone);

                // Reinitialize Flatpickr for the new start date input
                initializeFlatpickr(clone.querySelector(".startDate"));

                // Add event listener to the new remove button
                clone.querySelector('.remove-form').addEventListener('click', function() {
                    if (document.querySelectorAll('.transport-form').length > 1) {
                        this.parentElement.remove();
                    } else {
                        $('.failure-section').empty();
                        $('.failure-section').append(
                            'At least one search criteria is required.'
                        );
                        $('.begin-section').hide();
                        $('.failure-section').show();
                    }
                });
            });

            // Add event listener to the initial remove button
            document.querySelectorAll('.remove-form').forEach(function(button) {
                button.addEventListener('click', function() {
                    if (document.querySelectorAll('.transport-form').length > 1) {
                        this.parentElement.remove();
                    } else {
                        $('.failure-section').empty();
                        $('.failure-section').append(
                            'At least one search criteria is required.'
                        );
                        $('.begin-section').hide();
                        $('.failure-section').show();
                    }
                });
            });
        });

        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                $('.success-section-sar').hide();
                $('.success-section-pkr').hide();
                $('.success-section-usd').hide();
                $('.failure-section').hide();

                var formData = $(this).serializeArray(); // Serialize form data as an array
                // Check if any start_date[] field is empty
                var startDateEmpty = false;
                var routeEmpty = false;

                formData.forEach(function(item) {
                    if (item.name === 'start_date[]' && item.value === '') {
                        startDateEmpty = true;
                    }
                });
                formData.forEach(function(item) {
                    if (item.name === 'route[]' && item.value === '') {
                        routeEmpty = true;
                    }
                });

                if (startDateEmpty || routeEmpty) {
                    $('.failure-section').empty();
                    $('.failure-section').append(
                        'You must select the date and route both to get calculated result.'
                    );
                    $('.begin-section').hide();
                    $('.failure-section').show();
                    return false; // Prevent form submission
                }
                var vehicle_id = $('#vehicle_id').val(); // Get the value of the hidden input field
                // formData += '&vehicle_id=' + vehicle_id;

                // Make AJAX request
                $.ajax({
                    url: '{{ route('search.route_price') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response) {
                            console.log(response);
                            if (response.error) {
                                $('.failure-section').html(response.error);
                                $('.failure-section').show();
                                $('.success-section-sar').hide();
                                $('.begin-section').hide();
                                $('#searched').val('0');
                            }

                            // Clear previous results
                            $('.success-section-sar').html('');
                            $('.success-section-pkr').html('');
                            $('.success-section-usd').html('');

                            let totalSAR = 0;
                            let totalPKR = 0;
                            let totalUSD = 0;

                            response.results.forEach(result => {
                                if (result.cost === 0) {
                                    $('.success-section-sar').append(
                                        'No transport available for route <b>' +
                                        result.route_name + '</b> on <b>' + result
                                        .date + '</b>.<br>'
                                    );
                                    $('.success-section-pkr').append(
                                        'No transport available for route <b>' +
                                        result.route_name + '</b> on <b>' + result
                                        .date + '</b>.<br>'
                                    );
                                    $('.success-section-usd').append(
                                        'No transport available for route <b>' +
                                        result.route_name + '</b> on <b>' + result
                                        .date + '</b>.<br>'
                                    );
                                } else {
                                    var formattedSAR = result.cost.toFixed(1);
                                    var pkr = response.sar_to_pkr * result.cost;
                                    var formattedPKR = pkr.toFixed(1);
                                    var usd = response.sar_to_usd * result.cost;
                                    var formattedUSD = usd.toFixed(1);

                                    $('.success-section-sar').append(
                                        'Transport price of route <b>' + result
                                        .route_name + '</b> on <b>' + result.date +
                                        '</b> is <b>' + formattedSAR +
                                        ' (SAR)</b><br>'
                                    );
                                    $('.success-section-pkr').append(
                                        'Transport price of route <b>' + result
                                        .route_name + '</b> on <b>' + result.date +
                                        '</b> is <b>' + formattedPKR +
                                        ' (PKR)</b><br>'
                                    );
                                    $('.success-section-usd').append(
                                        'Transport price of route <b>' + result
                                        .route_name + '</b> on <b>' + result.date +
                                        '</b> is <b>' + formattedUSD +
                                        ' (USD)</b><br>'
                                    );

                                    totalSAR += result.cost;
                                    totalPKR += pkr;
                                    totalUSD += usd;
                                }
                            });

                            // Append total cost
                            $('.success-section-sar').append('<br>Total Transport cost is <b>' +
                                totalSAR.toFixed(1) + ' (SAR)</b>');
                            $('.success-section-pkr').append('<br>Total Transport cost is <b>' +
                                totalPKR.toFixed(1) + ' (PKR)</b>');
                            $('.success-section-usd').append('<br>Total Transport cost is <b>' +
                                totalUSD.toFixed(1) + ' (USD)</b>');

                            $('.success-section-sar').show();
                            $('.failure-section').hide();
                            $('.begin-section').hide();
                            $('#searched').val('1');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        $('.failure-section').html(
                            'An error occurred while processing the request');
                        $('.success-section').hide();
                    }
                });


            });
        });
    </script>

    <script>
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
@endsection
