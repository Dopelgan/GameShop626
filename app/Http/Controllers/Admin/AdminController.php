<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Metascore;
use App\Product;
use App\ProductGenre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('adminPanel', [
            'products' => Product::get(),
            'genres' => Genre::get(),
            'categories' => Category::get()
        ]);
    }

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

        $product = Product::create([
                'name' => $request->product_name,
                'date' => $request->dateInput,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'image' => $request->image,
                'category_id' => $request->category,
            ]);

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
