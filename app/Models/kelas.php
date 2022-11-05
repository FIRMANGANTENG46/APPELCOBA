<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kls'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'users_id', 'id');
    }
}
