<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ['level', 'message', 'context'];

    protected $casts = [
        'context' => 'array',
    ];
}
