@extends('admin_layouts.master')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/selectize/selectize.css') }}">
    <script src="https://kit.fontawesome.com/d868f4cf6e.js" crossorigin="anonymous"></script>
@endsection
@section('content')
    <div class="content-header row">
        <script>
            window.lastValidity = 0 ;
        </script>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content collpase show">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Fast Lines!</b>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-body">
                        <form class="form form-horizontal" method="POST"
                            action="{{ route('transports.update', $transport->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-car"></i>Edit Transport</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Type</label>
                                            <div class="col-md-9">
                                                <select class="form-control border-primary" name="vehicle_id" required>
                                                    <option selected disabled="">Select Type</option>
                                                    @foreach ($transport_types as $type)
                                                        <option value="{{ $type->id }}"
                                                            {{ $transport->vehicle_id === $type->id ? 'selected' : '' }}>
                                                            {{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput4">Route</label>
                                            <div class="col-md-9">
                                                <select class="form-control border-primary" name="route_id" required>
                                                    <option selected disabled="">Select Route</option>
                                                    @foreach ($routes as $route)
                                                        <option value="{{ $route->id }}"
                                                            {{ $transport->route_id === $route->id ? 'selected' : '' }}>
                                                            {{ $route->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- row to repeat starts -->

                                @if ($costs && count($costs) > 0)
                                    @foreach ($costs as $cost)
                                        <div class="row validityContainer" id="" style="position:relative">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Cost </label>
                                                    <div class="col-md-9">
                                                        <input type="hidden" name="cost_id[]"
                                                            value="{{ $cost->id }}" />
                                                        <input type="number" class="form-control border-primary"
                                                            placeholder="Cost" name="cost[]" value="{{ $cost->cost }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="userinput2">Validity</label>
                                                    <div class="col-md-9">
                                                        <!-- <input type="date" id="validity{{ $cost->id }}" class="form-control border-primary" placeholder="Validity" name="validity[]" value="{{ $cost->validity }}"> -->
                                                        <input type="text" id="validity{{ $cost->id }}"
                                                            class="form-control border-primary datepicker" name="validity[]"
                                                            value="{{ $cost->validity }}" placeholder="Validity Date"
                                                            required>
                                                    </div>
                                                    <script>
                                                        window.lastValidity = {!! json_encode($cost->validity) !!};
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-danger delete-button"
                                                    data-date="{{ $cost->id }}">Delete</button>
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                    <div class="row validityContainer" id="" style="position:relative">
                                    </div>
                                @endif
                                <div class="col-md-12 text-center" id="validity_button">
                                    <button type="button" id="addValidity" class="btn btn-info mx-auto">Add Validity Date</button>
                                </div>

                                <!-- tow to repeat ends -->
                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>

    <script>

        flatpickr(".datepicker", {
            dateFormat: "Y-m-d",
            minDate: "today",
            enableTime: false,
            allowInput: true
        });
        if (typeof window.lastValidity !== 'undefined' && window.lastValidity !== null) {} else {
            window.lastValidity = {!! json_encode(date('Y-m-d')) !!};
        }
        var lastValidityDate = new Date(window.lastValidity);
        var nextDay = new Date(lastValidityDate);
        nextDay.setDate(lastValidityDate.getDate() + 1);
        var nextDayFormatted = nextDay.toISOString().split('T')[0];
        window.lastValidity = nextDayFormatted;
    </script>

    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-date');
                event.preventDefault()
                if (confirm('Are you sure you want to delete this validity record?')) {
                    fetch("{{ route('delete.transport_validity', '') }}/" + id, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                console.log('Validity record deleted successfully.');
                                // Perform any necessary actions after successful deletion
                                window.location.reload();
                            } else {
                                console.error('Error deleting validity record.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }

            });
        });
    </script>


    <script type="text/javascript">
        // ****************** logic for adding validity again and again
        var addButtonCounter = 0; // Counter for generating unique add button ids
        
        $("#addValidity").on("click", function(e) {
            e.preventDefault();
            var removeButtonCounter = 0; // Counter for generating unique remove button ids
            $("#validity_button").hide();
            var removeButtonId = "removeValidity" + removeButtonCounter;
            let add_validity =
        ` <div class="row validityContainer">
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-md-3 label-control">Cost </label>
                    <div class="col-md-9">
                        <input type="hidden" name="cost_id[]" />
                        <input type="number" class="form-control border-primary"
                            placeholder="Cost" name="cost[]" required>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-md-3 label-control" for="userinput2">Validity</label>
                    <div class="col-md-9">
                        <input type="date" class="form-control border-primary datepicker1"
                         name="validity[]" min="${window.lastValidity}" placeholder="Validity Date" required>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <button id="${removeButtonId}" class="btn btn-danger removeValidity" style="position:absolute; right:300px"> - </button>
            </div>
        </div>`;

    // Append the new validity row after the last one
    $(".validityContainer:last").after(add_validity);

    // Initialize date picker for the new row
    flatpickr(".datepicker1", {
                dateFormat: "Y-m-d",
                minDate: window.lastValidity,
                enableTime: false,
                allowInput: true
            });
    

        });

        // Use event delegation to handle the remove button click
        $(document).on("click", ".removeValidity", function() {
            $("#validity_button").show();
            $(this).closest('.row').remove();
        });
        // *************** logic for validity ends

        window.setTimeout(function() {
            $(".alert").fadeTo(2000, 0).slideUp(2000, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
    @if (Session::get('success'))
        <script>
            $(document).ready(function() {
                toastr.success('<?php echo Session::get('success'); ?>', 'Fast Lines Says', {
                    timeOut: 2000
                })
            });
        </script>
    @endif
@endsection
