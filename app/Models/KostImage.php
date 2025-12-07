<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KostImage extends Model
{
    use HasFactory;

    protected $fillable = ['kost_id', 'path_foto', 'is_primary'];

    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }
}
