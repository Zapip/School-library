<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori',
        'cover_image',
        'stok',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
