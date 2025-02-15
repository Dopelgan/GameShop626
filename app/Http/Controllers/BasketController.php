<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    public function index()
    {
        $products = Basket::whereHas('product', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();

        $total = $products->sum(function($product) {
            return $product->quantity * $product->product->price;
        });

        return view('basket', [
            'products' => $products,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $basket = Basket::where('product_id', $request->product_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($basket) {
            $basket->increment('quantity', 1);
        } else {
            Basket::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::user()->id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину.');
    }

    public function destroy($id)
    {
        $basket = Basket::where('product_id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($basket) {
            $basket->decrement('quantity', 1);

            // Проверяем, если количество стало равным нулю, удаляем запись
            if ($basket->quantity == 0) {
                $basket->delete();
            }
        }

        return redirect()->back()->with('success', 'Товар удален из корзины.');
    }


    public function clear()
    {
        Basket::where('user_id', Auth::user()->id)->delete();

        return redirect()->back()->with('success', 'Корзина очищена.');
    }

}
