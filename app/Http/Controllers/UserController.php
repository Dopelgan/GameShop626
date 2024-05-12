<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Genre;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile()
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Получаем все заказы пользователя
        $packages = Package::where('user_id', $user->id)
            ->where('parent_id', null)
            ->where('current_status', '<>', 'removed')
            ->get();

        // Возвращаем представление с заказами пользователя
        return view('profile', [
            'user' => $user,
            'packages' => $packages]);
    }

    public function updateProfile(Request $request)
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

        // Перенаправляем пользователя на страницу профиля с сообщением об успешном обновлении
        return redirect()->route('user.profile')->with('success', 'Профиль успешно обновлен');
    }
}
