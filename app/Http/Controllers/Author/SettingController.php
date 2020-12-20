<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
     public function index(){
     return view('author.setting');
     }


     public function ProfileUpdate(Request $request){

     $this->validate($request, [

     'name'=>'required',
     'email'=>'required|email',
     'image'=>'required|image',


     ]);
     $image=$request->file('image');
     $slug=str_slug($request->name);
     $user=User::findorfail(Auth::id());
     if(isset($image)){
     $currentdate=Carbon::now()->toDateString();
     $imagename=$slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

     if(!Storage::disk('public')->exists('profile')){
     Storage::disk('public')->makeDirectory('profile');
     }
     if(Storage::disk('public')->exists('profile',$user->image)){
     Storage::disk('public')->delete('profile',$user->image);
     }

     $profile=Image::make($image)->resize(500,500)->stream();
     Storage::disk('public')->put('profile/',$imagename,$profile);

     }
     else{
     $imagename=$user->image;
     }
     $user->name=$request->name;
     $user->email=$request->email;
     $user->image=$imagename;
     $user->about=$request->about;
     $user->save();
     Toastr::success('Profile Update Successfully','Success');
     return redirect()->back();

     }

     public function PasswordUpdate(Request $request){
     $this->validate($request,[

     'old_password'=>'required',
     'password'=>'required|confirmed',

     ]);
     $hashedpassword=Auth::user()->password;
     if(Hash::check($request->old_password, $hashedpassword)){
     if(!Hash::check($request->password, $hashedpassword)){

     $user=User::find(Auth::id());
     $user->password=Hash::make($request->password);
     $user->save();
     Toastr::success('Password Changed Successfully','Success');
     Auth::logout();
     return redirect()->back();
     }
     else{
     Toastr::error('Password Can not be same','Error');
     return redirect()->back();
     }
     }
     else{
     Toastr::error('Password not matched!','Error');
     return redirect()->back();
     }

     }
}
