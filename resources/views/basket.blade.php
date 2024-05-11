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
        @if($products->count()>0)
            <div class="d-flex justify-content-center">
                <h5>Ваша корзина</h5>
            </div>
        @else
            <div class="d-flex justify-content-center">
                <h5>Корзина пуста</h5>
            </div>
        @endif
        <div class="row">
            <div class="d-flex w-75 flex-column">
                @foreach($products as $product)
                            <div class="d-flex justify-content-between align-items-center mt-2">
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
            </div>
            @if($products->count()>0)
            <div class="d-flex w-20 flex-column align-items-end ml-5">
                <h5>Итого:</h5>
                <h3>{{$total}} р.</h3>
                <form action="{{ route('createOrder') }}" method="POST">
                    @csrf
                    <button class="btn btn-block btn-outline-success" type="submit">Оформить заказ</button>
                </form>
                <form action="{{route('clearBasket')}}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger mt-2" type="submit">Очистить корзину</button>
                </form>
            </div>
            @endif
        </div>

@endsection
