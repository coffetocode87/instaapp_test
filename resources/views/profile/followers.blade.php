@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3 fw-bold">👥 Pengikut {{ $user->name }}</h4>

    @forelse($followers as $follower)
        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('avatars/' . ($follower->avatar ?? 'default.png')) }}"
                 alt="avatar"
                 class="rounded-circle me-2"
                 style="width: 40px; height: 40px; object-fit: cover;">
            <a href="{{ route('profile.show', $follower->id) }}" class="text-decoration-none fw-semibold">
                {{ $follower->name }}
            </a>
        </div>
    @empty
        <p class="text-muted">Belum ada pengikut.</p>
    @endforelse
</div>
@endsection
