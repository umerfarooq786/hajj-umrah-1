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
                    <form class="form form-horizontal" method="POST" action="{{route('hotels.update', $hotel->id)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-body">
                        <h4 class="form-section"><i class="la la-hotel"></i>Edit Hotel</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control border-primary" name="name" value="{{$hotel->name}}" required>
                                    </div>
                                </div>
                            </div>
                        	<div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Excerpt</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control border-primary" placeholder="Excerpt"
                                        name="excerpt" value="{{$hotel->excerpt}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Description</label>
                                    <div class="col-md-9">
                                        <textarea name="description" class="form-control" rows="5" required>{{$hotel->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        	<div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Google Map Iframe</label>
                                    <div class="col-md-9">
                                        <textarea name="google_map" class="form-control" rows="5" required>{{$hotel->google_map}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">City</label>
                                    <div class="col-md-9">
                                        <select class="form-control border-primary" name="city" required>  
                                            <option selected disabled="">Select City</option>
                                            <option value="Makkah" {{ $hotel->city == 'Makkah' ? 'selected' : '' }}>Makkah</option>
                                            <option value="Madina" {{ $hotel->city == 'Madina' ? 'selected' : '' }}>Madina</option>
                                            <option value="Jeddah" {{ $hotel->city == 'Jeddah' ? 'selected' : '' }}>Jeddah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Note</label>
                                    <div class="col-md-9">
                                        <textarea name="note" class="form-control" rows="5" required>{{$hotel->note}}</textarea>
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
                            @if(count($hotel->images) > 0)
                                @foreach($hotel->images as $image)
                                    <div class="col-md-4">
                                        <img src="{{ asset($image->path) }}" alt="{{ $image->name }}" class="img-fluid">
                                        <a href="#" class="delete-image" data-id="{{ $image->id }}">×</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Note</label>
                                    <div class="col-md-9">
                                        <textarea name="note" class="form-control" rows="5" required>{{$hotel->note}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- view for repetitive validity starts -->
                        <div class="validityContainer"  style="margin-bottom:50px; position:relative">
                            @foreach($hotel_rooms as $hotel_room)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-6 label-control" for="userinput3">Weekdays Price for <b>{{$hotel_room->room_name}} Room</b></label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="hidden" name="room_id[]" value="{{ $hotel_room->room_id }}" />
                                                <input name="weekdays_price[]" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{$hotel_room->weekdays_price}}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-6 label-control" for="userinput3">Weekend Price for <b> {{$hotel_room->room_name}} Room</b></label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input name="weekend_price[]" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{$hotel_room->weekend_price}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">                                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="userinput2">Validity</label>
                                        <div class="col-md-9">
                                            <input type="text"  class="form-control border-primary datepicker" name="validity[]" value="{{$hotel_room->validity}}" placeholder="Validity Date" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center" id="validity_button">
                                <button id="addValidity" class="btn btn-info mx-auto">Add Validity Date</button>
                            </div>
                        <!-- view for repetitive validity ends -->
                        </div>
                    </div>
                    @if($hotel->specialOffers->count() > 0)
                    <div class="special_offer ">

                        <div class="row justify-content-between align-items-center">
                         <h4 class="border-0 my-2 pl-2"><i  class="la la-briefcase"></i> Special Offer </h4>
                         <i style="cursor:pointer; color:red;" onclick="remove_special_offer(event)" class="fas fa-times pr-2"></i>
                        </div>
                        @foreach($hotel->specialOffers as $specialOffer)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Offer Name</label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="offer_id[]" value="{{$specialOffer->id}}" />
                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Offer Name"
                                        name="offer_name[]" value="{{$specialOffer->package_name}}" required >
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                        
                        @foreach($specialOffer->rooms as $room)
                            
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Price for {{$room_category[$room->room_id-1]}}  Bed</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="hidden" name="rooms_id[]" value="{{$room->id}}">
                                            <input name="rooms_price[]" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{$room->price}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Start Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="offer_start_date[]" value="{{$specialOffer->start_date}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="offer_end_date[]" value="{{$specialOffer->end_date}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="special_offer_parent">
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary specialOffer">
                                    Add Any Special offer
                                </button>
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
@section('script')
<script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- repititive validity starts -->
<script>
    flatpickr(".datepicker", {
      dateFormat: "Y-m-d",
      minDate: "today",
      enableTime: false, 
      allowInput:true
    });
</script>
<script>
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

    $("#addValidity").on("click", function(e) {
        e.preventDefault(); 
        $("#validity_button").hide();
        // addButtonCounter++;
        // var addId = "addValidity" + addButtonCounter;

        var validityRow = $(".validityContainer:last").clone();
        
        // var lastDate = validityRow.find("input[name='validity[]']").val();
        // lastDate = new Date(lastDate);
        // const nextDate = new Date(lastDate.getTime() + 24 * 60 * 60 * 1000);
        
        validityRow.find("input:not([type=hidden])").val("");  // Clear input values in the cloned row
        // validityRow.find("input[name='validity[]']").attr({
        //     id: "newDate",            
        // });
        var removeButtonCounter = 1;
        var removeButtonId = "removeValidity" + removeButtonCounter;
        const test = validityRow.append('<button id="' + removeButtonId + '" class="btn btn-danger removeValidity" style="position:absolute; right:-20px; top:-50px">-</button>');
        
        $(".validityContainer:last").after(validityRow);
    });

    // Use event delegation to handle the remove button click
    $(document).on("click", ".removeValidity", function() {
        $("#validity_button").show();
        $(this).closest('.validityContainer ').remove();
    });
</script>
<!-- Validity ends -->
<script>
    $(document).ready(function(){
        $('.delete-image').click(function(e){
            e.preventDefault();
            var imageId = $(this).data('id');
            var imageElement = $(this).closest('.col-md-4');
            if(confirm("Are you sure you want to delete this image?")) {
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
                        console.log('Image deleted successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
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
    let add_special_offer = `<div class="special_offer">
                      <div class="row justify-content-between align-items-center">
                         <h4 class="border-0 my-2 pl-2"><i  class="la la-briefcase"></i> Special Offer </h4>
                         <i style="cursor:pointer; color:red;" onclick="remove_special_offer(event)" class="fas fa-times pr-2"></i>
                         </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Offer Name</label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="offer_id[]" value="0" />
                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Offer Name"
                                        name="offer_name[]" required >
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">

                            <?php foreach($hotel_rooms as $hotel_room)
                                { 
                            ?>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Price for {{$hotel_room->room_name}} Bed</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="hidden" name="hotel_room_id[]"  value="{{ $hotel_room->room_id }}">
                                            <input name="rooms[]" type="number" class="form-control" placeholder="Enter Price" aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                } 
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Start Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="offer_start_date[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="offer_end_date[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
</script>
@if(Session::get('success')) 
<script>
  $(document).ready(function () 
  {
    toastr.success('<?php echo Session::get('success');?>', 'Fast Lines Says', {timeOut: 2000})
  });
</script>
@endif
@endsection