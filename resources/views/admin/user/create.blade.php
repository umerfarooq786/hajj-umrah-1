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
                    <b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Zindawork!</b>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
               @endif
                <div class="card-body">
                    <form class="form form-horizontal" method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <h4 class="form-section"><i class="la la-user"></i>Create User</h4>
                        <div class="row">
                          	<div class="col-md-6">
                            	<div class="form-group row">
	                              	<label class="col-md-3 label-control" for="userinput1">Name</label>
		                            <div class="col-md-9">
		                                <input type="text" id="userinput1" class="form-control border-primary" placeholder="Name"
		                                name="name" required>
		                            </div>
                        		</div>
                     		</div>
                        	<div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" id="userinput2" class="form-control border-primary" placeholder="Email"
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
                                        <input type="radio" name="gender" value="male" checked> Male
                                        <input type="radio" name="gender" value="female"> Female
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Date of Birth</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Date of Birth"
                                        name="date_of_birth" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Phone</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="Phone"
                                        name="phone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Location</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput2" class="form-control border-primary" placeholder="Location"
                                        name="location" required>
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
                                        name="image" required onchange="return fileValidation()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Video</label>
                                    <div class="col-md-9">
                                        <input type="file" id="video" class="form-control border-primary"
                                        name="video" required onchange="return VideoValidation()">
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
                                            <option value="beginner">Beginner </option>
                                            <option value="intermediate">Intermediate</option>
                                            <option value="advanced">Advanced</option>
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
                                            <option value="1">Employeed </option>
                                            <option value="0">Unemployed</option>
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
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="No of Dependents"
                                        name="no_of_dependents" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">CNIC</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput2" class="form-control border-primary" placeholder="CNIC"
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
                                        <textarea id="projectinput9" rows="5" class="form-control border-primary" name="about" placeholder="About "></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Salary</label>
                                    <div class="col-md-9">
                                        <input type="number" id="userinput1" class="form-control border-primary" placeholder="Salary"
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
                                        <input type="text" class="input-selectize" name="professional_skills[]"  placeholder="Please enter skills separated by comma" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Interpersonal Skills
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="input-selectize" name="interpersonal_skills[]"  placeholder="Please enter skills separated by comma" required>
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
                                        <textarea id="projectinput9" rows="5" class="form-control border-primary" name="future_goals" placeholder="Future Goals"></textarea required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="form-section"><i class="la la-briefcase"></i>Career Background & Employment</h4>
                        <div class="appendexperienceparent">
                            <div class="appendexperiencechild">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Company Name</label>
                                            <div class="col-md-9">
                                                <input type="text" id="userinput1" class="form-control border-primary" placeholder="Company Name"
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
                                                    <option value="Lahore">Lahore</option>
                                                    <option value="Multan">Multan</option>
                                                    <option value="Gujrat">Gujrat</option>
                                                    <option value="Sialkot">Sialkot</option>
                                                    <option value="Islamabad">Islamabad</option>
                                                    <option value="Jalalpur Jattan">Jalalpur Jattan</option>
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
                                                <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                                name="start_date[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                            <div class="col-md-9">
                                                <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
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
                                                <input type="text" id="userinput1" class="form-control border-primary" placeholder="Job Title"
                                                name="job_title[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2"></label>
                                            <div class="col-md-9 d-flex align-items-center">
                                                <input id="enddate1" type="checkbox" name="working_status[]" checked> <label class="pl-1 pt-1" for="enddate1">I am currently working</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                    <button  type="button" class="btn btn-primary" id= "addexp">
                                         Add another experience
                                    </button>
                            </div>
                        </div>
                        <div class="PersonBackground_parent">
                        <div class="PersonBackground">
                        <h4 class="form-section"><i class="la la-briefcase"></i>Personalized Background</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Qualification</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Qualification"
                                        name="qualification[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Institution</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput2" class="form-control border-primary" placeholder="Institution"
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
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="institute_start_date[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
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
                                        <textarea id="projectinput9" rows="5" class="form-control border-primary" name="institution_address[]" placeholder="Institute Address " required></textarea>
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
                        <div class="row">
                            <div class="col-12 text-center">
                                    <button id="add_bg"  type="button" class="btn btn-primary">
                                         Add another Personalized Background
                                    </button>
                            </div>
                        </div>
                        <div class="Qualification_parent">
                        <div class="Qualification">
                        <h4 class="form-section"><i class="la la-briefcase"></i>Qualification</h4>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="userinput1">School Name</label>
                                        <div class="col-md-9">
                                            <input type="text" id="userinput1" class="form-control border-primary" placeholder="School Name"
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
                                                <option value="Lahore">Lahore</option>
                                                <option value="Multan">Multan</option>
                                                <option value="Gujrat">Gujrat</option>
                                                <option value="Sialkot">Sialkot</option>
                                                <option value="Islamabad">Islamabad</option>
                                                <option value="Jalalpur Jattan">Jalalpur Jattan</option>
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
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="school_start_date[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control border-primary" placeholder="Enter month" name="school_end_date[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Degree</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Degree"
                                                name="degree[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                    <button id="add_qual"  type="button" class="btn btn-primary" id= "">
                                         Add another Qualification
                                    </button>
                            </div>
                        </div>
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
<script type="text/javascript">
    let addexperiencehtml=`<div class="appendexperiencechild">
                         <div class="row justify-content-between align-items-center">
                         <h4 class="border-0 my-2 pl-2"><i  class="la la-briefcase"></i>Career Background & Employment</h4>
                         <i style="cursor:pointer;" onclick="removeexp(event)" class="fas fa-times pr-2"></i>
                         </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="userinput1">Company Name</label>
                                        <div class="col-md-9">
                                            <input type="text" id="userinput1" class="form-control border-primary" placeholder="Company Name"
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
                                                <option value="Lahore">Lahore</option>
                                                <option value="Multan">Multan</option>
                                                <option value="Gujrat">Gujrat</option>
                                                <option value="Sialkot">Sialkot</option>
                                                <option value="Islamabad">Islamabad</option>
                                                <option value="Jalalpur Jattan">Jalalpur Jattan</option>
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
                                            <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                            name="start_date[]" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                        <div class="col-md-9">
                                            <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
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
                                            <input type="text" id="userinput1" class="form-control border-primary" placeholder="Job Title"
                                            name="job_title[]" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="userinput2"></label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input  id="enddate1" type="checkbox" name="working_status[]" checked> 
                                            <label class="pl-1 pt-1" for="enddate1">I am currently working</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        let add_per_bg = `
                        <div class="PersonBackground">
                      <div class="row justify-content-between align-items-center">
                         <h4 class="border-0 my-2 pl-2"><i  class="la la-briefcase"></i>Personalized Background </h4>
                         <i style="cursor:pointer;" onclick="removebg(event)" class="fas fa-times pr-2"></i>
                         </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Qualification</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Qualification"
                                        name="qualification[]" required >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">Institution</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput2" class="form-control border-primary" placeholder="Institution"
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
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="institute_start_date[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
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
                                        <textarea id="projectinput9" rows="5" class="form-control border-primary" name="institution_address[]" placeholder="Institute Address " required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    
                                </div>
                            </div>
                        </div>
                        </div>
                        `;
                        let add_qual_html = `
                        <div class="Qualification">
                            <div class="row justify-content-between align-items-center">
                         <h4 class="border-0 my-2 pl-2"><i  class="la la-briefcase"></i>Qualification </h4>
                         <i style="cursor:pointer;" onclick="removequal(event)" class="fas fa-times pr-2"></i>
                         </div>         
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="userinput1">School Name</label>
                                        <div class="col-md-9">
                                            <input type="text" id="userinput1" class="form-control border-primary" placeholder="School Name"
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
                                                <option value="Lahore">Lahore</option>
                                                <option value="Multan">Multan</option>
                                                <option value="Gujrat">Gujrat</option>
                                                <option value="Sialkot">Sialkot</option>
                                                <option value="Islamabad">Islamabad</option>
                                                <option value="Jalalpur Jattan">Jalalpur Jattan</option>
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
                                        <input type="date" id="userinput1" class="form-control border-primary" placeholder="Start Date"
                                        name="school_start_date[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput2">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control border-primary" placeholder="Enter month" name="school_end_date[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput1">Degree</label>
                                    <div class="col-md-9">
                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Degree"
                                                name="degree[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>

                        `;
    $('#add_bg').on('click',()=>{
        if($(".PersonBackground").length <=2)
        {
            $('.PersonBackground_parent').append(add_per_bg);
            if($(".PersonBackground").length == 3){
                $('#add_bg').fadeOut(1)
            }
        }                           
    })

     $('#add_qual').on('click',()=>{
        if($(".Qualification").length <=2)
        {
            $('.Qualification_parent').append(add_qual_html);
            if($(".Qualification").length == 3){
                $('#add_qual').fadeOut(1)
            }
        }                           
    })

      $('#addexp').on('click',()=>{
        if($(".appendexperiencechild").length <=2)
        {
            $('.appendexperienceparent').append(addexperiencehtml);
            if($(".appendexperiencechild").length == 3){
                $('#addexp').fadeOut(1)
            }
        }                           
    })
    function removeexp(e){
        if($(".appendexperiencechild").length == 3){
            $('#addexp').fadeIn(1)
        }
        let targetvalue =e.target;
        $(targetvalue).parent().parent().remove();  
    }
      function removebg(e){
        if($(".PersonBackground").length == 3){
            $('#add_bg').fadeIn(1)
        }
        let targetvalue =e.target;
        $(targetvalue).parent().parent().remove();  
    }
      function removequal(e){
        if($(".Qualification").length == 3){
            $('#add_qual').fadeIn(1)
        }
        let targetvalue =e.target;
        $(targetvalue).parent().parent().remove();  
    }
    let count = 0;
    function currentlywork(e){
        let valuelistparent = e.target;
        console.log($(valuelistparent).parent().parent().parent().parent())
        if(count == 0){
            count=1
            $('#enddate').fadeOut(1)
        }
        else{
            count=0
            $('#enddate').fadeIn(1)
        }
    }
</script>
<script>
    $(document).ready(function(){
        $("#btn11").click(function(){
             $(".sohail11").append(`<div class="mt-3 " id="ss">
        <div class="p-3 bg-white border_radius position-relative">
         <small style="top: 3%; right: 3%" class="text-danger border-danger mb-3 float-right  border p-2" onclick="$(this).parents('#ss').hide()"><i class="fa fa-trash"></i> remove section</small>
         <h5>Qualification</h5>
         <div class="form-group">
                     <label for="fn" class="mb-1 w-100 mr-2">School Name</label>
                     <input type="text" placeholder="Enter company name" class="form-control p-2">
                  </div>
                  
                  <div class="form-group">
                     <label for="salary" class="mb-1 w-100 mr-2">City</label>
                     <input type="number" class="form-control p-2" placeholder="Enter city" id="salary">
                  </div>
                  <div class="form-group">
                     <label for="salary" class="mb-1 w-100 mr-2">Degree</label>
                     <input type="number" class="form-control p-2" placeholder="Enter job title" id="salary">
                  </div>
                  <div class="form-group d-flex">
                     <div class="flex_1 mr-2"><label for="salary" class="mb-1 w-100 mr-2">Start Date</label>
                     <input type="number" class="form-control p-2" placeholder="Enter start date" id="salary"></div>
                     <div class="flex_1 mr-2"> <label for="salary" class="mb-1 w-100 mr-2">Month</label>
                     <input type="number" class="form-control p-2" placeholder="Enter month" id="salary"></div>
                     

                  </div>
                  <div class="form-group mb-0 d-flex">
                        <div class="flex_1 mr-2 red box"> <label for="salary" class="mb-1 w-100 mr-2">End Date</label>
                     <input type="number" class="form-control p-2" placeholder="Enter end date" id="salary"></div>
                     <div class="flex_1 red box"> <label for="salary" class="mb-1 w-100 mr-2">Month</label>
                     <input type="number" class="form-control p-2" placeholder="Enter month" id="salary"></div>
                     

                  </div>
                  <div class="box"><br></div>
                  <div class="flex_1">
                        <div class="form-group form-check mb-0 float-right">
             <input type="checkbox" class="form-check-input" value="red" id="exampleCheck1">
             <label class="form-check-label" for="exampleCheck1">&nbsp;I am currently working</label>
           </div>

                     </div>
                  <div class="form-group" style="clear: both">
                     <label for="salary" class="mb-1 w-100 mr-2">Home Address</label>
                    <textarea name="" type="text" class="form-control p-2" style="resize: none;" placeholder="Enter introduction"></textarea>
                  </div>
                   

               </div>
               </div>`);
           });
    });
</script>
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
<script type="text/javascript">
      window.setTimeout(function() {
          $(".alert").fadeTo(2000, 0).slideUp(2000, function(){
              $(this).remove(); 
          });
      }, 2000);
</script>
@endsection
