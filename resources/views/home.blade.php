@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center w-75 container">
        <div class="d-flex flex-column p-3 mb-2 bg-dark text-white-50">
            <h3 class="d-flex justify-content-center text-white">ВЫБЕРИ СВОЮ ПЛАТФОРМУ!</h3>
            <div class="d-flex justify-content-center">
                @foreach($categories as $category)
                    <a href="/platform/{{$category->name}}">
                        <img
                            src="{{$category->picture}}"
                            class="img-fluid m-1"
                            width="200"></a>
                @endforeach
            </div>
            <h5 class="d-flex justify-content-center m-2 text-white">Игры в наличии:</h5>
            <div class="d-flex row justify-content-center">
                @foreach($products as $product)
                    @if(!$product->quantity == 0)

                        <div class="card text-white bg-dark m-1 border-secondary" style="width: 16rem;">
                            <a href="/product/{{$product->id}}">
                                <img class="card-img-top" src="{{$product->picture}}" alt="Card image cap">
                            </a>
                            <div class="card-body">
                                <a href="/product/{{$product->id}}">
                                    <h6 class="card-title text-white">{{$product->name}}</h6>
                                </a>
                                <p class="card-text">{{$product->price}} р.</p>
                                <form class="card text-white bg-dark m-1 border-secondary"
                                      action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input id="user_id" name="user_id" value="1" type="hidden">
                                    <input id="page" name="page" value="home" type="hidden">
                                    <input class="btn btn-outline-warning text-white" type="submit"
                                           value="Добавить в корзину">
                                </form>
                                <form class="card text-white bg-dark m-1 border-secondary"
                                      action="{{route('addToFavorite')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input id="user_id" name="user_id" value="1" type="hidden">
                                    <input id="page" name="page" value="home" type="hidden">
                                    <input class="btn btn-outline-success text-white" type="submit"
                                           value="Добавить в избранное">
                                </form>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
            <h5 class="d-flex justify-content-center m-2 text-white">Временно нет в наличии:</h5>
            <div class="d-flex row justify-content-center">
                @foreach($products as $product)
                    @if($product->quantity == 0)
                        <div class="card text-white bg-dark m-1 border-secondary" style="width: 16rem;">
                            <a href="/product/{{$product->name}}">
                                <img class="card-img-top" src="{{$product->image}}" alt="Card image cap">
                            </a>
                            <div class="card-body">
                                <a href="/product/{{$product->name}}">
                                    <h6 class="card-title text-white">{{$product->name}}</h6>
                                </a>
                                <p class="card-text">{{$product->price}} р.</p>
                                <form class="card text-white bg-dark m-1 border-secondary"
                                      action="{{route('addToFavorite')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input id="user_id" name="user_id" value="1" type="hidden">
                                    <input id="page" name="page" value="home" type="hidden">
                                    <input class="btn btn-outline-success text-white" type="submit"
                                           value="Добавить в избранное">

                                </form>
                            </div>
                        </div>

                    @endif
                @endforeach
            </div>
        </div>


@endsection
