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
            <h3 class="font-weight-bold text-center">Избранное</h3>
            <form action="{{route('clearFavorites')}}" method="POST">
                @csrf
                <button id="clear_favorites" class="btn btn-secondary" type="submit">Очистить
                    избранное
                </button>
            </form>
        @else
            <div class="d-flex justify-content-center">
                <h3 class="font-weight-bold">Избранное</h3>
            </div>
            <div class="d-flex justify-content-center">
                <h6>Пока что здесь пусто</h6>
            </div>
        @endif

        <div class="d-flex row">
            @foreach($products as $product)
                @if(!$product->quantity == 0)
                    <div class="card shadow m-1 bg-white rounded" style="width: 180px">
                        <a href="{{ route('product.show', ['id' => $product->id]) }}">
                            <img class="card-img-top rounded bg" src="{{$product->picture}}" alt="Card image cap">
                        </a>
                        <div class="d-flex flex-column justify-content-center p-2">
                            <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                <div class="d-flex align-items-center justify-content-center text-dark text-center"
                                     style="height: 3rem">{{$product->name}}</div>
                            </a>
                            <h5 class="text-center text-danger">{{$product->price}} р.</h5>
                            @if(!$product->quantity == 0)
                                <form class="card m-1 "
                                      action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-sm btn-block btn-outline-dark" type="submit"
                                           value="В корзину">
                                </form>
                            @else
                                <h5>Нет в наличии</h5>
                            @endif
                            <form class="card m-1"
                                  action="{{route('deleteFavorite')}}" method="POST">
                                @csrf
                                <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                <input class="btn btn-sm btn-block btn-light" type="submit"
                                       value="Удалить">
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

@endsection
