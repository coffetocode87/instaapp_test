<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
   

public function store(Request $request, Post $post)
{
    $request->validate(['comment' => 'required|string|max:255']);

    Comment::create([
        'user_id' => Auth::id(),
        'post_id' => $post->id,
        'comment' => $request->comment,
    ]);

    return back();
}

}
