@extends('layouts.app')

@section('content')
<div class="container">

    <!-- FORM POST -->
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">📝 Buat Postingan</div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ url('/posts') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" class="form-control" name="caption" id="caption" placeholder="Tulis caption...">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="image" id="image" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">🚀 Posting</button>
            </form>
        </div>
    </div>
    


    <!-- FEED -->
    <h3 class="mb-4 fw-bold">🖼️ Postingan Terbaru</h3>

    @forelse($posts as $post)
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <!-- <strong> <a href="{{ route('profile.show', $post->user->id) }}" class="fw-bold text-decoration-none">
</strong> ·  -->

<div class="d-flex align-items-center">
    @if($post->user->avatar)
        <img src="{{ asset('avatars/' . $post->user->avatar) }}" class="rounded-circle me-2" style="height: 32px; width: 32px; object-fit: cover;">
    @endif
    <a href="{{ route('profile.show', $post->user->id) }}" class="fw-bold text-decoration-none">
        {{ $post->user->name }}
    </a>
</div>

                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </div>
                @if ($post->user_id === Auth::id())
                    <div class="d-flex gap-2">
                        <a href="{{ url('/posts/' . $post->id . '/edit') }}" class="btn btn-sm btn-outline-secondary">✏️ Edit</a>
                        <form action="{{ url('/posts/' . $post->id) }}" method="POST" onsubmit="return confirm('Hapus posting ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">🗑️ Hapus</button>
                        </form>
                    </div>
                @endif
            </div>

            @if($post->image)
                <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" style="max-height:500px; object-fit:cover;">
            @endif

            <div class="card-body">
                <p class="card-text">{{ $post->caption }}</p>

                <!-- LIKE FORM -->
                <form action="{{ url('/posts/' . $post->id . '/like') }}" method="POST" class="d-inline">
                    @csrf
                    @if ($post->likedBy(Auth::id()))
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">❤️ Unlike</button>
                    @else
                        <button type="submit" class="btn btn-sm btn-outline-danger">🤍 Like</button>
                    @endif
                </form>
                <span class="ms-2 text-muted">{{ $post->likes->count() }} suka</span>

                <hr>

                <!-- KOMENTAR LIST -->
                <div class="mb-2">
                    <strong>Komentar:</strong>
                    @forelse($post->comments as $comment)
                        <div>
                            <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                        </div>
                    @empty
                        <div class="text-muted">Belum ada komentar.</div>
                    @endforelse
                </div>

                <!-- FORM KOMENTAR -->
                <form action="{{ url('/posts/' . $post->id . '/comments') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="comment" class="form-control" placeholder="Tulis komentar...">
                        <button class="btn btn-outline-primary" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
       
    @empty
        <p class="text-center text-muted">Belum ada postingan.</p>
    @endforelse

</div>
@endsection
