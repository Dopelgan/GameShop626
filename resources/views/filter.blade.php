@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="d-flex justify-content-center m-2">НАЙДИ ТО - ЧТО ТЕБЕ ПОДОЙДЕТ</h4>
        <div class="d-flex flex-row">
            <div class="w-25">
                <form class="w-75" action="{{route('filter')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div>
                            <label for="order_by">Сортировать по:</label>
                            <br>
                            <select class="custom-select" id="order_by" name="order_by" required="required">
                                <option value="count">Популярности</option>
                                <option value="metaScore">Оценке Metacritic</option>
                                <option value="userScore">Оценке игроков</option>
                                <option value="maxPrice">По уменьшению цены</option>
                                <option value="minPrice">По возрастанию цены</option>
                                <option value="name">Названию</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="genre_id">Жанры</label>
                            <br>
                            @foreach($genres as $genre)
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" name="genre_id[]"
                                           id="{{ $genre->id }}"
                                           value="{{ $genre->id }}">
                                    <label class="custom-control-label" for="{{ $genre->id }}">
                                        @if($genre->rus_name == null)
                                            {{$genre->eng_name}}
                                        @else
                                            {{$genre->rus_name}}
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="category_id">Категории</label>
                        <br>
                        @foreach($categories as $category)
                            <div class="custom-control custom-switch">
                                <input class="custom-control-input" type="checkbox" name="category_id"
                                       id="{{ $category->name }}"
                                       value="{{ $category->id }}">
                                <label class="custom-control-label" for="{{ $category->name }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <div>
                        <label for="price">Цена</label>
                        <input type="range" id="priceRange" name="priceRange" min="{{ $minPrice }}"
                               max="{{ $maxPrice }}"
                               value="{{ $maxPrice }}">
                        <span id="priceValue"></span>
                    </div>
                    <input class="btn btn-block btn-sm btn-outline-dark shadow-sm mt-2" type="submit">
                </form>
            </div>
            <div class="w-75">
                <div class="d-flex row justify-content-center">
                    @foreach($filter as $product)
                        @if(!$product->quantity == 0)
                            <div class="card shadow m-1 bg-white rounded" style="width: 200px;">
                                <a href="{{ route('product.show', ['id' => $product->product_id]) }}">
                                    <img class="card-img-top rounded bg" src="{{$product->picture}}"
                                         alt="Card image cap">
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
                                    <a href="{{ route('product.show', ['id' => $product->product_id]) }}">
                                        <div
                                            class="d-flex align-items-center justify-content-center text-dark text-center"
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
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#priceRange').on('input', function () {
                $('#priceValue').text($(this).val());
            });
        });
    </script>

@endsection
