@extends('website_layouts.master')

@section('content')
<div class="mx-auto min-h-[500px] relative flex items-center justify-center">
    <video autoplay muted loop class="-z-10 h-full w-full absolute top-0 left-0 object-cover">
        <source src="{{asset('videos/package-bg.mp4')}}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class=" bg-white/80 p-5 rounded-xl w-[60%] max-w-[1000px]">
        <form action="" class="" id="custom-package-form">
            <div class="flex gap-2" class="stay">
                <select class="w-full border-gray-400 rounded-md text-gray-900 text-sm focus:border-gray-400">
                    <option value="">Select Stay</option>
                    <option value="">Makkah</option>
                    <option value="">Madinah</option>
                    <option value="">Jeddah</option>
                </select>
                
                <input type="text" id="startDate">
                <input type="text" id="endDate">

                <button type="button" onclick="addNewDiv()">Add New</button>
            </div>
        </form>
    </div>
</div>


<script>
  // Initialize Flatpickr for the start date
  const startDateInput = flatpickr("#startDate", {
    minDate: "today", // Start date cannot be before today
    dateFormat: "Y-m-d", // Customize the date format
    onChange: function(selectedDates, dateStr, instance) {
      // Enable the end date input when a start date is selected
      endDateInput.disabled = false;

      // Set minimum allowed end date as 5 days after the selected start date
      const minEndDate = instance.selectedDates[0];
      minEndDate.setDate(minEndDate.getDate() + 5);
      endDateInput.set("minDate", minEndDate);
    }
  });

  // Initialize Flatpickr for the end date (initially disabled)
  const endDateInput = flatpickr("#endDate", {
    dateFormat: "Y-m-d", // Customize the date format
    disable: [new Date()],
  });
</script>

@endsection