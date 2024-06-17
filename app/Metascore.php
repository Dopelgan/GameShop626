<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metascore extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
