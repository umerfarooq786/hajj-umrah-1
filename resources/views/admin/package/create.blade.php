@extends('admin_layouts.master')
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
                        <form class="form form-horizontal" method="POST" action="{{ route('packages.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="la la la-car"></i>Add Package</h4>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Package Name</label>
                                            <div class="col-md-9">
                                                <input type="text" id="userinput2" class="form-control border-primary"
                                                    placeholder="Package" name="name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Package Type </label>
                                            <div class="col-md-9">
                                                <select id="userinput2" class="form-control border-primary" name="type">
                                                    <option value="umrah">Umrah</option>
                                                    <option value="hajj">Hajj</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Package Image </label>
                                            <div class="col-md-9">
                                                <input type="file" id="userinput2" class="form-control border-primary"
                                                    name="image" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Package Category </label>
                                            <div class="col-md-9">
                                                <select id="" class="form-control border-primary" name="category">
                                                    <option value="5 Star Package">5 Star Package</option>
                                                    <option value="4 Star Package">4 Star Package</option>
                                                    <option value="3 Star Package">3 Star Package</option>
                                                    <option value="Standard Package">Standard Package</option>
                                                    <option value="Economy Package">Economy Package</option>
                                                    <option value="Special Offer Package">Special Offer Package</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Note</label>
                                            <div class="col-md-9">
                                                <input type="text" id="" class="form-control border-primary"
                                                    placeholder="Note" name="note" required>
                                            </div>
                                        </div>
                                    </div> --}}
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
