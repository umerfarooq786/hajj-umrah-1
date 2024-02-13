@extends('website_layouts.master')

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('css/customPackage.css') }}">
@endsection

@section('content')

<div class="mx-auto min-h-[500px] relative flex flex-col items-center justify-center py-20 my-20">
        <video autoplay muted loop class="-z-10 h-full w-full absolute top-0 left-0 object-cover">
            <source src="{{asset('videos/package-bg.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="bg-white/80 p-10  pb-20 rounded-xl  lg:w-[80%] max-w-[1000px] ">
            <form action="" class="space-y-2" id="custom-package-form">
                <!-- Select Stay in Makkah -->
                <h4 class="font-semibold text-sm ">Select Stay in Makkah</h4>
                <div class="flex flex-col md:flex-row stay relative">
                    <select id="makkah_hotel" class="place w-full  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                        <option value="">Select Hotel</option>
                        <option value="Makkah">hotel1</option>
                        <option value="Madinah">hotel2</option>
                        <option value="Jeddah">hotel3</option>
                    </select>

                    <select id="makkah_hotel_room_type" class="place  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 ">
                        <option value="">Select Room Type</option>
                        <option value="Makkah">hotel1</option>
                        <option value="Madinah">hotel2</option>
                        <option value="Jeddah">hotel3</option>
                    </select>
                    
                    <div class=" flex items-center relative ">
                        <i class="fa-regular fa-calendar absolute left-3 text-gray-400"  ></i>
                        <input type="text" id="makkah_hotel_start_date" placeholder="Start Date" class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    </div>

                    <div class="flex items-center relative ">
                        <i class="fa-regular fa-calendar absolute left-3 text-gray-400"  ></i>
                        <input type="text" id="makkah_hotel_end_date" placeholder="End Date" class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    </div>                                    
                </div>

                <!-- Select Stay in Madinah -->
                <h4 class="font-semibold text-sm pt-3">Select Stay in Madinah</h4>
                <div class="flex flex-col md:flex-row stay relative">
                    <select id="madinah_hotel" class="place  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Hotel</option>
                        <option value="Makkah">hotel1</option>
                        <option value="Madinah">hotel2</option>
                        <option value="Jeddah">hotel3</option>
                    </select>

                    <select id="madinah_hotel_room_type" class="place  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Room Type</option>
                        <option value="Makkah">hotel1</option>
                        <option value="Madinah">hotel2</option>
                        <option value="Jeddah">hotel3</option>
                    </select>
                    
                    <div class=" flex items-center relative h-[40px]">
                        <i class="fa-regular fa-calendar absolute left-3 text-gray-400"  ></i>
                        <input type="text" id="madinah_hotel_start_date" placeholder="Start Date" class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    </div>

                    <div class=" flex items-center relative h-[40px]">
                        <i class="fa-regular fa-calendar absolute left-3 text-gray-400"  ></i>
                        <input type="text" id="madinah_hotel_end_date" placeholder="End Date" class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    </div>                                    
                </div>

                <!-- Transport in Makah -->
                <h4 class="font-semibold text-sm pt-3">Select Transport </h4>
                <div class="flex flex-col md:flex-row  relative">
                    <select class="journey  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Route</option>
                        @foreach($routes as $route)
                        <option value="{{$route->id}}">{{$route->name}}</option>
                        @endforeach
                    </select>

                    <select class="journey  border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Vehicle</option>
                        @foreach($routes as $route)
                        <option value="{{$route->id}}">{{$route->name}}</option>
                        @endforeach
                    </select>
                    
                    <div class=" flex items-center relative h-[40px]">
                        <i class="fa-regular fa-calendar absolute left-3 text-gray-400"  ></i>
                        <input type="text" id="makkah_transport_date" placeholder="Select Date" class=" pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    </div>
                </div>


                <!-- Visa -->
                <h4 class="font-semibold text-sm pt-3">Select Visa</h4>
                <div class="flex flex-col md:flex-row  relative">
                    
                    <select class="residence_country border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Visa Type</option>
                        <option value="one">Umrah Visa</option>
                        <option value="two">Hajj Visa</option>                        
                    </select>
                    
                    <select class="nationality border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Nationality</option>
                        <option value="one">1</option>
                        <option value="two">2</option>
                        <option value="three">3</option>
                    </select>
                </div>

            </form>
        </div>

        <button type="button" class="bg-[#c02428] mt-[-50px] py-2 px-5 rounded-md hover:bg-red-500 text-white" onclick="getFormValues()">Calculate your package</button>

</div>
        <script>
            const initialFields = document.querySelectorAll('.stay'); // Select all initial fields

            const initFlatpickr = function(element) {
                const startDateInput = flatpickr(element.querySelector(".startDate"), {
                    minDate: "today", 
                    dateFormat: "Y-m-d",
                    onChange: function(selectedDates, dateStr, instance) {      
                        endDateInput.disabled = false;

                        const minEndDate = instance.selectedDates[0];
                        minEndDate.setDate(minEndDate.getDate() + 5);
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
                removeButton.innerHTML = '<i class="fa-solid fa-minus text-red-500 absolute right-[-25px] bottom-0"></i>';
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
                    if(placeValue === "" || startDateValue === "" || endDateValue === "" || personsValue === "" ){
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

                if(journey === "" || vehiclequantity === "" || vehicle === "" || operator_comapny === "" || residence_country === "" || nationality === "" ){
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

                if(error === true){
                    return alert("All fields are required");
                }
                console.log(formData);
                console.log("error = " + error);
                // You can now use the formData array as needed (e.g., send it to the server).
            }
        </script>
        


@endsection