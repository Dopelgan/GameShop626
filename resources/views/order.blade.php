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
        <h1 class="mb-4 text-center" >Создание заказа</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <h3>Данные для оформления заказа</h3>
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
            </div>
            <div class="card shadow rounded">
                <h3 class="card-header text-right">Состав заказа:</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="align-middle">Наименование</th>
                        <th class="text-center align-middle">Количество</th>
                        <th class="text-center align-middle">Цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="align-middle">
                                <a href="{{ route('product.show', ['id' => $product->product->id]) }}">
                                    <img src='{{$product->product->picture}}' class="img-fluid shadow rounded"
                                         width="80">
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('package', ['id' => $product->product->id]) }}">{{$product->product->name}}</a>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-3">{{$product->quantity}}</h6>
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <h6>{{ $product->product->price*$product->quantity }} р.</h6>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h3 class="card-footer text-right">Итого: {{$total}}</h3>
            </div>
        </div>
    </div>

    </body>
    </html>

@endsection
