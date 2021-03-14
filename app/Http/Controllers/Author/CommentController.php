<?php

namespace App\Http\Controllers\Author;

use Auth;
use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
    	$posts = Auth::user()->posts;
    	return view('author.comment',compact('posts'));
    }

    public function destroy($id)
    {
    	$comment = Comment::findOrFail($id);
    	if ($comment->post->user->id == Auth::id()) {
    		$comment->delete();
    		Toastr::success('Comment Successfully Delete','Success');	
    	} else {
    		Toastr::error('You are not authorised to delete this comment','Error');
    	}
		return redirect()->back();	
    }
}
