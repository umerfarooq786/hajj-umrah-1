<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    public function index()
    {
        return view('website.user.dashboard');
    }

    public function simple_profile()
    {
    	return view('website.user.simple-profile.index');
    }

    public function detail_profile()
    {
        $user = Auth::user();

        $professional_skills = json_decode($user->professional_skills);
        if(empty(json_decode($user->interpersonal_skills))){
            $interpersonal_skills = array();
        }else{
            $interpersonal_skills = json_decode($user->interpersonal_skills);
        }

        if(empty(json_decode($user->professional_skills))){
            $professional_skills = array();
        }else{
            $professional_skills = json_decode($user->professional_skills);
        }
        
        $careerBackgrounds = $user->careerBackgrounds;
        $personalizedBackgrounds = $user->personalizedBackgrounds;
        $qualifications = $user->qualifications; 

        return view('website.user.detail-profile.index' , compact('user' , 'careerBackgrounds' , 'professional_skills' , 'interpersonal_skills' ,'personalizedBackgrounds' , 'qualifications'));
    }

    public function edit_simple_profile()
    {
        $user = Auth::user();

    	return view('website.user.simple-profile.edit' , compact('user'));
    }

    public function simple_profile_settings()
    {
        $user = Auth::user();

        return view('website.user.simple-profile.account-setting' , compact('user'));
    }

    public function store_detail_profile(Request $request)
    {
        return $request;
    }

    public function update_simple_profile(Request $request , $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->location = $request->location;

        if($request->has('image'))
        {
            if(isset($user->image)) {
                @unlink('storage/user_image/' . $user->image);
            }
            
            $image = $request->file('image');
            $user_image = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/user_image');
            $image->move($destinationPath, $user_image);
            $user->image = $user_image;

        }

        $user->save();

        return redirect()->route('user.simple.profile')->with('success' , "Simple Profile Updated Successfully");
    }

    public function resume()
    {
        $id=Auth::user()->id;
        $user = User::findOrFail($id);

        $professionalSkills = json_decode($user->professional_skills);
        $profSkills = explode(",", $professionalSkills[0]);
        $interpersonalSkills = json_decode($user->interpersonal_skills);
        $intpersonalSkills = explode(",", $interpersonalSkills[0]);

        return view('website.user.resume.index' , compact('profSkills' , 'intpersonalSkills'));
    }

    public function update_profile_settings(Request $request , $id)
    { 
        $user = User::findOrFail($id);
        $hashedPassword = $user->password;

        if(isset($request->password))
        {
            if($this->checkPassword($request->current_password, $hashedPassword)==true)
            {
                $user->password = Hash::make($request->password);
            }
            else
            {
                return redirect()->back()->with('error' , "Your current password is incorrect");
            }
        }

        if($request->is_active == "on")
        {
            $user->is_active= 1;
        }
        else
        {
            $user->is_active= 0;
        }

        $user->save();

        return redirect()->back()->with('success' , "Your settings has been updated Successfully");
    }

    public function checkPassword($current_password , $hashedPassword)
    {
        if (Hash::check($current_password , $hashedPassword)) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
