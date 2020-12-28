<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\facades\Auth;

class FavouriteController extends Controller
{
    public function add($post){
        $user=Auth::user();
        $isfavourite=$user->favourite_posts()->where('post_id',$post)->count();

        if($isfavourite==0){
            $user->favourite_posts()->attach($post);
            Toastr::success('This Post added to your favourite List',"Success");
            return redirect()->back();
        }
        else{
                $user->favourite_posts()->detach($post);
                Toastr::success('This Post removed to your favourite List',"Success");
                return redirect()->back();
        }
    }
    
}
