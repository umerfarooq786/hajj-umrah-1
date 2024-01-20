@extends('website_layouts.master')

@section('content')

<div class="mx-auto min-h-[500px] relative flex items-center justify-center">
        <video autoplay muted loop class="-z-10 h-full w-full absolute top-0 left-0 object-cover">
            <source src="{{asset('videos/package-bg.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="bg-white/80 p-5 rounded-xl w-[60%] max-w-[1000px]">
            <form action="" class="" id="custom-package-form">
                <div class="flex gap-2 stay">
                    <select class="w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                        <option value="">Select Stay</option>
                        <option value="Makkah">Makkah</option>
                        <option value="Madinah">Madinah</option>
                        <option value="Jeddah">Jeddah</option>
                    </select>
                    
                    <input type="text" class="startDate">
                    <input type="text" class="endDate">

                    <button type="button" onclick="addNewDiv()">Add New</button>
                </div>
            </form>
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
                removeButton.textContent = 'Remove';
                removeButton.onclick = function() {
                    // Remove the parent div when the "Remove" button is clicked
                    newDiv.remove();
                };

                // Append the "Remove" button to the new div
                newDiv.appendChild(removeButton);

                // Append the new div to the form
                document.getElementById('custom-package-form').appendChild(newDiv);

                // Initialize Flatpickr for the new fields
                initFlatpickr(newDiv);
            }

            function getFormValues() {
                const allFields = document.querySelectorAll('.stay');
                const formData = [];

                allFields.forEach(field => {
                    const selectValue = field.querySelector('select').value;
                    const startDateValue = field.querySelector('.startDate').value;
                    const endDateValue = field.querySelector('.endDate').value;

                    formData.push({
                        stay: selectValue,
                        startDate: startDateValue,
                        endDate: endDateValue
                    });
                });

                console.log(formData);
                // You can now use the formData array as needed (e.g., send it to the server).
            }
        </script>
        
        <button type="button" onclick="getFormValues()">Get Form Values</button>

    </div>

@endsection