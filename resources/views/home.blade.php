@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-center m-2">
                <div id="carouselExampleIndicators" class="carousel slide shadow" data-ride="carousel" style="width: 700px">
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
                        <div class="card shadow bg-white rounded">
                            <a href="{{ route('product.show', ['id' => $new->id]) }}">
                                <img class="card-img-top rounded" src="{{asset($new->image)}}" alt="Card image cap">
                                <div class="card-img-overlay">
                                    <div class="d-flex justify-content-end card-img-overlay">
                                        <h4 class="d-flex justify-content-center align-items-center text-dark font-weight-bold rounded
                                    @if ($new->metascore->meta_score >= 75)
                                        bg-success
                                    @elseif($new->metascore->meta_score > 50)
                                        bg-warning
                                    @else
                                        bg-danger
                                    @endif
                                        " style="width: 40px; height: 40px;">
                                            {{$new->metascore->meta_score}}
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <a class="card-title text-dark text-center"
                               href="{{ route('product.show', ['id' => $new->id]) }}">
                                <h4>{{$new->name}}</h4>
                            </a>

                            <form action="{{route('addToBasket')}}" method="POST">
                                @csrf
                                <input id="product_id" name="product_id" value="{{$new->id}}"
                                       type="hidden">
                                <h3 class="card-text text-center text-danger">{{$new->price}} р.</h3>
                                <input class="btn btn-block btn-outline-dark shadow-sm"
                                       type="submit"
                                       value="В корзину">
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
            <h4 class="d-flex justify-content-center m-2">САМЫЕ ПОПУЛЯРНЫЕ</h4>
            <div class="d-flex row justify-content-between">
                @foreach($popular as $product)
                    <div class="card shadow bg-white rounded m-1" style="width: 180px">
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
                                <form action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}"
                                           type="hidden">
                                    <h5 class="card-text text-center text-danger">{{$product->price}} р.</h5>
                                    <input class="btn btn-block btn-outline-dark btn-sm shadow-sm"
                                           type="submit"
                                           value="В корзину">
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('.carousel').carousel({
            interval: 500
        })
    </script>

@endsection
