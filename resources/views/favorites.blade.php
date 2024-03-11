@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
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
                    <h3 class="font-weight-bold">Избранное</h3>
                </div>
                @csrf
                <div class="d-flex justify-content-end">
                    <button id="clear_favorites" class="btn btn-secondary  m-2" type="submit">Очистить
                        избранное
                    </button>
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <h3 class="font-weight-bold">Избранное</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <h6>Пока что здесь пусто</h6>
                </div>
            @endif

            <div id="product_block" class="d-flex justify-content-center row">
                @foreach($products as $product)
                    <div class="card col-md-3" style="width: 16rem;">
                        <a href="/product/{{$product->id}}">
                            <img class="card-img-top mt-3" src="{{$product->picture}}" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <a href="/game_page/{{$product->name}}">
                                <h5 class="card-title text-center text-dark">{{$product->name}}</h5>
                            </a>
                            <h5 class="card-text text-center text-danger">{{$product->price}} р.</h5>
                            @if(!$product->quantity == 0)
                                <form class="card m-1 "
                                      action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-block btn-success" type="submit"
                                           value="Добавить в корзину">
                                </form>
                            @else
                                <h5>Нет в наличии</h5>
                            @endif
                            <form class="card m-1"
                                  action="{{route('delete_from_favorites')}}" method="POST">
                                @csrf
                                <input id="product" name="product" value="{{$product->id}}" type="hidden">
                                <input class="btn btn-secondary" type="submit"
                                       value="Удалить из избранного">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

@endsection
