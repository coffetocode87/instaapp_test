<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        // Ambil semua post milik user ini
        $posts = $user->posts()->latest()->get();

        return view('profile.show', compact('user', 'posts'));
    }

    public function edit(User $user)
{
    if (Auth::id() !== $user->id) {
        abort(403);
    }

    return view('profile.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    if (Auth::id() !== $user->id) {
        abort(403);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string|max:1000',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('avatar')) {
        $avatarName = time() . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('avatars'), $avatarName);
        $user->avatar = $avatarName;
    }

    $user->name = $request->name;
    $user->bio = $request->bio;
    $user->save();

    return redirect()->route('profile.show', $user->id)->with('success', 'Profil diperbarui!');
}

public function followers(User $user)
{
    $followers = $user->followers()->get(); // sudah dapat list user
    return view('profile.followers', compact('user', 'followers'));
}

public function following(User $user)
{
    $following = $user->following()->get(); // juga dapat list user
    return view('profile.following', compact('user', 'following'));
}


}
