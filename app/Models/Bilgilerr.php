<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bilgilerr extends Model
{
    use HasFactory;
    protected $table="Bilgilerr";
    protected $fillable=["metin"];
}
