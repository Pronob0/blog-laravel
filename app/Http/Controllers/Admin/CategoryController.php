<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use Carbon\Carbon;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  $tables=Category::all();
        return view('admin.category.index',compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create ');
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
            'name'=>'required|unique:categories',
            'image'=>'required|mimes:jpeg,jpg,png',
        ]);
        $image=$request->file('image');
        $slug=str_slug('$request->name');
        if(isset($image)){
            $date=Carbon::now()->toDateString();
            $image_name=$slug.'-'.$date.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            $category=Image::make($image)->resize(1600,479)->stream(); 
            Storage::disk('public')->put('category/'.$image_name,$category);

            if(!Storage::disk('public')->exists('category/slider')){
            Storage::disk('public')->makeDirectory('category/slider');
            }
            $slider=Image::make($image)->resize(500,333)->stream();
            Storage::disk('public')->put('category/slider/'.$image_name,$slider);
        }
        else{
            $image_name='default.png';
        }
        $category=new Category;
        $category->name=$request->name;
        $category->slug=$slug;
        $category->image=$image_name;
        $category->save();
        Toastr::success('Category Added Successfully!','success');
        return redirect()->route('admin.category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
        'name'=>'required',
        'image'=>'mimes:jpeg,jpg,png',
        ]);
        $image=$request->file('image');
        $slug=str_slug('$request->name');
        $category=Category::find($id);
        if(isset($image)){
        $date=Carbon::now()->toDateString();
        $image_name=$slug.'-'.$date.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        if(!Storage::disk('public')->exists('category')){
        Storage::disk('public')->makeDirectory('category');
        } 
        if(Storage::disk('public')->exists('category/'.$category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
        }
        $categoryname=Image::make($image)->resize(1600,479)->stream();
        Storage::disk('public')->put('category/'.$image_name,$categoryname);

        if(!Storage::disk('public')->exists('category/slider')){
        Storage::disk('public')->makeDirectory('category/slider');
        }
        if(Storage::disk('public')->exists('category/slider/'.$category->image)){
        Storage::disk('public')->delete('category/slider/'.$category->image);
        }
        $slider=Image::make($image)->resize(500,333)->stream();
        Storage::disk('public')->put('category/slider/'.$image_name,$slider);
        }
        else{
        $image_name=$category->image;
        }
        $category->name=$request->name;
        $category->slug=$slug;
        $category->image=$image_name;
        $category->save();
        Toastr::success('Category Updated Successfully!','success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        Toastr::success('Category Deleted Successfully','success');
        return redirect()->back();
    }
}
