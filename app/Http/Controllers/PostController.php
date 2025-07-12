<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // Ambil ID user yang di-follow
    $followingIds = Follower::where('follower_id', $user->id)->pluck('user_id')->toArray();


    // Tambahkan ID user sendiri agar postingan sendiri juga muncul
    $followingIds[] = $user->id;

    // Ambil postingan dari user yang di-follow
    $posts = Post::with(['user', 'likes', 'comments'])
                ->whereIn('user_id', $followingIds)
                ->latest()
                ->get();

    return view('home', compact('posts'));
}

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Post::create([
            'user_id' => Auth::id(),
            'caption' => $request->caption,
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Posting berhasil diunggah!');
    }

    public function edit(Post $post)
{
    // Hanya pemilik post yang boleh mengedit
    if ($post->user_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    return view('posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    if ($post->user_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'caption' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Update caption
    $post->caption = $request->caption;

    // Jika ada gambar baru
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $post->image = $imageName;
    }

    $post->save();

    return redirect('/home')->with('success', 'Posting berhasil diperbarui!');
}


    public function destroy(Post $post)
{
    if ($post->user_id === Auth::id()) {
        $post->delete();
    }
    return back();
}




}
