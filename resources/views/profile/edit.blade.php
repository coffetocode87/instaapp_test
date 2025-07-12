@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header fw-bold bg-info text-white">✏️ Edit Profil</div>
        <div class="card-body">
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Profil (avatar)</label>
                    <input type="file" name="avatar" class="form-control">
                    @if($user->avatar)
                        <img src="{{ asset('avatars/' . $user->avatar) }}" class="mt-2 rounded-circle" style="height: 100px;">
                    @endif
                </div>

                <button type="submit" class="btn btn-info w-100 text-white">💾 Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
