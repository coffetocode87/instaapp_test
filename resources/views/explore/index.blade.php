@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">🔍 Jelajahi Postingan</h3>

    @if($posts->isEmpty())
        <p class="text-muted">Belum ada postingan.</p>
    @else
        <div class="row g-3">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        @if($post->image)
                            <a href="{{ route('profile.show', $post->user->id) }}">
                                <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                            </a>
                        @endif
                        <div class="card-body">
                            <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none fw-bold">
                                {{ $post->user->name }}
                            </a>
                            <p class="card-text">{{ $post->caption }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
