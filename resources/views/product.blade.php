@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-around" style="min-height: 420px">
            <div class="d-flex justify-content-center">
                @if($product->image)
                    <div class="col-md-3">
                        @if($product->metascore)
                            <div class="d-flex flex-row justify-content-around align-items-center">
                                <h6 class="font-weight-bold">Metascore</h6>
                                @if($product->metascore->meta_score >= 75)
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded"
                                        style="background-color: #2fa360;  width: 30px; height: 30px;">{{ $product->metascore->meta_score }}</h6>
                                @elseif($product->metascore->meta_score >= 50)
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded"
                                        style="background-color: #f6993f;  width: 30px; height: 30px;">{{ $product->metascore->meta_score }}</h6>
                                @else()
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded"
                                        style="background-color: #d0211c;  width: 30px; height: 30px;">{{ $product->metascore->meta_score }}</h6>
                                @endif
                                <h6 class="font-weight-bold">User score</h6>
                                @if($product->metascore->user_score >= 75)
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded-circle"
                                        style="background-color: #2fa360;  width: 30px; height: 30px;">{{ $product->metascore->user_score }}</h6>
                                @elseif($product->metascore->user_score >= 50)
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded-circle"
                                        style="background-color: #f6993f;  width: 30px; height: 30px;">{{ $product->metascore->user_score }}</h6>
                                @else()
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded-circle"
                                        style="background-color: #d0211c;  width: 30px; height: 30px;">{{ $product->metascore->user_score }}</h6>
                                @endif
                            </div>
                        @endif
                        <img
                            src="{{ asset($product->image) }}"
                            class="img-fluid mr-5 rounded shadow bg-white p-2">
                        @endif
                        @if($product->image == null)
                            <form class="d-flex flex-column m-2" action="{{route('changeProductPicture')}}"
                                  method="POST">
                                @csrf
                                <b>Изменить изображение</b>
                                <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                <label for="picture">Вставьте ссылку на изображение</label>
                                <input class="form form-control" type="text" id="picture" name="picture" required>
                                <input class="btn btn-success mt-2" type="submit" value="Изменить">
                            </form>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h3 class="">{{$product->name}}</h3>
                        <h5 class="">Дата выхода: {{\Carbon\Carbon::parse($product->date)->translatedFormat('d F Y')}}
                            г.</h5>
                        <h5 class="">Жанры:
                            @foreach ($product->genres as $genre)
                                {{ $genre->name }}
                            @endforeach
                        </h5>
                        <div class="card shadow p-3 mb-2 bg-white">
                            <h5 class="">Описание:</h5>
                            <p>{{$product->description}}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column col-md-3">
                        <h5 class="d-flex justify-content-end">Цена:</h5>
                        <h1 class=" d-flex justify-content-end font-weight-bold">{{$product->price}}</h1>
                        @if (!$product->quantity == 0)
                            <h6 class="d-flex justify-content-end">В наличии: {{$product->quantity}} шт.</h6>
                            <div>
                                <form class="card m-1 "
                                      action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-block btn-outline-dark" type="submit"
                                           value="Добавить в корзину">
                                </form>
                                @else
                                    <div class="d-flex justify-content-end">Нет в наличии.</div>
                                @endif
                                <form class="card m-1"
                                      action="{{route('addToFavorite')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-block btn-light" type="submit"
                                           value="Добавить в избранное">
                                </form>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-block btn-primary">Изменить</a>
                            </div>
                    </div>
            </div>
        </div>
        <h4 class="d-flex justify-content-center m-2">САМЫЕ ПОПУЛЯРНЫЕ</h4>
        <div class="d-flex row justify-content-between">
            @foreach($popular as $product)
                <div class="card shadow bg-white rounded m-1" style="width: 180px;">
                    <div class="card bg-white rounded">
                        <a href="{{ route('product.show', ['id' => $product->id]) }}">
                            <img class="card-img-top rounded" style="height: 220px" src="{{ asset($product->image) }}" alt="Card image cap">
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
                            <h6 class="truncate">{{$product->name}}</h6>
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
@endsection
