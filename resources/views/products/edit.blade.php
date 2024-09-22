@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Edit Product</h2>

                <!-- Флеш-сообщение об успехе -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <!-- Ошибки валидации -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Форма редактирования -->
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Поле для имени продукта -->
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" id="name" placeholder="Enter product name">
                    </div>

                    <!-- Поле для описания продукта -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Поле для цены продукта -->
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control" id="price" placeholder="Enter price">
                    </div>

                    <!-- Поле для количества продукта -->
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control" id="quantity" placeholder="Enter quantity">
                    </div>

                    <div class="form-group">
                        <label for="date">Выберите дату выхода:</label>
                        <input type="date" class="form-control" name="date" id="date" required="required" placeholder="Выберите дату">
                    </div>

                    <!-- Кнопка для сохранения изменений -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
