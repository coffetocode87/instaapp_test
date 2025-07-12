@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-warning fw-bold">✏️ Edit Postingan</div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/posts/' . $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" name="caption" class="form-control" value="{{ old('caption', $post->caption) }}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar (kosongkan jika tidak ingin mengganti)</label>
                    <input type="file" name="image" class="form-control">
                    @if($post->image)
                        <img src="{{ asset('images/' . $post->image) }}" class="img-fluid mt-2 rounded" style="max-height: 200px;">
                    @endif
                </div>

                <button type="submit" class="btn btn-warning w-100">💾 Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
