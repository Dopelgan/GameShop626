@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-around" style="min-height: 420px">
            <div class="d-flex justify-content-center">
                @if(!$product->picture==null)
                    <div class="col-md-3">
                        @if(!$metascore == null)
                            <div class="d-flex flex-row justify-content-around align-items-center">
                                <h6 class="font-weight-bold">Metascore</h6>
                                @if($metascore->meta_score >= 75)
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded"
                                        style="background-color: #2fa360;  width: 30px; height: 30px;">{{$metascore->meta_score}}</h6>
                                @elseif($metascore->meta_score >= 50)
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded"
                                        style="background-color: #f6993f;  width: 30px; height: 30px;">{{$metascore->meta_score}}</h6>
                                @else()
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded"
                                        style="background-color: #d0211c;  width: 30px; height: 30px;">{{$metascore->meta_score}}</h6>
                                @endif
                                <h6 class="font-weight-bold">User score</h6>
                                @if($metascore->meta_score >= 75)
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded-circle"
                                        style="background-color: #2fa360;  width: 30px; height: 30px;">{{$metascore->user_score}}</h6>
                                @elseif($metascore->meta_score >= 50)
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded-circle"
                                        style="background-color: #f6993f;  width: 30px; height: 30px;">{{$metascore->user_score}}</h6>
                                @else()
                                    <h6 class="d-flex justify-content-center align-items-center font-weight-bold rounded-circle"
                                        style="background-color: #d0211c;  width: 30px; height: 30px;">{{$metascore->user_score}}</h6>
                                @endif
                            </div>
                        @endif
                        <img
                            src='{{$product->picture}}'
                            class="img-fluid mr-5 rounded shadow bg-white p-2">
                        @endif
                        @if($product->picture == null)
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
                        <h5 class="">Год выхода: {{$product->year}}</h5>
                        <h5 class="">Жанры:
                            @foreach($genres as $genre)
                                @if($genre->rus_name == null)
                                    {{$genre->eng_name}}
                                @else
                                    {{$genre->rus_name}}
                                @endif
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
                        <h6 class=" d-flex justify-content-end">В наличии: {{$product->quantity}} шт.</h6>
                        <div>
                            @if (!$product->quantity == 0)
                                <form class="card m-1 "
                                      action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-block btn-outline-dark" type="submit"
                                           value="Добавить в корзину">
                                </form>
                            @else
                                <div class="mb-1">Нет в наличии.</div>
                            @endif
                            <form class="card m-1"
                                  action="{{route('addToFavorite')}}" method="POST">
                                @csrf
                                <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                <input class="btn btn-block btn-light" type="submit"
                                       value="Добавить в избранное">
                            </form>
                        </div>
                    </div>
            </div>
        </div>
        <h4 class="d-flex justify-content-center m-2">САМЫЕ ПОПУЛЯРНЫЕ</h4>
        <div class="d-flex row justify-content-center">
            @foreach($popular as $product)
                @if(!$product->quantity == 0)
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
                                <input id="product_id" name="product_id" value="{{$product->product_id}}" type="hidden">
                                <input class="btn btn-block btn-sm btn-outline-dark shadow-sm" type="submit"
                                       value="В корзину">
                            </form>
                            <form class="card"
                                  action="{{route('addToFavorite')}}" method="POST">
                                @csrf
                                <input id="product_id" name="product_id" value="{{$product->product_id}}" type="hidden">
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
