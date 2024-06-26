@extends('admin_layouts.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert.css') }}">
    <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js') }}"></script>
@endsection
@section('content')
    <div class="content-body">

        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Role</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                            <div class="heading-elements">
                                <div class="pull-right">
                                    {{-- <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a> --}}
                                </div>
                            </div>
                        </div>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-body">
                            <form class="form form-horizontal" method="POST"
                                action="{{ route('roles.update', $role->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la la-car"></i>Edit Role</h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Name:</strong>
                                                <input type="text" name="name" placeholder="Name" class="form-control"
                                                    value="{{ $role->name }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Permission:</strong>
                                                <br>
                                                @foreach ($permission as $value)
                                                    <label>
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $value->id }}" class="name"
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                        {{ $value->name }}
                                                    </label><br />
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
    @if (Session::get('success'))
        <script>
            $(document).ready(function() {
                toastr.success('<?php echo Session::get('success'); ?>', 'Fastline Says', {
                    timeOut: 2000
                })
            });
        </script>
    @endif
@endsection
