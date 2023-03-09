<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rehum extends Model
{
    use HasFactory;

    protected $fillable = [
        'hum_id',
        'reply_id',
        'name',
        'username'
    ];
}
