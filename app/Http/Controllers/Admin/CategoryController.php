<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this ->validate($request,[
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        //Get Image From Form
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if (isset($image))
        {
            //make unique name for image
            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //Check Category folder if exist
            if (!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }
            //resize image for category & Upload
            $category = Image::make($image)->resize(1600,479)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('category/'.$imagename,$category);

            //Check Category Slider folder if exist
            if (!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            //resize image for category slider & Upload
            $slider = Image::make($image)->resize(500,333)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('category/slider/'.$imagename,$slider);
        }
        else
        {
            $imagename = "default.png";
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();
        Toastr::success('Category Successfully Save','Success');
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
        $category = Category::find($id);
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
        $this ->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);
        //Get Image From Form
        $images = $request->file('image');
        $slug = str_slug($request->name);
        $category = Category::find($id);
        if (isset($images))
        {
            //make unique name for image
            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentdate.'-'.uniqid().'.'.$images->getClientOriginalExtension();

            //Check Category folder if exist
            if (!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }
            //delete old image
            if (Storage::disk('public')->exists('category/'.$category->image))
            {
                Storage::disk('public')->delete('category/'.$category->image);
            }
            //resize image for category & Upload
            $categoryImage= Image::make($images)->save($images->getClientOriginalExtension());
            Storage::disk('public')->put('category/'.$imagename,$categoryImage);

            //Check Category Slider folder if exist
            if (!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            //delete Slider old image
            if (Storage::disk('public')->exists('category/slider/'.$category->image))
            {
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }

            //resize image for category slider & Upload
            $sliderImage= Image::make($images)->resize(1600,1066)->save($images->getClientOriginalExtension());
            Storage::disk('public')->put('category/slider/'.$imagename,$sliderImage);
        }
        else
        {
            $imagename = $category->image;
        }
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();
        Toastr::success('Category Successfully Updated','Success');
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
        $category = Category::find($id);
        if (Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }
        if (Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider'.$category->image);
        }
        $category->delete();
        Toastr::success('Category Successfully deleted','Success');
        return redirect()->back();


    }
}
