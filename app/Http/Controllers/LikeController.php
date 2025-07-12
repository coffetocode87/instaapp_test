<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        if (!$post->likedBy(Auth::id())) {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);
        }
        return back();
    }

    public function unlike(Post $post)
    {
        Like::where('user_id', Auth::id())->where('post_id', $post->id)->delete();
        return back();
    }
}

