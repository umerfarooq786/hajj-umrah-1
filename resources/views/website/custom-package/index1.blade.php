@extends('website_layouts.master')

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/customPackage.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <style>
        .checkbox-sm {
            width: 16px;
            /* Set the width of the checkbox */
            height: 16px;
            /* Set the height of the checkbox */
            margin-right: 8px;
            /* Add margin between checkbox and label */
        }

        #MakkahmealOptions {
            position: absolute;
            top: 100%;
            width: 400px;
            /* Position it below the parent element */
            left: 0;
            z-index: 9999;
            /* Ensure it appears above other content */
        }

        #MadinahmealOptions {
            position: absolute;
            top: 100%;
            width: 400px;
            /* Position it below the parent element */
            left: 0;
            z-index: 9999;
            /* Ensure it appears above other content */
        }

        /* Add More Button Style */
        #addMoreBtn {
            background-color: #4CAF50;
            /* Green background */
            border: none;
            color: white;
            padding: 10px 20px;
            /* Padding for better spacing */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            /* Add margin for spacing */
            cursor: pointer;
            border-radius: 5px;
            /* Rounded corners */
            transition-duration: 0.4s;
            /* Smooth hover transition */
        }

        .addMoreBtn:hover {
            background-color: #45a049;
            /* Darker green on hover */
        }

        .addMoreHotelBtn {
            background-color: #4CAF50;
            /* Green background */
            border: none;
            color: white;
            padding: 10px 20px;
            /* Padding for better spacing */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            /* Add margin for spacing */
            cursor: pointer;
            border-radius: 5px;
            /* Rounded corners */
            transition-duration: 0.4s;
            /* Smooth hover transition */
        }

        #addMoreHotelBtn:hover {
            background-color: #45a049;
            /* Darker green on hover */
        }
    </style>
    <div class="mx-auto min-h-[500px] relative flex flex-col items-center justify-center py-20 my-20">
        <video autoplay muted loop class="-z-10 h-full w-full absolute top-0 left-0 object-cover">
            <source src="{{ asset('videos/package-bg.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="bg-white/80 p-10  pb-20 rounded-xl  lg:w-[80%] max-w-[1000px] ">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Fast Lines!</b>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br><br>
            @endif
            @foreach ($showpage as $visa)
                @if ($visa->show_hajj)
                    {{-- This note field should be in a flash message, which will end after redirection --}}
                    <div class="mb-5">
                        <p id="makkah_hotel_note" style="display: none;" class="text-red-600"><b>Note from hotel name:</b>
                            This is
                            some message from makkah
                            hotel</p>
                        <p id="madinah_hotel_note" style="display: none;" class="text-red-600"><b>Note from hotel name:</b>
                            This is
                            some message from
                            madinah hotel</p>
                    </div>
                    <form method="POST" action="{{ route('calculate.calculate_package_result') }}" class="space-y-2"
                        id="custom-package-form" enctype="multipart/form-data">
                        @csrf
                        <!-- Select Stay in Makkah -->
                        <h4 class="font-semibold text-sm ">Select Number Of Persons.</h4>
                        {{-- <div class="flex flex-col md:flex-row stay relative"> --}}
                        <select id="no_of_persons" name="no_of_persons"
                            class="form-control {{ $errors->has('no_of_persons') ? 'is-invalid' : '' }}" required>
                            <option value="">Select Persons</option>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ old('no_of_persons') == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        {{-- </div> --}}

                        <h4 class="font-semibold text-sm ">Select Stay in Makkah</h4>
                        <div id="makkahDiv">
                            <div class="flex flex-col lg:flex-row stay relative gap-3">
                                <select id="makkah_hotel" name="makkah_hotel[]"
                                    class="place w-full lg:w-[150px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                    <option value="">Select Hotel</option>
                                    @foreach ($makkah_hotels as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                </select>

                                <select id="makkah_hotel_room_type" name="makkah_hotel_room_type[]"
                                    class="place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 ">
                                    <option value="">Select Room Type</option>
                                    <option value="1">Single</option>
                                    <option value="2">Double</option>
                                    <option value="3">Triple</option>
                                    <option value="4">Quad</option>
                                </select>


                                <div class="relative">
                                    <div id="makkah_meal_button"
                                        class="border px-2 w-[150px] h-[38px]  flex items-center justify-center text-gray-600 border-gray-400 bg-white rounded-md  text-sm focus:border-gray-400">
                                        Meals</div>
                                    <div id="makkah_meal_card"
                                        class="absolute hidden top-[100%] left-0 bg-white w-[200px] p-3 z-10 border border-gray-300">
                                        <ul>

                                        </ul>
                                    </div>
                                </div>
                                <!-- test end -->
                                <div class=" flex items-center relative lg:w-[150px]">
                                    <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                    <input type="text" id="makkah_hotel_start_date" name="makkah_hotel_start_date[]"
                                        placeholder="Start Date"
                                        class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                </div>

                                <div class="flex items-center relative lg:w-[150px]">
                                    <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                    <input type="text" id="makkah_hotel_end_date" name="makkah_hotel_end_date[]"
                                        placeholder="End Date"
                                        class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                </div>
                            </div>
                        </div>
                        <button id="addMoreHotelBtn" type="button" class="btn btn-primary addMoreHotelBtn">Add
                            More</button>

                        <!-- Select Stay in Madinah -->
                        <h4 class="font-semibold text-sm pt-3">Select Stay in Madinah</h4>
                        <div id="madinahDiv">
                            <div class="flex flex-col lg:flex-row stay relative gap-3">
                                <select id="madinah_hotel" name="madinah_hotel[]"
                                    class="place w-full lg:w-[150px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                    <option value="">Select Hotel</option>
                                    @foreach ($madina_hotels as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                </select>

                                <select id="madinah_hotel_room_type" name="madinah_hotel_room_type[]"
                                    class="place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 ">
                                    <option value="">Select Room Type</option>
                                    <option value="1">Single</option>
                                    <option value="2">Double</option>
                                    <option value="3">Triple</option>
                                    <option value="4">Quad</option>
                                </select>
                                <!-- test start -->
                                <div class="relative">
                                    <div id="madinah_meal_button"
                                        class="border px-2 w-[150px] h-[38px]  flex items-center justify-center text-gray-600 border-gray-400 bg-white rounded-md  text-sm focus:border-gray-400">
                                        Meals</div>
                                    <div id="madinah_meal_card"
                                        class="absolute hidden top-[100%] left-0 bg-white w-[200px] p-3 z-10 border border-gray-300">
                                        <ul>

                                        </ul>
                                    </div>
                                </div>
                                <!-- test end -->
                                <div class=" flex items-center relative lg:w-[150px]">
                                    <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                    <input type="text" id="madinah_hotel_start_date" name="madinah_hotel_start_date[]"
                                        placeholder="Start Date"
                                        class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                </div>

                                <div class="flex items-center relative lg:w-[150px]">
                                    <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                    <input type="text" id="madinah_hotel_end_date" name="madinah_hotel_end_date[]"
                                        placeholder="End Date"
                                        class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                </div>
                            </div>
                        </div>
                        <button id="addMoreMadinahHotelBtn" type="button" class="btn btn-primary addMoreHotelBtn">Add
                            More</button>

                        <!-- Select Stay in Jeddah -->
                        <h4 class="font-semibold text-sm pt-3">Select Stay in Jeddah</h4>
                        <div id="JeddahDiv">
                            <div class="flex flex-col lg:flex-row stay relative gap-3">
                                <select id="jeddah_hotel" name="jeddah_hotel[]"
                                    class="place w-full lg:w-[150px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                    <option value="">Select Hotel</option>
                                    @foreach ($jeddah_hotels as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                </select>

                                <select id="jeddah_hotel_room_type" name="jeddah_hotel_room_type[]"
                                    class="place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 ">
                                    <option value="">Select Room Type</option>
                                    <option value="1">Single</option>
                                    <option value="2">Double</option>
                                    <option value="3">Triple</option>
                                    <option value="4">Quad</option>
                                </select>
                                <!-- test start -->
                                <div class="relative">
                                    <div id="jeddah_meal_button"
                                        class="border px-2 w-[150px] h-[38px]  flex items-center justify-center text-gray-600 border-gray-400 bg-white rounded-md  text-sm focus:border-gray-400">
                                        Meals</div>
                                    <div id="jeddah_meal_card"
                                        class="absolute hidden top-[100%] left-0 bg-white w-[200px] p-3 z-10 border border-gray-300">
                                        <ul>

                                        </ul>
                                    </div>
                                </div>
                                <!-- test end -->
                                <div class=" flex items-center relative lg:w-[150px]">
                                    <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                    <input type="text" id="jeddah_hotel_start_date" name="jeddah_hotel_start_date[]"
                                        placeholder="Start Date"
                                        class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                </div>

                                <div class="flex items-center relative lg:w-[150px]">
                                    <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                    <input type="text" id="jeddah_hotel_end_date" name="jeddah_hotel_end_date[]"
                                        placeholder="End Date"
                                        class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                </div>
                            </div>
                        </div>
                        <button id="addMoreJeddahHotelBtn" type="button" class="btn btn-primary addMoreHotelBtn">Add
                            More</button>

                        <!-- Transport in Makah -->
                        <h4 class="font-semibold text-sm pt-3">Select Transport </h4>
                        <div id="RoutesDiv">
                            <div class="flex flex-col md:flex-row stay relative gap-3">
                                <select id="route" name="route[]"
                                    class="place  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                                    <option value="">Select Route</option>
                                    @foreach ($routes as $route)
                                        <option value="{{ $route->id }}">{{ $route->name }}</option>
                                    @endforeach
                                </select>

                                <select id="vehicle" name="vehicle[]"
                                    class="place  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                                    <option value="">Select Vehicle</option>
                                    @foreach ($transport_types as $transport)
                                        <option value="{{ $transport->id }}">
                                            {{ $transport->name }}
                                            @if ($transport->capacity)
                                                <span class="text-xs text-gray-500">( {{ $transport->capacity }}-Person
                                                    )</span>
                                            @endif
                                        </option>
                                    @endforeach
                                </select>

                                <div class=" flex items-center relative h-[40px]">
                                    <i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>
                                    <input type="date" id="travel_date" name="travel_date[]" placeholder="Date"
                                        class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                                </div>
                            </div>
                        </div>
                        <button id="addMoreBtn" class="btn btn-primary">Add More</button>


                        <h4 class="font-semibold text-sm pt-3">Maktab </h4>
                        <select id="maktab" name="maktab"
                            class="place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 ">
                            <option value="">Select Room Type</option>
                            @foreach ($maktabs as $maktab)
                                <option value="{{ $maktab->id }}">
                                    {{ $maktab->name }}
                                </option>
                            @endforeach
                        </select>


                        <div class="flex flex-col md:flex-row  relative">
                            <input name="visa" value="Hajj" hidden>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-[#c02428] mt-6 py-2 px-2 rounded-md hover:bg-red-500 text-white">Calculate
                                your
                                package</button>
                        </div>
                    </form>
                @else
                    {{-- Don't display Hajj charges --}}
                    <div class="h-[400px] flex items-center justify-center">

                        <div
                            class="block max-w-sm p-10 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                            <p class="font-semibold text-gray-700 dark:text-gray-400 ">Hajj Calculations are comming soon.
                            </p>
                            <div class="flex flex-col md:flex-row  relative">
                                <input name="visa" value="hajj" hidden>
                            </div>
                        </div>
                @endif
            @endforeach
        </div>


    </div>
    <script>
        $(document).ready(function() {

            $('#selectMadinahMealButton').on('click', function() {
                $('#MadinahmealOptions').toggleClass('hidden');
            });

            $('#MadinahapplyButton').on('click', function() {
                // Collect selected meal options
                var selectedMeals = [];
                $('#MadinahmealOptions input[type="checkbox"]:checked').each(function() {
                    selectedMeals.push($(this).val());
                });
                $('#MadinahmealOptions').addClass('hidden');
            });

            $Makkahbtn_i = 1;
            $Madinahbtn_i = 1;
            $Jadahbtn_i = 1;

            $(document).on('change', '#makkah_hotel', function() {
                var selectedValue = $(this).val();
                $.ajax({
                    url: '{{ route('calculate.hotel_room_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;

                        populate_makkah_hotel_room_type(responseData);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_note') }}',
                    method: 'GET',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var note = response;
                        $('#makkah_hotel_note').html('<b>Note Of Makkah Selected Hotel:</b> ' +
                            note).show();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_meal_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;
                        populate_makkah_hotel_meal_type(responseData);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                function populate_makkah_hotel_room_type(data) {
                    var options = '<option value="">Select Room Type</option>'; // Add a default option

                    // Loop through the data and create options for the second dropdown
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }

                    // Populate the second dropdown with options
                    $('#makkah_hotel_room_type').html(options);
                }

                function populate_makkah_hotel_meal_type(data) {
                    var listItems = '';
                    var makkahbtn = $Makkahbtn_i;
                    for (var i = 0; i < data.length; i++) {
                        listItems += '<li class="flex items-center gap-3">';
                        listItems += '<input type="checkbox" id="makkah-meal-' + data[i].id +
                            '" name="makkah_meal[' + makkahbtn + '][]" value="' + data[i].id +
                            '" class="outline-none ring-0">';
                        listItems += '<label for="makkah-meal-' + data[i].id + '">' + data[i].name +
                            '</label>';
                        listItems += '</li>';
                    }

                    $('#makkah_meal_card ul').html(listItems);
                }
            });



            $(document).on('change', '#makkah_hotel1', function() {
                var selectedValue = $(this).val();
                var selectElement = this;

                $.ajax({
                    url: '{{ route('calculate.hotel_room_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;

                        populate_makkah_hotel_room_type1(responseData, selectElement);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_note') }}',
                    method: 'GET',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var note = response;
                        $('#makkah_hotel_note').html('<b>Note Of Makkah Selected Hotel:</b> ' +
                            note).show();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_meal_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;
                        populate_makkah_hotel_meal_type1(responseData, selectElement);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                function populate_makkah_hotel_room_type1(data, selectElement) {

                    var options = '<option value="">Select Room Type</option>'; // Add a default option

                    // Loop through the data and create options for the dropdown
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }

                    // Populate the corresponding dropdown with options
                    $(selectElement).closest('div').find('.makkah_hotel_room_type1').html(options);
                }


                function populate_makkah_hotel_meal_type1(data, selectElement) {
                    var makkahbtn = $Makkahbtn_i;
                    var listItems = '';
                    for (var i = 0; i < data.length; i++) {
                        listItems += '<li class="flex items-center gap-3">';
                        listItems += '<input type="checkbox" id="makkah-meal-' + data[i].id +
                            '" name="makkah_meal[' + makkahbtn + '][]" value="' + data[i].id +
                            '" class="outline-none ring-0">';
                        listItems += '<label for="makkah-meal-' + data[i].id + '">' + data[i].name +
                            '</label>'; // Ensure this matches the checkbox ID
                        listItems += '</li>';
                    }

                    // Find the closest .makkah_meal_card ul to the changed select element and update it
                    $(selectElement).closest('div').find('.makkah_meal_card ul').html(listItems);
                }
            });



            $('#madinah_hotel').change(function() {
                var selectedValue = $(this).val();
                // Make AJAX request
                $.ajax({
                    url: '{{ route('calculate.hotel_room_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;

                        populate_madinah_hotel_room_type(responseData);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_note') }}',
                    method: 'GET',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var note = response;
                        $('#makkah_hotel_note').html('<b>Note Of Madinah Selected Hotel:</b> ' +
                            note).show();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });


                $.ajax({
                    url: '{{ route('calculate.hotel_meal_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;
                        populate_madinah_hotel_meal_type(responseData);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });




                function populate_madinah_hotel_room_type(data) {
                    var options = '<option value="">Select Room Type</option>'; // Add a default option

                    // Loop through the data and create options for the second dropdown
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }

                    // Populate the second dropdown with options
                    $('#madinah_hotel_room_type').html(options);
                }

                function populate_madinah_hotel_meal_type(data) {
                    var listItems = '';
                    var madinahbtn = $Madinahbtn_i;
                    // Loop through the data and create list items with checkboxes
                    for (var i = 0; i < data.length; i++) {
                        listItems += '<li class="flex items-center gap-3">';
                        listItems += '<input type="checkbox" id="madinah_meal' + data[i].id +
                            '" name="madinah_meal[' + madinahbtn + '][]" value="' + data[i].id +
                            '" class="outline-none ring-0">';
                        listItems += '<label for="makkah-meal-' + data[i].id + '">' + data[i].name +
                            '</label>';
                        listItems += '</li>';
                    }

                    // Populate the ul with the generated list items
                    $('#madinah_meal_card ul').html(listItems);
                }
            });

            $(document).on('change', '#madinah_hotel1', function() {
                var selectedValue = $(this).val();
                var selectElement = this;
                $.ajax({
                    url: '{{ route('calculate.hotel_room_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;

                        populate_madinah_hotel_room_type1(responseData, selectElement);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_note') }}',
                    method: 'GET',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var note = response;
                        $('#madinah_hotel_note').html(
                            '<b>Note Of Madinah Selected Hotel:</b> ' +
                            note).show();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_meal_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;
                        populate_madinah_hotel_meal_type1(responseData, selectElement);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });



                function populate_madinah_hotel_room_type1(data, selectElement) {

                    var options = '<option value="">Select Room Type</option>'; // Add a default option

                    // Loop through the data and create options for the dropdown
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }

                    // Populate the corresponding dropdown with options
                    $(selectElement).closest('div').find('.madinah_hotel_room_type1').html(options);
                }


                function populate_madinah_hotel_meal_type1(data, selectElement) {
                    var listItems = '';
                    var madinahbtn = $Madinahbtn_i;
                    for (var i = 0; i < data.length; i++) {
                        listItems += '<li class="flex items-center gap-3">';
                        listItems += '<input type="checkbox" id="madinah-meal-' + data[i].id +
                            '" name="madinah_meal[' + madinahbtn + '][]" value="' + data[i].id +
                            '" class="outline-none ring-0">';
                        listItems += '<label for="madinah-meal-' + data[i].id + '">' + data[i].name +
                            '</label>';
                        listItems += '</li>';
                    }

                    // Find the closest .makkah_meal_card ul to the changed select element and update it
                    $(selectElement).closest('div').find('.madinah_meal_card ul').html(listItems);
                }

            });
            $('#jeddah_hotel').change(function() {
                var selectedValue = $(this).val();
                // Make AJAX request
                $.ajax({
                    url: '{{ route('calculate.hotel_room_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;

                        populate_jeddah_hotel_room_type(responseData);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_note') }}',
                    method: 'GET',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var note = response;
                        $('#makkah_hotel_note').html('<b>Note Of Jeddah Selected Hotel:</b> ' +
                            note).show();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });


                $.ajax({
                    url: '{{ route('calculate.hotel_meal_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;
                        populate_jeddah_hotel_meal_type(responseData);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });




                function populate_jeddah_hotel_room_type(data) {
                    var options = '<option value="">Select Room Type</option>'; // Add a default option

                    // Loop through the data and create options for the second dropdown
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }

                    // Populate the second dropdown with options
                    $('#jeddah_hotel_room_type').html(options);
                }

                function populate_jeddah_hotel_meal_type(data) {
                    var listItems = '';
                    var jaddahbtn = $Jadahbtn_i;
                    // Loop through the data and create list items with checkboxes
                    for (var i = 0; i < data.length; i++) {
                        listItems += '<li class="flex items-center gap-3">';
                        listItems += '<input type="checkbox" id="jeddah_meal' + data[i].id +
                            '" name="jeddah_meal[' + jaddahbtn + '][]" value="' + data[i].id +
                            '" class="outline-none ring-0">';
                        listItems += '<label for="makkah-meal-' + data[i].id + '">' + data[i].name +
                            '</label>';
                        listItems += '</li>';
                    }

                    // Populate the ul with the generated list items
                    $('#jeddah_meal_card ul').html(listItems);
                }
            });

            $(document).on('change', '#jeddah_hotel1', function() {
                var selectedValue = $(this).val();
                var selectElement = this;
                $.ajax({
                    url: '{{ route('calculate.hotel_room_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;

                        populate_jaddah_hotel_room_type1(responseData, selectElement);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_note') }}',
                    method: 'GET',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var note = response;
                        $('#jeddah_hotel_note').html('<b>Note Of Jaddah Selected Hotel:</b> ' +
                            note).show();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    url: '{{ route('calculate.hotel_meal_type') }}',
                    method: 'POST',
                    data: {
                        selectedValue: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Extract data from the response
                        var responseData = response.data;
                        populate_jaddah_hotel_meal_type1(responseData, selectElement);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });



                function populate_jaddah_hotel_room_type1(data, selectElement) {

                    var options = '<option value="">Select Room Type</option>'; // Add a default option

                    // Loop through the data and create options for the dropdown
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }

                    // Populate the corresponding dropdown with options
                    $(selectElement).closest('div').find('.jeddah_hotel_room_type1').html(options);
                }


                function populate_jaddah_hotel_meal_type1(data, selectElement) {
                    var listItems = '';
                    var jaddahbtn = $Jadahbtn_i;
                    for (var i = 0; i < data.length; i++) {
                        listItems += '<li class="flex items-center gap-3">';
                        listItems += '<input type="checkbox" id="jaddah-meal-' + data[i].id +
                            '" name="jeddah_meal[' + jaddahbtn + '][]" value="' + data[i].id +
                            '" class="outline-none ring-0">';
                        listItems += '<label for="jaddah-meal-' + data[i].id + '">' + data[i].name +
                            '</label>';
                        listItems += '</li>';
                    }

                    // Find the closest .makkah_meal_card ul to the changed select element and update it
                    $(selectElement).closest('div').find('.jeddah_meal_card ul').html(listItems);
                }
            });

            $('#addMoreBtn').click(function(e) {
                e.preventDefault();
                var newInputGroup = $('<div class="flex flex-col md:flex-row stay relative">' +
                    '<select name="route[]" class="place border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">' +
                    '<option value="">Select Route</option>' +
                    '@foreach ($routes as $route)' +
                    '<option value="{{ $route->id }}">{{ $route->name }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '<select name="vehicle[]" class="place border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">' +
                    '<option value="">Select Vehicle</option>' +
                    '@foreach ($transport_types as $trantransport_type)' +
                    '<option value="{{ $trantransport_type->id }}">{{ $trantransport_type->name }} <span class="text-xs text-gray-500">( {{ $trantransport_type->capacity }}-Person )</span></option>' +
                    '@endforeach' +
                    '</select>' +
                    '<div class="flex items-center relative h-[40px]">' +
                    '<i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>' +
                    '<input type="date" name="travel_date[]" placeholder="Date" class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '<button class="deleteBtn">Delete</button>' +
                    '</div>' +
                    '</div>');

                // Append the new HTML structure to the container
                $('#RoutesDiv').append(newInputGroup);
                initFlatpickr(newInputGroup[0]);
            });

            // Add click event listener to dynamically added delete buttons using event delegation
            $('#RoutesDiv').on('click', '.deleteBtn', function(e) {
                e.preventDefault();
                $(this).closest('.stay').remove(); // Adjusted the selector here
            });



            $(document).on('click', '#addMoreHotelBtn', function(e) {
                e.preventDefault();
                var newInputGroup = $('<div class="flex flex-col lg:flex-row stay relative gap-3">' +
                    '<select id="makkah_hotel1" name="makkah_hotel[]" class="place w-full lg:w-[150px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '<option value="">Select Hotel</option>' +
                    '@foreach ($makkah_hotels as $hotel)' +
                    '<option value="{{ $hotel->id }}">{{ $hotel->name }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '<select class="makkah_hotel_room_type1 place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 " name="makkah_hotel_room_type[]">' +
                    '<option value="">Select Room Type</option>' +
                    '<option value="1">Single</option>' +
                    '<option value="2">Double</option>' +
                    '<option value="3">Triple</option>' +
                    '<option value="4">Quad</option>' +
                    '</select>' +
                    '<div class="relative">' +
                    '<div id="makkah_meal_button1"' +
                    'class=" makkah_meal_button border px-2 w-[150px] h-[38px]  flex items-center justify-center text-gray-600 border-gray-400 bg-white rounded-md  text-sm focus:border-gray-400">' +
                    'Meals</div>' +
                    '<div id="makkah_meal_card1"' +
                    'class="makkah_meal_card absolute hidden top-[100%] left-0 bg-white w-[200px] p-3 z-10 border border-gray-300">' +
                    '<ul>' +

                    '</ul>' +
                    '</div>' +
                    '</div>' +
                    '<div class=" flex items-center relative lg:w-[150px]">' +
                    '<i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>' +
                    '<input type="text" id="makkah_hotel_start_date" name="makkah_hotel_start_date[]"' +
                    'placeholder="Start Date"' +
                    'class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '</div>' +
                    '<div class="flex items-center relative lg:w-[150px]">' +
                    '<i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>' +
                    '<input type="text" id="makkah_hotel_end_date" name="makkah_hotel_end_date[]"' +
                    'placeholder="End Date"' +
                    'class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '</div>' +
                    '<button class="deleteMakkahHotelBtn">Delete</button>' +
                    '</div>');
                // Append the new HTML structure to the container
                $('#makkahDiv').append(newInputGroup);
                initFlatpickr(newInputGroup[0]);
                $Makkahbtn_i++;
            });
            // Add click event listener to dynamically added delete buttons using event delegation
            $('#makkahDiv').on('click', '.deleteMakkahHotelBtn', function(e) {
                e.preventDefault();
                $Makkahbtn_i--;
                $(this).closest('.stay').remove(); // Adjusted the selector here
            });
            // Madinah Add More Button
            $(document).on('click', '#addMoreMadinahHotelBtn', function(e) {
                e.preventDefault();
                var newInputGroup = $('<div class="flex flex-col lg:flex-row stay relative gap-3">' +
                    '<select id="madinah_hotel1" name="madinah_hotel[]" class="place w-full lg:w-[150px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '<option value="">Select Hotel</option>' +
                    '@foreach ($madina_hotels as $hotel)' +
                    '<option value="{{ $hotel->id }}">{{ $hotel->name }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '<select class="madinah_hotel_room_type1 place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 " name="madinah_hotel_room_type[]">' +
                    '<option value="">Select Room Type</option>' +
                    '<option value="1">Single</option>' +
                    '<option value="2">Double</option>' +
                    '<option value="3">Triple</option>' +
                    '<option value="4">Quad</option>' +
                    '</select>' +
                    '<div class="relative">' +
                    '<div id="madinah_meal_button1"' +
                    'class=" madinah_meal_button border px-2 w-[150px] h-[38px]  flex items-center justify-center text-gray-600 border-gray-400 bg-white rounded-md  text-sm focus:border-gray-400">' +
                    'Meals</div>' +
                    '<div id="madinah_meal_card1"' +
                    'class="madinah_meal_card absolute hidden top-[100%] left-0 bg-white w-[200px] p-3 z-10 border border-gray-300">' +
                    '<ul>' +

                    '</ul>' +
                    '</div>' +
                    '</div>' +
                    '<div class=" flex items-center relative lg:w-[150px]">' +
                    '<i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>' +
                    '<input type="text" id="madinah_hotel_start_date" name="madinah_hotel_start_date[]"' +
                    'placeholder="Start Date"' +
                    'class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '</div>' +
                    '<div class="flex items-center relative lg:w-[150px]">' +
                    '<i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>' +
                    '<input type="text" id="madinah_hotel_end_date" name="madinah_hotel_end_date[]"' +
                    'placeholder="End Date"' +
                    'class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '</div>' +
                    '<button class="deleteMadinahHotelBtn">Delete</button>' +
                    '</div>');
                $Madinahbtn_i++;
                // Append the new HTML structure to the container
                $('#madinahDiv').append(newInputGroup);
                initFlatpickr(newInputGroup[0]);
            });
            // Add click event listener to dynamically added delete buttons using event delegation
            $('#madinahDiv').on('click', '.deleteMadinahHotelBtn', function(e) {
                e.preventDefault();
                $Madinahbtn_i--;
                $(this).closest('.stay').remove(); // Adjusted the selector here
            });
            // JeddahAdd More Button
            $(document).on('click', '#addMoreJeddahHotelBtn', function(e) {
                e.preventDefault();
                var newInputGroup = $('<div class="flex flex-col lg:flex-row stay relative gap-3">' +
                    '<select id="jeddah_hotel1" name="jeddah_hotel[]" class="place w-full lg:w-[150px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '<option value="">Select Hotel</option>' +
                    '@foreach ($jeddah_hotels as $hotel)' +
                    '<option value="{{ $hotel->id }}">{{ $hotel->name }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '<select class="jeddah_hotel_room_type1 place lg:w-[180px]  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 " name="jeddah_hotel_room_type[]">' +
                    '<option value="">Select Room Type</option>' +
                    '<option value="1">Single</option>' +
                    '<option value="2">Double</option>' +
                    '<option value="3">Triple</option>' +
                    '<option value="4">Quad</option>' +
                    '</select>' +
                    '<div class="relative">' +
                    '<div id="jeddah_meal_button1"' +
                    'class=" jeddah_meal_button border px-2 w-[150px] h-[38px]  flex items-center justify-center text-gray-600 border-gray-400 bg-white rounded-md  text-sm focus:border-gray-400">' +
                    'Meals</div>' +
                    '<div id="jeddah_meal_card1"' +
                    'class="jeddah_meal_card absolute hidden top-[100%] left-0 bg-white w-[200px] p-3 z-10 border border-gray-300">' +
                    '<ul>' +

                    '</ul>' +
                    '</div>' +
                    '</div>' +
                    '<div class=" flex items-center relative lg:w-[150px]">' +
                    '<i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>' +
                    '<input type="text" id="jeddah_hotel_start_date" name="jeddah_hotel_start_date[]"' +
                    'placeholder="Start Date"' +
                    'class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '</div>' +
                    '<div class="flex items-center relative lg:w-[150px]">' +
                    '<i class="fa-regular fa-calendar absolute left-3 text-gray-400"></i>' +
                    '<input type="text" id="jeddah_hotel_end_date" name="jeddah_hotel_end_date[]"' +
                    'placeholder="End Date"' +
                    'class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">' +
                    '</div>' +
                    '<button class="deleteJeddahHotelBtn">Delete</button>' +
                    '</div>');
                $Jadahbtn_i++;
                // Append the new HTML structure to the container
                $('#JeddahDiv').append(newInputGroup);
                initFlatpickr(newInputGroup[0]);
            });
            // Add click event listener to dynamically added delete buttons using event delegation
            $('#JeddahDiv').on('click', '.deleteJeddahHotelBtn', function(e) {
                e.preventDefault();
                $Jadahbtn_i--;
                $(this).closest('.stay').remove(); // Adjusted the selector here
            });
        });

        const initialFields = document.querySelectorAll('.stay'); // Select all initial fields

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




        // Initialize Flatpickr for the initial fields
        initialFields.forEach(initFlatpickr);

        function addNewDiv() {
            // Clone the first div with the class "stay"
            const newDiv = document.querySelector('.stay').cloneNode(true);

            // Clear values in the new div (optional)
            const inputElements = newDiv.querySelectorAll('input');
            inputElements.forEach(input => input.value = '');

            // Create a "Remove" button
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.innerHTML =
                '<i class="fa-solid fa-minus text-red-500 absolute right-[-25px] bottom-0"></i>';
            removeButton.onclick = function() {
                // Remove the parent div when the "Remove" button is clicked
                newDiv.remove();
            };

            // Append the "Remove" button to the new div
            newDiv.appendChild(removeButton);

            // Append the new div to the form
            // document.getElementById('custom-package-form').appendChild(newDiv);
            document.querySelector(".stay").insertAdjacentElement('afterend', newDiv);

            // Initialize Flatpickr for the new fields
            initFlatpickr(newDiv);
        }

        function getFormValues() {
            let error = false;
            const formData = [];
            const allFields = document.querySelectorAll('.stay');

            allFields.forEach(field => {
                const placeValue = field.querySelector('.place').value;
                const startDateValue = field.querySelector('.startDate').value;
                const endDateValue = field.querySelector('.endDate').value;
                const personsValue = field.querySelector('.persons').value;
                if (placeValue === "" || startDateValue === "" || endDateValue === "" ||
                    personsValue === "") {
                    error = true;
                }
                formData.push({
                    place: placeValue,
                    startDate: startDateValue,
                    endDate: endDateValue,
                    persons: personsValue
                });
            });

            const journey = document.querySelector(".journey").value;
            const vehiclequantity = document.querySelector(".vehiclequantity").value;
            const vehicle = document.querySelector(".vehicle").value;
            const operator_comapny = document.querySelector(".operator_comapny").value;
            const residence_country = document.querySelector(".residence_country").value;
            const nationality = document.querySelector(".nationality").value;

            if (journey === "" || vehiclequantity === "" || vehicle === "" || operator_comapny === "" ||
                residence_country === "" || nationality === "") {
                error = true;
            }

            formData.push({
                journey: journey,
                vehiclequantity: vehiclequantity,
                vehicle: vehicle,
                operator_comapny: operator_comapny,
                residence_country: residence_country,
                nationality: nationality
            });

            if (error === true) {
                return alert("All fields are required");
            }
            console.log(formData);
            console.log("error = " + error);
            // You can now use the formData array as needed (e.g., send it to the server).
        }
    </script>





    <script>
        // Logic for makkah meals
        const mealButton = document.getElementById('makkah_meal_button');
        const mealCard = document.getElementById('makkah_meal_card');


        mealButton.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
            mealCard.classList.toggle('hidden'); // Toggle the 'hidden' class on the meal card
        });

        document.body.addEventListener('click', function() {
            if (!mealCard.classList.contains('hidden')) {
                mealCard.classList.add('hidden');
            }
        });

        mealCard.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
        });

        $(document).on('click', '.makkah_meal_button', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
            $(this).next('.makkah_meal_card').toggleClass(
                'hidden'); // Toggle the 'hidden' class on the next .makkah_meal_card
        });

        $(document).on('click', function(event) {
            $('.makkah_meal_card:not(.hidden)').addClass('hidden');
        });

        $(document).on('click', '.makkah_meal_card', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
        });

        // Logic for madinah meals
        const madinahMealButton = document.getElementById('madinah_meal_button');
        const madinahMealCard = document.getElementById('madinah_meal_card');

        madinahMealButton.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
            madinahMealCard.classList.toggle('hidden'); // Toggle the 'hidden' class on the meal card
        });

        document.body.addEventListener('click', function() {
            if (!madinahMealCard.classList.contains('hidden')) {
                madinahMealCard.classList.add('hidden');
            }
        });

        madinahMealCard.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
        });

        $(document).on('click', '.madinah_meal_button', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
            $(this).next('.madinah_meal_card').toggleClass(
                'hidden'); // Toggle the 'hidden' class on the next .madinah_meal_card
        });

        $(document).on('click', function(event) {
            $('.madinah_meal_card:not(.hidden)').addClass('hidden');
        });

        $(document).on('click', '.madinah_meal_card', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
        });

        // Logic for jeddah meals
        const jeddahMealButton = document.getElementById('jeddah_meal_button');
        const jeddahMealCard = document.getElementById('jeddah_meal_card');

        jeddahMealButton.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
            jeddahMealCard.classList.toggle('hidden'); // Toggle the 'hidden' class on the meal card
        });

        document.body.addEventListener('click', function() {
            if (!jeddahMealCard.classList.contains('hidden')) {
                jeddahMealCard.classList.add('hidden');
            }
        });

        jeddahMealCard.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
        });

        $(document).on('click', '.jeddah_meal_button', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
            $(this).next('.jeddah_meal_card').toggleClass(
                'hidden'); // Toggle the 'hidden' class on the next .jeddah_meal_card
        });

        $(document).on('click', function(event) {
            $('.jeddah_meal_card:not(.hidden)').addClass('hidden');
        });

        $(document).on('click', '.jeddah_meal_card', function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document body
        });
    </script>
@endsection
