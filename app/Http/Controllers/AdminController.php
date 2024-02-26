<?php

namespace App\Http\Controllers;

use App\ProductGenre;
use App\Genre;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function adminPanel()
    {
        return view('adminPanel', [
            'products' => Product::get(),
            'genres' => Genre::get(),
            'categories' => Category::get()
        ]);
    }

    public function addProductToCatalog(Request $request)
    {
        $messages = [
            'product_name.unique' => 'Такая игра уже в каталоге.',
            'quantity.numeric' => 'В поле "Количество" вводимое значение должно быть числовым'
        ];

        $request->validate([
            'product_name' => 'max:255|unique:products,name',
            'quantity' => 'numeric|max:255',
        ], $messages);

        $product = Product::create(
            [
                'name' => $request->product_name,
                'year' => $request->year,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'picture' => $request->picture,
                'category_id' => $request->category,
            ]
        );

        foreach ($request->genres as $genre) {
            ProductGenre::firstOrCreate(
                [
                    'product_id' => $product->id, 'genre_id' => $genre
                ],
                [
                    'product_id' => $product->id, 'genre_id' => $genre
                ]
            );
        }

        return Redirect::route('adminPanel');
    }

    public function addGenreToCatalog(Request $request)
    {
        $messages = [
            'rus_genre_name.unique' => 'Такой жанр уже добавлен.',
            'eng_genre_name.unique' => 'Такой жанр уже добавлен.',
        ];

        $request->validate([
            'rus_genre_name' => 'max:255|unique:genres,rus_name',
            'eng_genre_name' => 'max:255|unique:genres,eng_name',
        ], $messages);

        Genre::create(
            [
                'rus_name' => $request->rus_genre_name,
                'eng_name' => $request->eng_genre_name,
            ]
        );

        return Redirect::route('adminPanel');
    }

    public function addCategoryToCatalog(Request $request)
    {
        $messages = [
            'category_name.unique' => 'Такая категория уже добавлена.',
        ];

        $request->validate([
            'category_name' => 'max:255|unique:categories,name',
        ], $messages);

        Category::create(
            [
                'name' => $request->category_name,
            ]
        );

        return Redirect::route('adminPanel');
    }

    public function linkProductGenre(Request $request)
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

        return Redirect::route('adminPanel');
    }

    public function change_game_amount(Request $request)
    {
        $game = DB::table('games')->where('name', $request->game_name)->get();
        $change = Game::find($game[0]->id);
        $change->amount = $request->new_amount;
        $change->save();

        return Redirect::route('test');
    }

    public function change_description(Request $request)
    {
        $game = DB::table('games')->where('name', $request->game_name)->get();
        $change = Game::find($game[0]->id);
        $change->description = $request->new_description;
        $change->save();

        return Redirect::route('test');
    }

    public function change_game_image(Request $request)
    {
        $game = DB::table('games')->where('name', $request->game_name)->get();
        $change = Game::find($game[0]->id);
        $change->image = $request->new_image;
        $change->save();

        return Redirect::route('test');
    }
}
