<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index(){
    $posts=Auth::user()->favourite_posts;
    return view('author.favourite',compact('posts'));
    }
}
