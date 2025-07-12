@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3 fw-bold">👤 Diikuti oleh {{ $user->name }}</h4>

    @forelse($following as $followedUser)
        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('avatars/' . ($followedUser->avatar ?? 'default.png')) }}"
                 alt="avatar"
                 class="rounded-circle me-2"
                 style="width: 40px; height: 40px; object-fit: cover;">
            <a href="{{ route('profile.show', $followedUser->id) }}" class="text-decoration-none fw-semibold">
                {{ $followedUser->name }}
            </a>
        </div>
    @empty
        <p class="text-muted">{{ $user->name }} belum mengikuti siapa pun.</p>
    @endforelse
</div>
@endsection
