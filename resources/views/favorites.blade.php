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
        <h3 class="text-center">Избранное</h3>
        @if($products->count()>0)
            <div class="d-flex row">
                @foreach($products as $product)
                    <div class="card shadow bg-white rounded m-1" style="width: 180px;">
                        <div class="card shadow bg-white rounded">
                            <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                <img class="card-img-top rounded" src="{{asset($product->image)}}" alt="Card image cap">
                                <div class="card-img-overlay">
                                    <div class="d-flex justify-content-end card-img-overlay">
                                        <h6 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded
                                    @if ($product->metascore->meta_score >= 75)
                                        bg-success
                                    @elseif($product->metascore->meta_score > 50)
                                        bg-warning
                                    @else
                                        bg-danger
                                    @endif
                                        " style="width: 30px; height: 30px;">
                                            {{$product->metascore->meta_score}}
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <a class="card-title text-dark text-center"
                               href="{{ route('product.show', ['id' => $product->id]) }}">
                                <h6>{{$product->name}}</h6>
                            </a>
                            <div>
                                @if(!$product->quantity == 0)
                                    <form class="mb-1" action="{{route('addToBasket')}}" method="POST">
                                        @csrf
                                        <input id="product_id" name="product_id" value="{{$product->id}}"
                                               type="hidden">
                                        <h5 class="card-text text-center text-danger">{{$product->price}} р.</h5>
                                        <input class="btn btn-block btn-outline-dark btn-sm shadow-sm"
                                               type="submit"
                                               value="В корзину">
                                    </form>
                                @else
                                    <h6 class="text-center">Нет в наличии</h6>
                                @endif
                                <form action="{{route('deleteFromFavorite')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-sm btn-block btn-outline-danger shadow-sm"
                                           type="submit"
                                           value="Удалить">
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h6 class="text-center">Пока что здесь пусто</h6>
    @endif

@endsection
