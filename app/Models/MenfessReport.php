<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenfessReport extends Model
{
    protected $fillable = [
        'menfess_id',
        'user_id',
        'reason',
    ];

    public function menfess()
    {
        return $this->belongsTo(Menfess::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
