<?php

namespace App\Http\Controllers\Author;
use App\User;
use App\post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewAuthorPost;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Notification;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts=Auth::user()->posts()->latest()->get();
         return view('author.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('author.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
        'title'=>'required|unique:posts',
        'image'=>'required',
        'status'=>'required',
        'categories'=>'required',
        'tags'=>'required',
        'body'=>'required',

        ]);
        $image=$request->file('image');
        $slug=str_slug($request->title);
        if(isset($image)){
        $date=Carbon::now()->toDateString();
        $image_name=$slug.'-'.$date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

        if(!Storage::disk('public')->exists('post')){

        Storage::disk('public')->makeDirectory('post');

        }
        $postimage=Image::make($image)->resize(1600,1066)->stream();
        Storage::disk('public')->put('post/'.$image_name,$postimage);
        }
        else{
        $image_name='default.png';
        }

        $post=new Post();
        $post->user_id=Auth::id();
        $post->title=$request->title;
        $post->slug=$slug;
        $post->image=$image_name;
        $post->body=$request->body;
        if(isset($request->status)){
        $post->status=true;
        }else{
        $post->status=false;
        }
        $post->is_approved=false;
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        $users=User::where('role_id','1')->get();
        Notification::send($users, new NewAuthorPost($post));
        Toastr::success('Post Added Successfully','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        if($post->user_id !=Auth::id()){
            Toastr::error('You are not Authorized for view this post','Error');
            return redirect()->back();
        }
            return view('author.post.show',compact('post'));


        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {

        if($post->user_id !=Auth::id()){
        Toastr::error('You are not Authorized for view this post','Error');
        return redirect()->back();
        }
        $categories=Category::all();
        $tags=Tag::all();
        return view('author.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        if($post->user_id !=Auth::id()){
        Toastr::error('You are not Authorized for view this post','Error');
        return redirect()->back();
        }
        $this->validate($request,[
        'title'=>'required|unique:posts',
        'image'=>'image',
        'status'=>'required',
        'categories'=>'required',
        'tags'=>'required',
        'body'=>'required',

        ]);
        $image=$request->file('image');
        $slug=str_slug($request->title);
        if(isset($image)){
        $date=Carbon::now()->toDateString();
        $image_name=$slug.'-'.$date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

        if(!Storage::disk('public')->exists('post')){

        Storage::disk('public')->makeDirectory('post');
        }
        if(Storage::disk('public')->exists('post/'.$post->image)){
        Storage::disk('public')->delete('post/'.$post->image);
        }
        $postimage=Image::make($image)->resize(1600,1066)->stream();
        Storage::disk('public')->put('post/'.$image_name,$postimage);
        }
        else{
        $image_name=$post->image;
        }


        $post->user_id=Auth::id();
        $post->title=$request->title;
        $post->slug=$slug;
        $post->image=$image_name;
        $post->body=$request->body;
        if(isset($request->status)){
        $post->status=true;
        }else{
        $post->status=false;
        }
        $post->is_approved=false;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        Toastr::success('Post Added Successfully','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        $post->delete();
        Toastr::success('Post Delete Successfully','Success');
        return redirect()->back();
    }
}
