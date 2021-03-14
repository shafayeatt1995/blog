<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
    	$comments = Comment::latest()->get(); 
    	return view('admin.comment',compact('comments'));
    }

    public function destroy($id)
    {
    	$comment = Comment::findOrFail($id)->delete();
    	Toastr::success('Comment Successfully Delete','Success');
    	return redirect()->back();
    }
}
