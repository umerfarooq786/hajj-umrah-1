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
                    <form class="form form-horizontal" method="POST" action="{{route('admin.calculate_package')}}">
                    @csrf
                    <div class="form-body">
                        <h4 class="form-section"><i class="la la-hotel"></i>Hotel Selection</h4>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">City</label>
                                    <div class="col-md-9">
                                        <select class="form-control border-primary" name="city[]" required>  
                                            <option selected disabled="">Select City</option>
                                            <option value="Makkah">Makkah</option>
                                            <option value="Madina">Madina</option>
                                            <option value="Jeddah">Jeddah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Start Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="start_date[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="End Date"
                                        name="end_date[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Room</label>
                                    <div class="col-md-9">
                                        <select class="form-control border-primary" name="room_id[]" required>  
                                            <option selected disabled="">Select Room</option>
                                            @foreach($rooms as $room)
                                            <option value="{{$room->id}}">{{$room->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">No of Adults</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="No of Adults"
                                        name="no_of_adults[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">No of Children</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="No of Children"
                                        name="no_of_children[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="special_offer_parent">
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary specialOffer">
                                    Add More
                                </button>
                            </div>
                        </div>
                    </div>
                    <h4 class="form-section"><i class="la la-car"></i>Transport Selection</h4>
                    
                        <div class="row">
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Route</label>
                                <div class="col-md-9">
                                    <select class="form-control border-primary" name="route_id[]" required>  
                                        <option selected disabled="">Select Route</option>
                                        @foreach($routes as $route)
                                        <option value="{{$route->id}}">{{$route->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Vehicle Qty</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="Vehicle Qty"
                                        name="no_of_vehicles[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Transport Type</label>
                                    <div class="col-md-9">
                                        <select class="form-control border-primary" name="route_id[]" required>  
                                            <option selected disabled="">Select Transport Type</option>
                                            @foreach($transport_types as $transport_type)
                                            <option value="{{$transport_type->id}}">{{$transport_type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="transport_parent">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-primary transportBtn">
                                        Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                        <h4 class="form-section"><i class="la la-car"></i>Umrah Visa</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Visa Charges</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="Visa Charges"
                                        name="visa_charges" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Residence</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Country of Residence"
                                        name="country_of_residence" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Nationality</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Nationality"
                                        name="country_of_nationality" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions right">
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> Calculate Package
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
<script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(2000, function(){
            $(this).remove(); 
        });
    }, 2000);
    $('.specialOffer').on('click',()=>{
        $('.special_offer_parent').append(add_special_offer);
        if($(".special_offer").length == 3){
            $('.specialOffer').fadeOut(1)
        }                               
    });
    function remove_special_offer(e){
        if($(".special_offer").length == 3){
            $('.specialOffer').fadeIn(1)
        }
        let targetvalue =e.target;
        $(targetvalue).parent().parent().remove();  
    }
     $('.transportBtn').on('click',()=>{
        $('.transport_parent').append(add_transport);
        if($(".new_transport").length == 3){
            $('.transportBtn').fadeOut(1)
        }                               
    });
    function remove_transport(e){
        if($(".new_transport").length == 3){
            $('.transportBtn').fadeIn(1)
        }
        let targetvalue =e.target;
        $(targetvalue).parent().parent().remove();  
    }
    let add_special_offer = `<div class="special_offer">
                      <div class="row justify-content-between align-items-center">
                         <h4 class="border-0 my-2 pl-2"><i  class="la la-hotel"></i> Hotel Selection </h4>
                         <a href="#" class="btn btn-danger" onclick="remove_special_offer(event)">Remove</a>
                         </div>
                         <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">City</label>
                                    <div class="col-md-9">
                                        <select class="form-control border-primary" name="city[]" required>  
                                            <option selected disabled="">Select City</option>
                                            <option value="Makkah">Makkah</option>
                                            <option value="Madina">Madina</option>
                                            <option value="Jeddah">Jeddah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Start Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="start_date[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="End Date"
                                        name="end_date[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Room</label>
                                    <div class="col-md-9">
                                        <select class="form-control border-primary" name="room_id[]" required>  
                                            <option selected disabled="">Select Room</option>
                                            @foreach($rooms as $room)
                                            <option value="{{$room->id}}">{{$room->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">No of Adults</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="No of Adults"
                                        name="no_of_adults[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">No of Children</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="No of Children"
                                        name="no_of_children[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
        let add_transport = `<div class="new_transport">
                      <div class="row justify-content-between align-items-center">
                         <h4 class="border-0 my-2 pl-2"><i  class="la la-car"></i> Hotel Selection </h4>
                         <a href="#" class="btn btn-danger" onclick="remove_transport(event)">Remove</a>
                         </div>
                         <div class="row">
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Route</label>
                                <div class="col-md-9">
                                    <select class="form-control border-primary" name="route_id[]" required>  
                                        <option selected disabled="">Select Route</option>
                                        @foreach($routes as $route)
                                        <option value="{{$route->id}}">{{$route->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Vehicle Qty</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="No of Adults"
                                        name="no_of_vehicles[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Transport Type</label>
                                    <div class="col-md-9">
                                        <select class="form-control border-primary" name="route_id[]" required>  
                                            <option selected disabled="">Select Transport Type</option>
                                            @foreach($transport_types as $transport_type)
                                            <option value="{{$transport_type->id}}">{{$transport_type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
</script>
@endsection