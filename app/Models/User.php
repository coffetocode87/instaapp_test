<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
    'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
{
    return $this->hasMany(Post::class);
}

// User yang mengikuti user ini (pengikut)
public function followers()
{
    return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
}

// User yang diikuti oleh user ini (yang dia follow)
public function following()
{
    return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
}

public function isFollowedBy($userId)
{
    return $this->followers()->where('users.id', $userId)->exists();
}





}
