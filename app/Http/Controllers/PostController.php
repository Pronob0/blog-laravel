<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(){
        $posts=Post::latest()->paginate(6);
        return view('posts',compact('posts'));

    }


    public function details($slug){

    $post=Post::where('slug',$slug)->first();
    $blogkey='blog_'.$post->id;
    if(!Session::has($blogkey)){
        $post->increment('view_count');
        Session::put($blogkey,1);

    }
    $randomposts=Post::all()->random(3);
    return view('post',compact('post','randomposts'));

    }
}
