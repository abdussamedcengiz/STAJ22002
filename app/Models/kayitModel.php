<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kayitModel extends Model
{
    use HasFactory;
    protected $table="kayitt";
    protected $fillable=["username","email","password","repassword"];
}
