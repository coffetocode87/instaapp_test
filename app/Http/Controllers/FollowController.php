<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Follower;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        if (Auth::id() === $user->id) return back();

        Follower::firstOrCreate([
            'user_id' => $user->id,
            'follower_id' => Auth::id(),
        ]);

        return back();
    }

    public function unfollow(User $user)
    {
        Follower::where('user_id', $user->id)
                ->where('follower_id', Auth::id())
                ->delete();

        return back();
    }
}
