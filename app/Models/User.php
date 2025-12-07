<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi: User (Pemilik) punya banyak Kost
    public function kosts()
    {
        return $this->hasMany(Kost::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Kost::class, 'favorites', 'user_id', 'kost_id')->withTimestamps();
    }

    // Helper untuk cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isPemilik()
    {
        return $this->role === 'pemilik';
    }
    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }
}
