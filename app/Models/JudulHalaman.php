<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JudulHalaman extends Model
{
    protected $table = 'judul_halaman';
    protected $fillable = ['judul', 'deskripsi', 'is_active', 'user_id', 'images'];

    /**
     * @return BelongsTo<User, JudulHalaman>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
