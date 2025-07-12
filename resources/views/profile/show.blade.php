@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="fw-bold">{{ $user->name }}</h2>
            <p class="text-muted mb-0">📸 {{ $posts->count() }} Postingan</p>
        </div>
    </div>

    @if($user->avatar)
    <img src="{{ asset('avatars/' . $user->avatar) }}" class="rounded-circle mb-3" style="height: 120px;">
@endif

<h2 class="fw-bold">{{ $user->name }}</h2>
@if(Auth::id() !== $user->id)
    <form action="{{ $user->isFollowedBy(Auth::id()) ? route('unfollow', $user->id) : route('follow', $user->id) }}" method="POST" class="d-inline">
        @csrf
        @if ($user->isFollowedBy(Auth::id()))
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">🚫 Unfollow</button>
        @else
            <button type="submit" class="btn btn-primary">➕ Follow</button>
        @endif
    </form>
@endif



<p class="mt-2">
    <a href="{{ route('profile.followers', $user->id) }}" class="me-3 text-decoration-none">
        <strong>{{ $user->followers->count() }}</strong> Pengikut
    </a>
    <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none">
        <strong>{{ $user->following->count() }}</strong> Mengikuti
    </a>
</p>



@if($user->bio)
    <p class="text-muted">{{ $user->bio }}</p>
@endif


    <h4 class="mb-3 fw-bold">🖼️ Galeri Postingan</h4>

    @if ($posts->isEmpty())
        <p class="text-muted">Belum ada postingan dari pengguna ini.</p>
    @else
        <div class="row g-3">
            @foreach ($posts as $post)
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <p class="card-text">{{ $post->caption }}</p>
                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
