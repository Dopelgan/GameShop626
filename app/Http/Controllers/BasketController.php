<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    public function basket()
    {
        $products = Product::join('baskets', 'products.id', '=', 'baskets.product_id')
            ->where('user_id', Auth::user()->id)
            ->select('baskets.quantity as bt_quantity', 'products.*')
            ->get();

        $total = $products->sum(function($product) {
            return $product->bt_quantity * $product->price;
        });

        return view('basket', [
            'products' => $products,
            'total' => $total,
        ]);
    }

    public function addToBasket(Request $request)
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

        return back();
    }

    public function removeFromBasket(Request $request)
    {
        $basket = Basket::where('product_id', $request->product_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($basket) {
            $basket->decrement('quantity', 1);

            // Проверяем, если количество стало равным нулю, удаляем запись
            if ($basket->quantity == 0) {
                $basket->delete();
            }
        }

        return back();
    }


    public function clearBasket()
    {
        Basket::where('user_id', Auth::user()->id)->delete();

        return redirect('basket');
    }

}
