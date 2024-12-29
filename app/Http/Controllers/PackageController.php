<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Package;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use App\Services\LogService;

class PackageController extends Controller
{

    public function package(Request $request)
    {
        $parentPackage = Package::find($request->id);

        $childPackages = Package::with('product')
            ->where('parent_id', $request->id)
            ->get();

        return view('package', [
            'parentPackage' => $parentPackage,
            'childPackages' => $childPackages,
        ]);
    }

    public function order(Request $request)
    {
        $products = Basket::with('product')
            ->where('user_id', Auth::user()->id)
            ->get();

        $total = $products->sum(function($product) {
            return $product->quantity * $product->product->price;
        });

        return view('order', [
            'products' => $products,
            'total' => $total,
        ]);
    }

    public function makePackage(Request $request)
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Проверяем, имеет ли пользователь доступ к редактированию этого профиля
        if ($request->user()->id !== $user->id) {
            abort(403);
        }

        // Валидируем данные
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
        ]);

        // Обновляем данные пользователя
        $user->update($validatedData);

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

        // Записать информационный лог
        LogService::write('info', 'Создан заказ', ['user_id' => $user->id, 'package_id' => $parentPackage->id]);

        // Возвращаем ответ с сообщением об успешном создании заказа
        return redirect('basket')->with('success', 'Заказ успешно создан!');
    }

    public function remove(Request $request)
    {
        $packages = Package::where('parent_id', $request->package_id)
            ->orWhere('id', $request->package_id)
            ->get();

        foreach ($packages as $package) {
            if ($package->current_status = 'new')
            $package->update([
                'current_status' => 'removed',
                'removed_at' => now()
            ]);

        }

        // Возвращаем ответ с сообщением об успешном создании заказа
        return redirect()->back()->with('success', 'Заказ успешно отменен!');

    }

}
