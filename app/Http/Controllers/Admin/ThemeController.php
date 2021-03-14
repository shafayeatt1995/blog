<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Theme;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::latest()->get();
        return view('admin.theme.index',compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.theme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'class' => 'required',
        ]);
        $theme = new Theme();
        $theme->name = $request->name;
        $theme->class = $request->class;
        $theme->save();
        Toastr::success('Theme Successfully Save','Success');
        return redirect()->route('admin.theme.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        return view('admin.theme.edit',compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theme $theme)
    {
        $this->validate($request, [
            'name' => 'required',
            'class' => 'required',
        ]);
        $theme->name = $request->name;
        $theme->class = $request->class;
        $theme->save();
        Toastr::success('Theme Successfully Updated','Success');
        return redirect()->route('admin.theme.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        $theme->delete();
        Toastr::success('Theme Successfully Deleted','Success');
        return redirect()->back();
    }
}
