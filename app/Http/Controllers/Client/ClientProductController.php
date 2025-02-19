<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Product;
use App\Services\LogService;
use Illuminate\Http\JsonResponse;
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

    public function get($id) : JsonResponse
    {
        $product = Product::with('genres', 'metascore')->find('id', $id);

        return response()->json([
            'product' => $product
        ]);
    }

    public function list() : JsonResponse
    {
        $product = Product::with('genres', 'metascore')->get();

        return response()->json([
            'product' => $product
        ]);
    }

    public function new() : JsonResponse
    {
        $new = Product::with('genres', 'metascore')
            ->orderBy('date', 'desc')
            ->limit(8)
            ->get();

        return response()->json([
            'new' => $new
        ]);
    }

    public function popular() : JsonResponse
    {
        $popular = Product::with('genres', 'metascore')
            ->orderBy('count', 'desc')
            ->limit(8)
            ->get();

        return response()->json([
            'popular' => $popular
        ]);
    }

    public function featured() : JsonResponse
    {
        $featured = Product::with('genres', 'metascore')
            ->orderBy('quantity', 'desc')
            ->limit(8)
            ->get();

        return response()->json([
            'featured' => $featured
        ]);
    }

}
