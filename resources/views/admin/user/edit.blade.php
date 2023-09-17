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
                <div class="card-body">
                    <form class="form form-horizontal" method="POST" action="{{ route('admin.user.update' , $user->id)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-body">
                        <h4 class="form-section"><i class="la la-user"></i>Edit User</h4>
                        <div class="row">
                          	<div class="col-md-6">
                            	<div class="form-group row">
	                              	<label class="col-md-3 label-control" for="userinput1">Name</label>
		                            <div class="col-md-9">
		                                <input type="text" id="userinput1" class="form-control border-primary" value="{{ $user->name }}" 
		                                name="name" required>
		                            </div>
                        		</div>
                     		</div>
                        	<div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" id="userinput2" class="form-control border-primary" value="{{ $user->email }}" 
                                        name="email" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput3">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password" class="form-control border-primary" placeholder="Password"
                                        name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput4">Confirm Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password_confirmation" class="form-control border-primary" placeholder="Confirm Password"
                                        name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Gender</label>
                                    <div class="col-md-9">
                                        <input type="radio" name="gender" value="male" {{ $user->gender === "male" ? 'checked' : '' }}> Male
                                        <input type="radio" name="gender" value="female" {{ $user->gender === "female" ? 'checked' : '' }}> Female
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Date of Birth</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" 
                                        name="date_of_birth" value ="{{ $user->date_of_birth }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Phone</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" value ="{{ $user->phone }}"
                                        name="phone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Location</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput2" class="form-control border-primary" value ="{{ $user->location }}"
                                        name="location" required >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Profile Image</label>
                                    <div class="col-md-9">
                                        <input type="file" id="file" class="form-control border-primary"
                                        name="image" onchange="return fileValidation()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Video</label>
                                    <div class="col-md-9">
                                        <input type="file" id="video" class="form-control border-primary"
                                        name="video" onchange="return VideoValidation()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="form-section"><i class="la la-info"></i>Futher Information</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">English Level</label>
                                    <div class="col-md-9">
                                        <select class="form-control border-primary" name="english_level" required>  
                                            <option selected disabled="">Select</option>
                                            <option value="beginner" {{ $user->english_level === "beginner" ? 'selected' : '' }}>Beginner </option>
                                            <option value="intermediate" {{ $user->english_level === "intermediate" ? 'selected' : '' }}>Intermediate</option>
                                            <option value="advanced" {{ $user->english_level === "advanced" ? 'selected' : '' }}>Advanced</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Employment Status</label>
                                    <div class="col-md-9">
                                        <select class="form-control border-primary" name="employment_status" required>  
                                            <option selected disabled="">Select</option>
                                            <option value="1" {{ $user->employment_status === 1 ? 'selected' : '' }}>Employeed </option>
                                            <option value="0" {{ $user->employment_status === 0 ? 'selected' : '' }}>Unemployed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">No of Dependents</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" value ="{{ $user->no_of_dependents }}"
                                        name="no_of_dependents" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">CNIC</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput2" class="form-control border-primary" value ="{{ $user->cnic }}"
                                        name="cnic" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">About</label>
                                    <div class="col-md-9">
                                        <textarea id="projectinput9" rows="5" class="form-control border-primary" name="about" >{{ $user->about }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Salary</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" value="{{ $user->salary }}"
                                        name="salary" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="form-section"><i class="la la-briefcase"></i>Professional & Interpersonal Skills </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Professional Skills / Strength
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="input-selectize" name="professional_skills[]"  @foreach($professional_skills as $row) value ="{{$row}}"@endforeach required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Interpersonal Skills
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="input-selectize" name="interpersonal_skills[]"  @foreach($interpersonal_skills as $row) value ="{{$row}}"@endforeach required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Future Goals
                                    </label>
                                    <div class="col-md-9">
                                        <textarea id="projectinput9" rows="5" class="form-control border-primary" name="future_goals">{{ $user->future_goals }}</textarea required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i=0; ?> 
                        @foreach($careerBackgrounds as $careerBackground)
                        
                        <h4 class="form-section"><i class="la la-briefcase"></i>Career Background & Employment <?php echo ++$i; ?></h4>
                        <div class="appendexperienceparent">
                            <div class="appendexperiencechild">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Company Name</label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="company_id[]" value="{{ $careerBackground->id }}">
                                                <input type="text" id="userinput1" class="form-control border-primary" value="{{ $careerBackground->company }}" 
                                                name="company[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">City</label>
                                            <div class="col-md-9">
                                                <select class="form-control border-primary" name="city[]" required>  
                                                    <option selected disabled="">Select City</option>
                                                    <option value="Lahore" {{ $careerBackground->city === "Lahore" ? 'selected' : '' }}>Lahore</option>
                                                    <option value="Multan" {{ $careerBackground->city === "Multan" ? 'selected' : '' }}>Multan</option>
                                                    <option value="Gujrat" {{ $careerBackground->city === "Gujrat" ? 'selected' : '' }}>Gujrat</option>
                                                    <option value="Sialkot" {{ $careerBackground->city === "Sialkot" ? 'selected' : '' }}>Sialkot</option>
                                                    <option value="Islamabad" {{ $careerBackground->city === "Islamabad" ? 'selected' : '' }}>Islamabad</option>
                                                    <option value="Jalalpur Jattan" {{ $careerBackground->city === "Jalalpur Jattan" ? 'selected' : '' }}>Jalalpur Jattan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Start Date</label>
                                            <div class="col-md-9">
                                                <input type="date" id="userinput1" class="form-control border-primary" value = "{{ $careerBackground->start_date }}"
                                                name="start_date[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                            <div class="col-md-9">
                                                <input type="date" id="userinput1" class="form-control border-primary" value = "{{ $careerBackground->end_date }}"
                                                name="end_date[]" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Job Title</label>
                                            <div class="col-md-9">
                                                <input type="text" id="userinput1" class="form-control border-primary" value = "{{ $careerBackground->job_title }}"
                                                name="job_title[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2"></label>
                                            <div class="col-md-9 d-flex align-items-center">
                                                <input id="enddate1" type="checkbox" name="working_status[]" checked> <label class="pl-1 pt-1" for="enddate1">I am currently working</label>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <?php $j=0; ?>
                        @foreach($personalizedBackgrounds as $personalizedBackground)
                        <div class="PersonBackground_parent">
                        <div class="PersonBackground">
                        <h4 class="form-section"><i class="la la-briefcase"></i>Personalized Background <?php echo ++$j; ?></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Qualification</label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="qualification_id[]" value="{{ $personalizedBackground->id }}">
                                        <input type="text" id="userinput1" class="form-control border-primary" value="{{$personalizedBackground->qualification}}" 
                                        name="qualification[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Institution</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput2" class="form-control border-primary" value="{{$personalizedBackground->institution}}"
                                        name="institution[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Start Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" value="{{$personalizedBackground->start_date}}"
                                        name="institute_start_date[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary"  value="{{$personalizedBackground->end_date}}"
                                        name="institute_end_date[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Institute Address</label>
                                    <div class="col-md-9">
                                        <textarea id="projectinput9" rows="5" class="form-control border-primary" name="institution_address[]" required>{{$personalizedBackground->institution_address}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    
                                </div>
                            </div>
                        </div>
                        
                        </div>
                        </div>
                        @endforeach
                        <?php $k=0; ?>
                        @foreach($qualifications as $qualification)
                        <div class="Qualification_parent">
                        <div class="Qualification">
                        <h4 class="form-section"><i class="la la-briefcase"></i>Qualification <?php echo ++$k; ?></h4>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="userinput1">School Name</label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="school_id[]" value="{{ $qualification->id }}">
                                            <input type="text" id="userinput1" class="form-control border-primary" value="{{$qualification->school_name}}" 
                                            name="school_name[]" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="userinput1">City</label>
                                        <div class="col-md-9">
                                            <select class="form-control border-primary" name="school_city[]" required>  
                                                <option selected disabled="">Select City</option>
                                                    <option value="Lahore" {{ $careerBackground->city === "Lahore" ? 'selected' : '' }}>Lahore</option>
                                                    <option value="Multan" {{ $careerBackground->city === "Multan" ? 'selected' : '' }}>Multan</option>
                                                    <option value="Gujrat" {{ $careerBackground->city === "Gujrat" ? 'selected' : '' }}>Gujrat</option>
                                                    <option value="Sialkot" {{ $careerBackground->city === "Sialkot" ? 'selected' : '' }}>Sialkot</option>
                                                    <option value="Islamabad" {{ $careerBackground->city === "Islamabad" ? 'selected' : '' }}>Islamabad</option>
                                                    <option value="Jalalpur Jattan" {{ $careerBackground->city === "Jalalpur Jattan" ? 'selected' : '' }}>Jalalpur Jattan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Start Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" value="{{$qualification->school_start_date}}"
                                        name="school_start_date[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control border-primary" value="{{$qualification->school_end_date}}" name="school_end_date[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Degree</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput1" class="form-control border-primary" value="{{$qualification->degree}}"
                                                name="degree[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        </div>
                        </div>
                        @endforeach
                    </div>
	                    <div class="form-actions right">
	                        <button type="submit" class="btn btn-primary" onclick="return Validate()">
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
    <script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>
<script type="text/javascript">
  function Validate() 
  {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("password_confirmation").value;
    if (password != confirmPassword) 
    {
      toastr.error('Password and Confirm Password do not match', 'Zindawork Says', {timeOut: 2000})
      return false;
    }
    return true;
  }
</script>
@if(Session::get('success')) 
        <script>
            $(document).ready(function () {
                toastr.success('<?php echo Session::get('success');?>', 'Zindawork Says', {timeOut: 2000})
            });
        </script>
@endif
<script> 
    function fileValidation() { 
        var fileInput =  
                document.getElementById('file'); 
              
            var filePath = fileInput.value; 
            var image = document.getElementById("file"); 
            var allowedExtensions =  
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
              
            if (!allowedExtensions.exec(filePath)) { 
                toastr.error('Invalid File Type', 'Zindawork Says', {timeOut: 2000}) 
                fileInput.value = ''; 
                return false; 
            } 
            else if (typeof (image.files) != "undefined") {

                var size = parseFloat(image.files[0].size / (1024 * 1024)).toFixed(2); 

                if(size > 2) {

                    toastr.error('Please select image size less than 2 MB' , 'Zindawork Says', {timeOut: 2000});
                    return false;

                }else{

                    return true;

                }

            }
            else  
            {  
                if (fileInput.files && fileInput.files[0]) { 
                    var reader = new FileReader(); 
                    reader.onload = function(e) { 
                        document.getElementById( 
                            'imagePreview').innerHTML =  
                            '<img src="' + e.target.result 
                            + '"/>'; 
                    }; 
                      
                    reader.readAsDataURL(fileInput.files[0]); 
                } 
            } 
        } 
        function VideoValidation() { 
        var fileInput =  
                document.getElementById('video'); 
              
            var filePath = fileInput.value; 
            var video = document.getElementById("video"); 
            var allowedExtensions =  
                    /(\.MP4|\.MPEG-4)$/i; 
              
            if (!allowedExtensions.exec(filePath)) { 
                toastr.error('Invalid File Type', 'Zindawork Says', {timeOut: 2000}) 
                fileInput.value = ''; 
                return false; 
            } 
            else if (typeof (video.files) != "undefined") {

                var size = parseFloat(video.files[0].size / (1024 * 1024)).toFixed(20); 

                if(size > 20) {

                    toastr.error('Please select image size less than 20 MB' , 'Zindawork Says', {timeOut: 2000});
                    return false;

                }else{

                    return true;

                }

            }
            else  
            {  
                if (fileInput.files && fileInput.files[0]) { 
                    var reader = new FileReader(); 
                    reader.onload = function(e) { 
                        document.getElementById( 
                            'imagePreview').innerHTML =  
                            '<img src="' + e.target.result 
                            + '"/>'; 
                    }; 
                      
                    reader.readAsDataURL(fileInput.files[0]); 
                } 
            } 
        }
</script>
@endsection
