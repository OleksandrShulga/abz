<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'use',
    ];

    protected $dates = [
        'created_at',
        'updated_at',

    ];
}
