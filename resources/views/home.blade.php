@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-center m-2">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 700px">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://i.ibb.co/p17PJN2/doki.png" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"
                                 src="https://media.gamestop.com/i/gamestop/11202406_ALT02/It-Takes-Two---Xbox-One"
                                 alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"
                                 src="https://i2.wp.com/www.reimarufiles.com/wp-content/uploads/2021/06/Hades_Preorder.jpg?fit=1920%2C1080&ssl=1"
                                 alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <h4 class="d-flex justify-content-center m-2">УЖЕ В ПРОДАЖЕ!</h4>
            <div class="d-flex row justify-content-center mb-2">
                @foreach($newest as $new)
                    <div class="card shadow bg-white rounded m-1" style="width: 270px">
                        <a href="{{ route('product.show', ['id' => $new->product_id]) }}">
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
                                @elseif($new->meta_score > 0)
                                    <h4 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded"
                                        style="background-color: #d0211c;  width: 40px; height: 40px;">
                                        {{$new->meta_score}}
                                    </h4>
                                @endif
                            </div>
                        </a>
                        <div class="card-body d-flex flex-column justify-content-center">
                            <a href="{{ route('product.show', ['id' => $new->product_id]) }}">
                                <h4 class="card-title text-dark text-center">{{$new->name}}</h4>
                            </a>
                            <h4 class="card-text text-center text-danger">{{$new->price}} р.</h4>
                        </div>
                    </div>
                @endforeach
            </div>
            <h4 class="d-flex justify-content-center m-2">САМЫЕ ПОПУЛЯРНЫЕ</h4>
            <div class="d-flex row justify-content-center">
                @foreach($popular as $product)
                        <div class="card shadow m-1 bg-white rounded" style="width: 180px">
                            <a href="{{ route('product.show', ['id' => $product->product_id]) }}">
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
                                <a href="/product/{{$product->product_id}}">
                                    <div class="d-flex align-items-center justify-content-center text-dark text-center"
                                         style="height: 3rem">{{$product->name}}</div>
                                </a>
                                <h5 class="text-center text-danger">{{$product->price}} р.</h5>
                                <form class="card"
                                      action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->product_id}}"
                                           type="hidden">
                                    <input class="btn btn-block btn-sm btn-outline-dark shadow-sm" type="submit"
                                           value="В корзину">
                                </form>
                                <form class="card"
                                      action="{{route('addToFavorite')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->product_id}}"
                                           type="hidden">
                                    <input id="notificationButton" class="btn btn-block btn-sm btn-light shadow-sm"
                                           type="submit"
                                           value="В избранное">
                                </form>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $('.carousel').carousel({
                interval: 500
            })
        </script>

@endsection
