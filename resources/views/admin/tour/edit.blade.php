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
                        <form class="form form-horizontal" method="POST" action="{{ route('tours.update', $tour->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="la la la-car"></i>Edit Tour Info</h4>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Tour Name</label>
                                            <div class="col-md-9">
                                                <input type="text" id="userinput2" class="form-control border-primary"
                                                    name="name" value="{{ $tour->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Tour Type </label>
                                            <div class="col-md-9">
                                                <select id="userinput2" class="form-control border-primary" name="type">
                                                    <option value="international"
                                                        {{ $tour->type === 'international' ? 'selected' : '' }}>
                                                        International Tours</option>
                                                    <option value="domestic"
                                                        {{ $tour->type === 'domestic' ? 'selected' : '' }}>Domestic Tours
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Description</label>
                                            <div class="col-md-9">
                                                <input type="text" id="" class="form-control border-primary"
                                                    placeholder="Description" value="{{ $tour->description }}"
                                                    name="description" required>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Note</label>
                                            <div class="col-md-9">
                                                <input type="text" id="" class="form-control border-primary"
                                                    placeholder="Note" value="{{ $tour->note }}" name="note" required>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Tour Image </label>
                                            <div class="col-md-9">
                                                <img style='height:60px; width:60px'
                                                    src="{{ asset('uploads/' . $tour->image) }}" alt="">
                                                <input type="file" id="userinput2" class="form-control border-primary"
                                                    name="image">
                                            </div>
                                        </div>
                                    </div>

                                </div>

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
