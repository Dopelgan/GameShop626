<?php

namespace App\Http\Controllers;

use App\Category;
use App\Metascore;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show(Request $request)
    {
        $product = Product::with('genres', 'metascore')->find($request->id);
        $product->count++;
        $product->save();

        return view('product', [
            'product' => $product,
            'popular' => Product::getPopularProducts(),
        ]);

    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); // Получите все категории из базы данных
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer|min:0',
            'count' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'meta_score' => 'required|integer|min:0|max:100',
            'user_score' => 'required|integer|min:0|max:100',
        ]);

        // Создаем данные для продукта
        $data = $request->only(['name', 'description', 'price', 'date', 'quantity', 'count', 'category_id']);

        // Если изображение загружено
        if ($request->hasFile('image')) {
            // Сохранение файла в public/img/ps5/
            $image = $request->file('image');
            $imagePath = 'img/ps5/' . time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img/ps5'), $imagePath);

            // Добавляем путь к изображению в данные для создания
            $data['image'] = $imagePath;
        }

        // Создаем новый продукт в базе данных
        $product = Product::create($data);

        // Создаем запись в таблице metascores
        $metascoreData = $request->only(['meta_score', 'user_score']);
        $metascoreData['product_id'] = $product->id;
        Metascore::create($metascoreData);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all(); // Получите все категории из базы данных
        return view('products.edit', compact('product'), compact('categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Обновляем данные продукта
        $data = $request->only(['name', 'price', 'quantity']);

        // Если изображение загружено
        if ($request->hasFile('image')) {
            // Получаем файл
            $image = $request->file('image');

            // Создаем путь для сохранения
            $imagePath = 'img/ps5/' . time() . '_' . $image->getClientOriginalName();

            // Сохраняем файл в нужную директорию
            $image->move(public_path('img/ps5'), $imagePath);

            // Добавляем путь к изображению в данные для обновления
            $data['image'] = $imagePath;
        }

        // Обновляем продукт
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

}
