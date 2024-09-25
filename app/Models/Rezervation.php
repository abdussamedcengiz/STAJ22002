<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table="rezervations";
    protected $fillable = ['seats', 'movie_price'];

    protected $casts = [
        'seats' => 'array',
    ];
}
