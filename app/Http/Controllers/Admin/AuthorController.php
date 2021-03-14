<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::latest()->authors()->withCount('posts')->withCount('favorite_posts')->withCount('comments')->get();
        return view('admin.author',compact('authors'));
    }
    public function destroy($id)
    {
        $author = User::findOrFail($id)->delete();
        Toastr::success('Tag Successfully Updated', 'Success');
        return redirect()->back();
    }
}
