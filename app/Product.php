<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'product_genres', 'product_id', 'genre_id');
    }

    public function metascore()
    {
        return $this->hasOne(Metascore::class);
    }

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public static function getPopularProducts()
    {
        return Product::with('metascore')
            ->where('quantity', '>', '0')
            ->orderBy('count', 'DESC')
            ->take(6)
            ->get();
    }

    public static function getNewestProducts()
    {
        return Product::with('metascore')
            ->where('quantity', '>', '0')
            ->orderBy('date', 'DESC')
            ->take(3)
            ->get();
    }
}
