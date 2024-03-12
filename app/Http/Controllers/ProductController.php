<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Category;
use App\Game;
use App\GameGenre;
use App\GamePlatform;
use App\Genre;
use App\Platform;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends UserController
{
    public function filter(Request $request)
    {
        return view('filter');
    }
}
