<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function api_list(Request $request): JsonResponse
    {
        // Получаем все категории
        $category = Category::query()
            ->orderBy('id', 'asc')
            ->get(); // Получаем все данные

        // Возвращаем JSON-ответ
        return response()->json([
            'category' => $category,
        ]);
    }

    public function create(Request $request)
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

    public function api_create(Request $request) : JsonResponse
    {

        $data = $request->validate([
            'name' => ['unique:categories,name','required', 'string', 'max:255']
        ], [
            'name.max' => 'Название слишком длинное',
            'name.unique' => 'Такая категория уже добавлена.'
        ]);

        $category = Category::create([
            'name' => $data['name']
        ]);

        return response()->json([
            'category' => $category,
        ]);

    }
}
