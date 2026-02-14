<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'penulis',
        'penerbit',
        'kategori',
        'alasan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
