@extends('layouts.app')

@section('content')

    <div class="p-3 mb-2">
        <div class="d-flex justify-content-around container">
            <div class="d-flex justify-content-center">
                @if(!$product->picture==null)
                    <div class="col-md-3">
                        @if(!$metascore == null)
                        <div class="d-flex flex-row justify-content-around align-items-center">
                            <h6 class="font-weight-bold">Metascore</h6>
                            <h6 class = "d-flex justify-content-center align-items-center font-weight-bold rounded" style="background-color: #2fa360;  width: 30px; height: 30px;">{{$metascore->meta_score}}</h6>
                            <h6 class="font-weight-bold">User score</h6>
                            <h6 class = "d-flex justify-content-center align-items-center font-weight-bold rounded-circle" style="background-color: #2fa360;  width: 30px; height: 30px;">{{$metascore->user_score}}</h6>
                        </div>
                        @endif
                        <img
                            src='{{$product->picture}}'
                            class="img-fluid mr-5 rounded">
                        @endif
                        <form class="d-flex flex-column m-2" action="{{route('changeProductPicture')}}"
                              method="POST">
                            @csrf
                            <b>Изменить изображение</b>
                            <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                            <label for="picture">Вставьте ссылку на изображение</label>
                            <input class="form form-control" type="text" id="picture" name="picture" required>
                            <input class="btn btn-success mt-2" type="submit" value="Изменить">
                        </form>
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
                        <h5 class="">Описание:</h5>
                        <p>{{$product->description}}</p>
                    </div>
                    <div class="d-flex flex-column col-md-3">
                        <h5 class="d-flex justify-content-end">Цена:</h5>
                        <h1 class=" d-flex justify-content-end font-weight-bold">{{$product->price}}</h1>
                        <h6 class=" d-flex justify-content-end">В наличии: {{$product->quantity}}</h6>
                        <div>
                            @if (!$product->quantity == 0)
                                <form class="card m-1 "
                                      action="{{route('addToBasket')}}" method="POST">
                                    @csrf
                                    <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                    <input class="btn btn-block btn-success" type="submit"
                                           value="Добавить в корзину">
                                </form>
                            @else
                                <div class="mb-1">Нет в наличии.</div>
                            @endif
                            <form class="card m-1"
                                  action="{{route('addToFavorite')}}" method="POST">
                                @csrf
                                <input id="product_id" name="product_id" value="{{$product->id}}" type="hidden">
                                <input class="btn text-white btn-block btn-primary" type="submit"
                                       value="Добавить в избранное">
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection
