@extends('admin_layouts.master')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/selectize/selectize.css') }}">
    <script src="https://kit.fontawesome.com/d868f4cf6e.js" crossorigin="anonymous"></script>
@endsection
@section('content')
    <div class="content-header row">
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
                        <form class="form form-horizontal" method="POST" action="{{ route('transports.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="la la la-car"></i>Add Transport</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Vehicle</label>
                                            <div class="col-md-9">
                                                <select class="form-control border-primary" name="vehicle_id" required>
                                                    <option selected disabled="">Select Vehicle</option>
                                                    @foreach ($transport_types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput4">Route</label>
                                            <div class="col-md-9">
                                                <select class="form-control border-primary" name="route_id" required>
                                                    <option selected disabled="">Select Route</option>
                                                    @foreach ($routes as $route)
                                                        <option value="{{ $route->id }}">{{ $route->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control">Cost
                                                <b>({{ $current_currency->default_currency }})</b></label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control border-primary" placeholder="Cost"
                                                    name="cost" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control">Commision
                                            </label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control border-primary"
                                                    placeholder="Commision" name="commision" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Validity - Start
                                                Date</label>
                                            <div class="col-md-9">
                                                <!-- <input type="date" id="userinput1" class="form-control border-primary" placeholder="Validity"
                                                                    name="validity" required> -->
                                                <input type="text" name="validity_start" required id="datepicker"
                                                    class="form-control border-primary" placeholder="Validity Start Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Validity - End
                                                Date</label>
                                            <div class="col-md-9">
                                                <!-- <input type="date" id="userinput1" class="form-control border-primary" placeholder="Validity"
                                                                    name="validity" required> -->
                                                <input type="text" name="validity_end" required id="datepickerEnd"
                                                    class="form-control border-primary" placeholder="Validity End Date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Save
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
    <script>
        flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
            minDate: "today",
            enableTime: false, // set to true if you want to enable time selection
        });

        flatpickr("#datepickerEnd", {
            dateFormat: "Y-m-d",
            minDate: new Date(new Date().getTime() + 24 * 60 * 60 * 1000),
            enableTime: false, // set to true if you want to enable time selection
        });
    </script>

    <script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
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
