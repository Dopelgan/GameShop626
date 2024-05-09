@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <h3 class="d-flex justify-content-center">ВЫБЕРИ СВОЮ ПЛАТФОРМУ!</h3>
            <div class="d-flex justify-content-center">
                <form style="width: 160px; height: 80px;"
                      class="card m-1 d-flex justify-content-center align-items-center shadow p-3 mb-2 bg-white rounded"
                      action="{{route('filter')}}"
                      method="POST">
                    @csrf
                    <input type="hidden" value="2" id="category_id" name="category_id">
                    <input class="mx-auto d-block img-fluid" type="image"
                           src="https://upload.wikimedia.org/wikipedia/commons/7/7e/PS4_logo.png">
                </form>
                <form style="width: 160px; height: 80px;"
                      class="card m-1 d-flex justify-content-center align-items-center shadow p-3 mb-2 bg-white rounded"
                      action="{{route('filter')}}" method="POST">
                    @csrf
                    <input type="hidden" value="1" id="category_id" name="category_id">
                    <input class="mx-auto d-block img-fluid" type="image"
                           src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/PlayStation_5_logo_and_wordmark.svg/1024px-PlayStation_5_logo_and_wordmark.svg.png">
                </form>
            </div>
            <h4 class="d-flex justify-content-center m-2">УЖЕ В ПРОДАЖЕ!</h4>
            <div class="d-flex row justify-content-center mb-2">
                @foreach($newest as $new)
                    @if(!$new->quantity == 0)

                        <div class="card shadow bg-white rounded m-1" style="max-width: 360px">
                            <a href="/product/{{$new->product_id}}">
                                <img class="card-img-top rounded bg" src="{{$new->picture}}" alt="Card image cap">
                                        <div class="d-flex justify-content-end card-img-overlay">
                                            @if ($new->meta_score >= 75)
                                                <h4 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded"
                                                    style="background-color: #2fa360;  width: 40px; height: 40px;">
                                                    {{$new->meta_score}}
                                                </h4>
                                            @elseif($new->meta_score > 50)
                                                <h4 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded"
                                                    style="background-color: #f6993f;  width: 40px; height: 40px;">
                                                    {{$new->meta_score}}
                                                </h4>
                                            @elseif($product->meta_score > 0)
                                                <h4 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded"
                                                    style="background-color: #d0211c;  width: 40px; height: 40px;">
                                                    {{$new->meta_score}}
                                                </h4>
                                            @endif
                                        </div>
                            </a>
                            <div class="card-body d-flex flex-column justify-content-center">
                                <a href="/product/{{$new->product_id}}">
                                    <h4 class="card-title text-dark text-center">{{$new->name}}</h4>
                                </a>
                                <h4 class="card-text text-center text-danger">{{$new->price}} р.</h4>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <h4 class="d-flex justify-content-center m-2">САМЫЕ ПОПУЛЯРНЫЕ</h4>
            <div class="d-flex row justify-content-center">
                @foreach($popular as $product)
                    @if(!$product->quantity == 0)
                        <div class="card shadow m-1 bg-white rounded" style="width: 220px">
                            <a href="/product/{{$product->product_id}}">
                                <img class="card-img-top rounded bg" src="{{$product->picture}}" alt="Card image cap">
                                        <div class="d-flex justify-content-end card-img-overlay">
                                            @if ($product->meta_score >= 75)
                                                <h6 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded"
                                                    style="background-color: #2fa360;  width: 30px; height: 30px;">
                                                    {{$product->meta_score}}
                                                </h6>
                                            @elseif($product->meta_score > 50)
                                                <h6 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded"
                                                    style="background-color: #f6993f;  width: 30px; height: 30px;">
                                                    {{$product->meta_score}}
                                                </h6>
                                            @elseif($product->meta_score > 0)
                                                <h6 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded"
                                                    style="background-color: #d0211c;  width: 30px; height: 30px;">
                                                    {{$product->meta_score}}
                                                </h6>
                                            @endif
                                        </div>
                            </a>
                            <div class="d-flex flex-column justify-content-center p-2">
                                <a href="/product/{{$product->id}}">
                                    <div class="d-flex align-items-center justify-content-center text-dark text-center" style="height: 3rem">{{$product->name}}</div>
                                </a>
                                <h5 class="text-center text-danger">{{$product->price}} р.</h5>
                                <form class="card"
                                      action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-block btn-sm btn-outline-dark shadow-sm" type="submit"
                                           value="В корзину">
                                </form>
                                <form class="card"
                                      action="{{route('addToFavorite')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-block btn-sm btn-light shadow-sm" type="submit"
                                           value="В избранное">
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

@endsection
