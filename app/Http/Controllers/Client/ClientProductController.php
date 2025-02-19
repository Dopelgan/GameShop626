<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Product;
use App\Services\LogService;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{

    public function show(Request $request)
    {
        $product = Product::with('genres', 'metascore')->find($request->id);
        $product->count++;
        // Записать информационный лог
        LogService::write('info', 'Просмотрен продукт', ['user_id' => auth()->user(), 'product_id' => $product->id]);
        $product->save();

        return view('product', [
            'product' => $product,
            'popular' => Product::getPopularProducts(),
        ]);

    }

}
