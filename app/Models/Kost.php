<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_kost',
        'slug',
        'tipe',
        'harga_per_bulan',
        'deskripsi',
        'alamat_lengkap',
        'kota',
        'provinsi',
        'status_verifikasi',
    ];

    // Relasi ke Pemilik
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Fasilitas (Many-to-Many)
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'kost_facility');
    }

    // Relasi ke Foto
    public function images()
    {
        return $this->hasMany(KostImage::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'kost_id', 'user_id')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Scope untuk filter pencarian
    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('nama_kost', 'like', '%' . $search . '%')
                ->orWhere('alamat_lengkap', 'like', '%' . $search . '%');
        });

        $query->when($filters['tipe'] ?? false, function ($query, $tipe) {
            $query->where('tipe', $tipe);
        });

        $query->when($filters['min_price'] ?? false, function ($query, $price) {
            $query->where('harga_per_bulan', '>=', $price);
        });

        $query->when($filters['max_price'] ?? false, function ($query, $price) {
            $query->where('harga_per_bulan', '<=', $price);
        });

        // Filter by Facility (Advanced)
        $query->when($filters['facilities'] ?? false, function ($query, $facilityIds) {
            $query->whereHas('facilities', function ($q) use ($facilityIds) {
                $q->whereIn('facilities.id', $facilityIds);
            });
        });
    }
}
