<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{

     use HasFactory;

    protected $fillable = [
        'user_id',
        'caption',
        'image',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function likes()
{
    return $this->hasMany(Like::class);
}

public function likedBy($userId)
{
    return $this->likes()->where('user_id', $userId)->exists();
}

public function comments()
{
    return $this->hasMany(Comment::class);
}


}
