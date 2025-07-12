<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
     public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('explore.index', compact('posts'));
    }
}
