<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertemuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'price', 'materis_id', 'tags'
    ];

    public function galleries()
    {
        return $this->hasMany(PertemuanGallery::class, 'pertemuans_id', 'id');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materis_id', 'id');
    }
}
