<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->approved()->status()->take(6)->get();
        $categories = Category::latest()->get();
        return view('home',compact('posts','categories'));
    }
}
