<?php

namespace App\Http\Controllers;
use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\facades\Auth;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $post){
        $this->validate($request,[
            'comment'=>'required'

        ]);
        $comment=new Comment;
        $comment->post_id=$post;
        $comment->user_id=Auth::id();
        $comment->comment=$request->comment;
        $comment->save();
        Toastr::success('Comment Publish Successfully',"Success");
        return redirect()->back();


    }
}
