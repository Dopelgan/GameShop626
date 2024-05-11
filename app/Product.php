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

    public static function getPopularProducts()
    {
        return Product::leftJoin('metascores', 'products.id', '=', 'metascores.product_id')
            ->orderBy('count', 'DESC')
            ->take(5)
            ->get();
    }

    public static function getNewestProducts()
    {
        return Product::leftJoin('metascores', 'products.id', '=', 'metascores.product_id')
            ->orderBy('year', 'DESC')
            ->take(3)
            ->get();
    }
}
