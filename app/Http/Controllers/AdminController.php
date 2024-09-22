<?php

namespace App\Http\Controllers;

use App\Metascore;
use App\ProductGenre;
use App\Genre;
use App\Category;
use App\Product;
use Carbon\Carbon;
use Hooshid\MetacriticScraper\Metacritic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Metacritic\API\MetacriticAPI;
use Illuminate\Support\Str;

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

//    public function autoAddProduct(Request $request)
//    {
//        $metacritic = new Metacritic();
//        $extract = $metacritic->extract(Str::after($request->url, 'https://www.metacritic.com'));
//        $result = $extract['result'];
//        $error = $extract['error'];
//
//        $product = Product::create(
//            [
//                'name' => $result['title'],
//                'year' => Str::before($result['release_year'], '-'),
//                'price' => $request->price,
//                'quantity' => $request->quantity,
//                'description' => $result['summary'],
//                'picture' => $result['thumbnail'],
//                'category_id' => $request->category,
//            ]
//        );
//
//        Metascore::create(
//            [
//                'product_id' => $product->id,
//                'meta_score' => $result['meta_score'],
//                'user_score' => $result['user_score']*10,
//            ]
//        );
//
//        $genre = Genre::firstOrCreate(
//            [
//                'eng_name' => $result['genres']
//            ],
//            [
//                'eng_name' => $result['genres']
//            ]
//        );
//
//        ProductGenre::firstOrCreate(
//            [
//                'product_id' => $product->id, 'genre_id' => $genre->id
//            ],
//            [
//                'product_id' => $product->id, 'genre_id' => $genre->id
//            ]
//        );
//
//        return back();
//    }

    public function addProduct(Request $request)
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
                'date' => $request->dateInput,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'picture' => $request->picture,
                'category_id' => $request->category,
            ]
        );

        $metascore = Metascore::create(
            [
                'meta_score' => $request->metascore,
                'user_score' => $request->userscore,
                'product_id' => $product->id,
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

        return back();
    }

    public function addGenre(Request $request)
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

        return back();
    }

    public function addCategory(Request $request)
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

        return back();
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

        return back();
    }

    public function changeQuantity(Request $request)
    {
        Product::where('id', $request->product_id)->update(['quantity' => $request->quantity]);

        return back();
    }

    public function changeDescription(Request $request)
    {
        Product::where('id', $request->product_id)->update(['description' => $request->description]);

        return back();
    }

    public function changePicture(Request $request)
    {
        Product::where('id', $request->product_id)->update(['picture' => $request->picture]);

        return back();
    }
}
