@extends('website_layouts.master')

@section('content')

<div class="w-[95%] md:w-[80%]  mx-auto grid grid-cols-1 lg:grid-cols-2 gap-5 my-20">
    <div class="border border-gray-200 rounded-[4px] py-16 px-10 space-y-10">
        <img src="{{asset('images/logo.png')}}" alt="logo" class="h-[60px]">
        
        <div class="space-y-2">
            <h4 class="font-semibold">BUSINESS ADDRESS</h4>
            <p class="text-sm text-gray-500 font-semibold">LONDON OXFORD STREET, 012 UNITED KINGDOM.</p>
        </div>

        <div class="space-y-2">
            <h4 class="font-semibold">BUSINESS E-MAIL</h4>
            <p class="text-sm text-gray-500 font-semibold">ASTERIA@MAIL.CA</p>
        </div>

        <div class="space-y-2">
            <h4 class="font-semibold">PHONE</h4>
            <p class="text-sm text-gray-500 font-semibold">+1 222 333 456</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="#" class="bg-[#1f1f1f] h-[35px] w-[35px]  flex items-center justify-center rounded-full hover:bg-red-500 group transition-all duration-300">
                <i class="fa-brands fa-facebook-f text-red-500 text-[12px] group-hover:text-[#1f1f1f] transition-all" ></i>
            </a>
            <a href="#" class="bg-[#1f1f1f] h-[35px] w-[35px]  flex items-center justify-center rounded-full hover:bg-red-500 group transition-all duration-300">
                <i class="fa-brands fa-twitter text-red-500 text-[12px] group-hover:text-[#1f1f1f] transition-all" ></i>
            </a>
            <a href="#" class="bg-[#1f1f1f] h-[35px] w-[35px]  flex items-center justify-center rounded-full hover:bg-red-500 group transition-all duration-300">
                <i class="fa-brands fa-instagram text-red-500 text-[12px] group-hover:text-[#1f1f1f] transition-all" ></i>
            </a>
            <a href="#" class="bg-[#1f1f1f] h-[35px] w-[35px]  flex items-center justify-center rounded-full hover:bg-red-500 group transition-all duration-300">
                <i class="fa-brands fa-whatsapp text-red-500 text-[12px] group-hover:text-[#1f1f1f] transition-all" ></i>
            </a>
        </div>
    </div>    
    <div class="border border-gray-200 rounded-[4px] py-16 px-10 space-y-10">
        <form onSubmit="return validate_contact()">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="space-y-2 w-full">
                    <label  class="font-bold text-sm" for="first_name">First Name</label>
                    <input type="text" id="first_name" placeholder="First name" class=" border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5  w-full">
                </div>

                <div class="space-y-2 w-full">
                    <label  class="font-bold text-sm" for="last_name">Last Name</label>
                    <input type="text" id="last_name" placeholder="Last name" class="w-full border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5">
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-8 mt-5">
                <div class="space-y-2 w-full">
                    <label  class="font-bold text-sm" for="email">Email Address</label>
                    <input type="text" id="email" placeholder="Email" class=" border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5  w-full">
                </div>

                <div class="space-y-2 w-full">
                    <label  class="font-bold text-sm" for="subject">Subject</label>
                    <input type="text" id="subject" placeholder="Subject" class=" border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5 w-full">
                </div>
            </div>

            <div class="space-y-2 mt-5 w-full">
                <label  class="font-bold text-sm" for="comments">Comments / Questions</label>
                <textarea name="" id="comments" class="h-[200px] border border-gray-200 focus:border-gray-300 rounded-md bg-[#f6f7fa] focus:bg-white transition-all py-3 px-5 w-full"></textarea>
            </div>
            
            <input type="submit" class="bg-red-500 mb-5 py-4 px-7 rounded-full text-[12px] uppercase font-semibold text-white mt-3 cursor-pointer hover:bg-opacity-90" value="Send Message">
        </form>
        <span id="error" class="text-red-500"></span>
    </div>
</div>


<script>
   function validate_contact() {
    // Get form input values
    let first_name = document.querySelector('#first_name').value;
    let last_name = document.querySelector('#last_name').value;
    let email = document.querySelector('#email').value;
    let subject = document.querySelector('#subject').value;
    let comments = document.querySelector('#comments').value;
    let first_name_error = last_name_error = email_error = subject_error = comments_error = "";
    
    let error_message =  email_format_error = "";

    // first_name validation
    if (first_name.trim() === '') {
        first_name_error = "First Name is required";
        document.querySelector('#first_name').classList.remove('border-gray-200');
        document.querySelector('#first_name').classList.add('border-red-500');
    }
    else{
        first_name_error = "";
        document.querySelector('#first_name').classList.add('border-gray-200');
        document.querySelector('#first_name').classList.remove('border-red-500');
    }

    // last_name validation
    if (last_name.trim() === '') {
        last_name_error = "Last Name is required";
        document.querySelector('#last_name').classList.remove('border-gray-200');
        document.querySelector('#last_name').classList.add('border-red-500');
    }
    else{
        last_name_error = "";
        document.querySelector('#last_name').classList.add('border-gray-200');
        document.querySelector('#last_name').classList.remove('border-red-500');
    }

    // email validation
    if (email.trim() === '') {
        email_error = "Email is required";
        document.querySelector('#email').classList.remove('border-gray-200');
        document.querySelector('#email').classList.add('border-red-500');
    }    
    else if(!isValidEmail(email)){
        email_format_error = "Email is not in proper format";
        document.querySelector('#email').classList.remove('border-gray-200');
        document.querySelector('#email').classList.add('border-red-500');
    }
    else{
        email_error = "";
        email_format_error = "";
        document.querySelector('#email').classList.add('border-gray-200');
        document.querySelector('#email').classList.remove('border-red-500');
    }

    // subject validation
    if (subject.trim() === '') {
        subject_error = "Subject is required";
        document.querySelector('#subject').classList.remove('border-gray-200');
        document.querySelector('#subject').classList.add('border-red-500');
    }
    else{
        subject_error = "";
        document.querySelector('#subject').classList.add('border-gray-200');
        document.querySelector('#subject').classList.remove('border-red-500');
    }

    // comments validation
    if (comments.trim() === '') {
        comments_error = "Comments are required";
        document.querySelector('#comments').classList.remove('border-gray-200');
        document.querySelector('#comments').classList.add('border-red-500');
    }
    else{
        comments_error = "";
        document.querySelector('#comments').classList.add('border-gray-200');
        document.querySelector('#comments').classList.remove('border-red-500');
    }
    
    if(first_name_error === "" && last_name_error === "" && email_error === "" && subject_error === "" && comments_error === "" && email_format_error === ""){
        return true;
    }
    else if(email_format_error !== ""){
        document.querySelector("#error").innerText = email_format_error;
    }
    else{
        document.querySelector("#error").innerText = "All fields are required";
    }
    return false;
}

function isValidEmail(email) {
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

</script>

@endsection