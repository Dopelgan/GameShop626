<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function metascores()
    {
        return $this->hasMany(Metascore::class);
    }

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
}
