<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Http\Controllers\Controller;
use App\ProductGenre;
use Illuminate\Http\Request;

class AdminGenreController extends Controller
{
    public function create(Request $request)
    {
        $messages = [
            'name.unique' => 'Такой жанр уже добавлен.',
        ];

        $request->validate([
            'name' => 'max:255|unique:genres,name',
        ], $messages);

        Genre::create(
            [
                'name' => $request->name,
            ]
        );

        return back();
    }

    public function link_product(Request $request)
    {
        foreach ($request->genres_id as $genre_id) {
            ProductGenre::firstOrCreate(
                [
                    'product_id' => $request->product_id, 'genre_id' => $genre_id
                ],
                [
                    'product_id' => $request->product_id, 'genre_id' => $genre_id
                ]
            );
        }

        return back();
    }

}
