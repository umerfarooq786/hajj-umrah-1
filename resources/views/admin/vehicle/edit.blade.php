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
                        <form class="form form-horizontal" method="POST"
                            action="{{ route('vehicles.update', $vehicle->id) }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="la la la-car"></i>Edit Vehicle</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Name <span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control border-primary" placeholder="Name"
                                                    value="{{ $vehicle->name }}" name="name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 row">
                                        <label class="col-md-3 label-control" for="userinput1">Make <span
                                                class="text-danger"> *</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control border-primary" placeholder="Make"
                                                value="{{ $vehicle->make }}" name="make" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Capacity <span
                                                    class="text-danger"> *</span></label>
                                            <div class="col-md-9">
                                                <input type="Capacity" value="{{ $vehicle->capacity }}"
                                                    class="form-control border-primary" name="capacity" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class=" label-control">Images Gallery</label>
                                            <div class="col-md-9">
                                                <input type="file" id="imageUpload" name="images[]" multiple>
                                                <div id="imagePreview"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @if (count($vehicle->images) > 0)
                                        @foreach ($vehicle->images as $image)
                                            <div class="col-md-2 mb-2">
                                                <div class="card">
                                                    <img src="{{ asset($image->path) }}" alt="{{ $image->name }}"
                                                        class="card-img-top image_galery"
                                                        style="max-width: 140px;height:140px;object-fit: cover">
                                                    <a href="#" style="max-width: 70px"
                                                        class="btn btn-danger delete-image"
                                                        data-id="{{ $image->id }}">Delete</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            <p>No images found.</p>
                                        </div>
                                    @endif
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control">Display on Website</label>
                                            <div class="col-md-6">
                                                <div class="custom-control custom-switch custom-switch-lg">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="displayOnWebsite" name="display" value="1"
                                                        {{ $vehicle->display ? 'checked' : '' }}>
                                                    <label id="displayOnWebsiteLabel" class="custom-control-label"
                                                        for="displayOnWebsite">{{ $vehicle->display ? 'Yes, display this vehicle on the website' : 'No, do not display this vehicle on the website' }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions center">
                                <button type="submit" class="btn btn-primary col-md-3">
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
        $(document).ready(function() {
            $('.delete-image').click(function(e) {
                e.preventDefault();
                var imageId = $(this).data('id');
                var imageElement = $(this).closest('.col-md-4');
                if (confirm("Are you sure you want to delete this image?")) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'DELETE',
                        url: '/images/' + imageId, // Assuming your delete route is /images/{id}
                        success: function(response) {
                            // Refresh or update the view as needed
                            imageElement.remove();
                            window.location.reload();
                            console.log('Image deleted successfully');
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

        function toggleLabel() {
            var checkbox = document.getElementById('displayOnWebsite');
            var label = document.getElementById('displayOnWebsiteLabel');

            if (checkbox.checked) {
                label.textContent = "Yes, display this vehicle on the website";
            } else {
                label.textContent = "No, do not display this vehicle on the website";
            }
        }

        document.getElementById('displayOnWebsite').addEventListener('change', toggleLabel);
        toggleLabel();

        $('#imageUpload').on('change', function(e) {
            var files = e.target.files;
            $('#imagePreview').empty();
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').append('<img src="' + e.target.result + '" class="img-fluid">');
                }
                reader.readAsDataURL(files[i]);
            }
        });
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
