@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column p-3 mb-2">
            <h3 class="d-flex justify-content-center">ВЫБЕРИ СВОЮ ПЛАТФОРМУ!</h3>
            <div class="d-flex justify-content-center">
                @foreach($categories as $category)
                    <a href="/platform/{{$category->name}}">
                        <img
                            src="{{$category->picture}}"
                            class="img-fluid m-1"
                            width="200"></a>
                @endforeach
            </div>
            <h5 class="d-flex justify-content-center m-2">САМЫЕ ПОПУЛЯРНЫЕ</h5>
            <div class="d-flex row justify-content-center">
                @foreach($products as $product)
                    @if(!$product->quantity == 0)

                        <div class="card col-md-3">
                            <a href="/product/{{$product->id}}">
                                <img class="card-img-top mt-3" src="{{$product->picture}}" alt="Card image cap">
                                @foreach($metascore as $meta)
                                    @if($meta->product_id == $product->id)
                                        <div class="d-flex justify-content-end card-img-overlay">
                                            <h4 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded"
                                                style="background-color: #2fa360;  width: 40px; height: 40px;">
                                                {{$meta->meta_score}}
                                            </h4>
                                        </div>
                                    @endif
                                @endforeach
                            </a>
                            <div class="card-body d-flex flex-column justify-content-end">
                                <a href="/product/{{$product->id}}">
                                    <h5 class="card-title text-dark text-center">{{$product->name}}</h5>
                                </a>
                                <h5 class="card-text text-center text-danger">{{$product->price}} р.</h5>
                                <form class="card m-1 "
                                      action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-block btn-success" type="submit"
                                           value="Добавить в корзину">
                                </form>
                                <form class="card m-1"
                                      action="{{route('addToFavorite')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn text-white btn-block btn-primary" type="submit"
                                           value="Добавить в избранное">
                                </form>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        </div>

@endsection
