<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JudulHalaman extends Model
{
    protected $table = 'judul_halaman';
    protected $fillable = ['judul', 'deskripsi', 'is_active', 'images'];
}
