@extends('layouts.app')

@section('content')

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Создать заказ</title>
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-4">Создать заказ</h1>
                <!-- Форма для создания заказа -->
                <form action="{{ route('makePackage') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="last_name">Фамилия:</label>
                        <input type="text" id="last_name" name="last_name" class="form-control"
                               value="{{ auth()->user()->last_name ?: old('last_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="first_name">Имя:</label>
                        <input type="text" id="first_name" name="first_name" class="form-control"
                               value="{{ auth()->user()->first_name ?: old('first_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Отчество:</label>
                        <input type="text" id="middle_name" name="middle_name" class="form-control"
                               value="{{ auth()->user()->middle_name ?: old('middle_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес доставки:</label>
                        <input type="text" id="address" name="address" class="form-control"
                               value="{{ auth()->user()->address ?: old('address') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Номер телефона:</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control"
                               value="{{ auth()->user()->phone_number ?: old('phone_number') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать заказ</button>
                </form>
                <h3 class="mt-4">Ваша корзина</h3>
                @if($products->count()>0)
                    @foreach($products as $product)
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="w-50">
                                <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                    <img src='{{$product->picture}}'
                                         class="img-fluid m-1"
                                         width="80"></a>
                                <a class="text-black-50"
                                   href="/product/{{$product->id}}">{{$product->name}}</a>
                            </div>
                            @if($product->quantity > 0)
                                <form class="d-flex flex-row align-items-center"
                                      action="{{route('addToBasket')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input class="btn btn-success m-1" value="Добавить" type="submit">
                                </form>
                                <div>{{$product->bt_quantity}}</div>
                                <form class="d-flex flex-row align-items-center"
                                      action="{{route('removeFromBasket')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input class="btn btn-danger m-1" value="Удалить" type="submit">
                                </form>
                                <div>{{$product->price*$product->bt_quantity}} р.</div>
                            @else
                                <div> Временно нет в наличии.</div>
                                <form class="d-flex flex-row align-items-center"
                                      action="{{route('removeFromBasket')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input class="btn btn-danger m-1" value="Удалить" type="submit">
                                </form>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    </body>
    </html>

@endsection
