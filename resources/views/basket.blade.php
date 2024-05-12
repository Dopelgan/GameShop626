@extends('layouts.app')

@section('content')

    <div class="container">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($products->isEmpty())
            <div class="m-2">
                <h3 class="text-center">Ваша корзина пуста</h3>
            </div>

        @else
            <div class="d-flex flex-row">
                <div class="card w-75">
                    <h1 class="m-3">Ваша корзина</h1>
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
                                        <form class="d-flex flex-row align-items-center"
                                              action="{{route('removeFromBasket')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->product->id}}">
                                            <input class="btn btn-block btn-sm btn-outline-danger shadow-sm" value="-" type="submit">
                                        </form>
                                        <h6 class="m-3">{{$product->quantity}}</h6>
                                        <form class="d-flex flex-row align-items-center"
                                              action="{{route('addToBasket')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->product->id}}">
                                            <input class="btn btn-block btn-sm btn-outline-dark shadow-sm" value="+" type="submit">
                                        </form>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <h4>{{ $product->product->price*$product->quantity }} р.</h4>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="w-25">
                    <div class=" d-flex flex-column align-items-end ">
                        <h1 class="m-3">Итого:</h1>
                        <h3 class="mr-3">{{$total}} р.</h3>
                        <form class="mr-3" action="{{ route('order') }}" method="POST">
                            @csrf
                            <button class="btn btn-block btn-outline-dark shadow" type="submit">Оформить заказ</button>
                        </form>
                        <form class="mr-3 mb-3" action="{{route('clearBasket')}}" method="POST">
                            @csrf
                            <button class="btn btn-block btn-outline-danger shadow mt-2" type="submit">Очистить корзину</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
