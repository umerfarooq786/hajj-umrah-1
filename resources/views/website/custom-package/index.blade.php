@extends('website_layouts.master')

@section('content')

<div class="mx-auto min-h-[500px] relative flex flex-col items-center justify-center">
        <video autoplay muted loop class="-z-10 h-full w-full absolute top-0 left-0 object-cover">
            <source src="{{asset('videos/package-bg.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="bg-white/80 p-10 pb-16 rounded-xl  lg:w-[60%] max-w-[1000px] ">
            <form action="" class="space-y-2" id="custom-package-form">
                <!-- Hotel -->
                <div class="flex flex-col md:flex-row stay relative">
                    <select class="place w-full mr-2 border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Stay</option>
                        <option value="Makkah">Makkah</option>
                        <option value="Madinah">Madinah</option>
                        <option value="Jeddah">Jeddah</option>
                    </select>
                    
                    <div class="w-full mr-2 flex items-center relative h-[40px]">
                        <i class="fa-regular fa-calendar absolute left-3 text-gray-400"  ></i>
                        <input type="text" placeholder="Start Date" class="startDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    </div>

                    <div class="w-full mr-2 flex items-center relative h-[40px]">
                        <i class="fa-regular fa-calendar absolute left-3 text-gray-400"  ></i>
                        <input type="text" placeholder="End Date" class="endDate pl-10 h-full w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    </div>
                    
                    <select class="persons w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Persons</option>
                        <option value="one">1</option>
                        <option value="two">2</option>
                        <option value="three">3</option>
                    </select>
                    
                    <button type="button" class="absolute right-[-25px] top-0" onclick="addNewDiv()"><i class="fa-solid fa-plus text-green-500  "></i></button>
                </div>

                <!-- Transport -->
                <div class="flex flex-col md:flex-row  relative">
                    <select class="journey w-full mr-2 border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Journey</option>
                        <option value="1">Jeddah - Makkah - Madinah - Madinah Airport with Institutional Isolation</option>
                        <option value="2">Parking - Haram's Station</option>
                        <option value="3">Jeddah - Makkah - Madinah - Madinah Airport with Institutional Isolation</option>
                        <option value="4">Yanbu - makkah - madinah - Yanbu</option>
                        <option value="5">jeddah-makkah-jeddah</option>
                    </select>
                    
                    <input type="text" placeholder="Vehicle Quantity" class="vehiclequantity w-full mr-2 border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                    
                    <select class="vehicle w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Vehicle</option>
                        <option value="1">Bus</option>
                        <option value="2">Sedan Car</option>
                        <option value="3">SUV Car</option>
                        <option value="4">Van</option>
                    </select>
                </div>

                <!-- Operator Company -->
                <div class="flex flex-col md:flex-row  relative">
                    <input type="text" placeholder="Operator Comapny" class="operator_comapny w-full mr-2 border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                    
                    <select class="residence_country mr-2 w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Residence Country</option>
                        <option value="one">1</option>
                        <option value="two">2</option>
                        <option value="three">3</option>
                    </select>
                    
                    <select class="nationality w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400 h-[40px]">
                        <option value="">Select Nationality</option>
                        <option value="one">1</option>
                        <option value="two">2</option>
                        <option value="three">3</option>
                    </select>
                </div>

            </form>
        </div>

        <button type="button" class="bg-[#c02428] mt-[-50px] py-2 px-5 rounded-md hover:bg-red-500 text-white" onclick="getFormValues()">Start Umrah Journey</button>

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