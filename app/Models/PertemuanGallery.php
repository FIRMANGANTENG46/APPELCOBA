<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PertemuanGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pertemuans_id', 'url', 'is_featured'
    ];


    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
