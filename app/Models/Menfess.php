<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menfess extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'message',
        'status',
        'sender',
        'receiver',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reports()
    {
        return $this->hasMany(MenfessReport::class);
    }
}
