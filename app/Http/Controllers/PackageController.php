<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Package;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{

    public function createOrder(Request $request)
    {
        $products = Product::join('baskets', 'products.id', '=', 'baskets.product_id')
            ->where('user_id', Auth::user()->id)
            ->select('baskets.quantity as bt_quantity', 'products.*')
            ->get();

        return view('createOrder', ['products' => $products]);
    }

    public function makePackage(Request $request)
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Обновляем данные пользователя
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        // Создаем родительское отправление (multiplace)
        $parentPackage = Package::create([
            'user_id' => $user->id,
            'current_status' => 'new',
            'type' => 'multiplace',
            'quantity' => 0,
            'price' => 0,
        ]);

        // Общая стоимость и количество продуктов в заказе
        $totalPrice = 0;
        $totalQuantity = 0;

        // Создаем дочерние отправления (standard) для каждого продукта в корзине
        $basketItems = Basket::where('user_id', $user->id)->get();
        foreach ($basketItems as $basketItem) {
            // Загружаем объект продукта по его идентификатору из корзины
            $product = Product::find($basketItem->product_id);

            // Создаем дочернее отправление (standard)
            $childPackage = Package::create([
                'user_id' => $user->id,
                'current_status' => 'new',
                'type' => 'standard',
                'quantity' => $basketItem->quantity,
                'price' => $product->price * $basketItem->quantity,
                'parent_id' => $parentPackage->id,
                'product_id' => $product->id,
            ]);

            // Обновляем общую стоимость и количество продуктов в заказе
            $totalPrice += $childPackage->price;
            $totalQuantity += $childPackage->quantity;
        }

        // Обновляем родительское отправление с общей стоимостью и количеством продуктов
        $parentPackage->update([
            'quantity' => $totalQuantity,
            'price' => $totalPrice,
        ]);

        // Очищаем корзину пользователя
        Basket::where('user_id', $user->id)->delete();

        // Возвращаем ответ с сообщением об успешном создании заказа
        return redirect()->back()->with('success', 'Заказ успешно создан!');
    }


}
