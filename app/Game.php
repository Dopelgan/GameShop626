<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genres','game_name','genre_name');
    }

    public function users_from_basket()
    {
        return $this->belongsToMany(User::class, 'baskets','game_name','user_name');
    }
}
