@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 style="text-align:center">Страница администратора</h3>
    </div>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="d-flex row justify-content-between">
            {{--            <div class="w-25">--}}
            {{--                <form class="d-flex flex-column m-2" action="{{route('autoAddProduct')}}" method="GET">--}}
            {{--                    @csrf--}}
            {{--                    <h5>Добавить игру, её жанры и оценки с метакритик автоматически</h5>--}}
            {{--                    <div class="mt-2">--}}
            {{--                        <label for="url">Ссылка на игру</label>--}}
            {{--                        <br>--}}
            {{--                        <input class="form form-control" id="url" type="text" name="url" required>--}}
            {{--                    </div>--}}
            {{--                    <div class="mt-2">--}}
            {{--                        <label for="category">Выберите категорию</label>--}}
            {{--                        <br>--}}
            {{--                        <select id="category" name="category" required="required" class="custom-select">--}}
            {{--                            @foreach($categories as $category)--}}
            {{--                                <option value="{{$category->id}}">{{$category->name}}</option>--}}
            {{--                            @endforeach--}}
            {{--                        </select>--}}
            {{--                    </div>--}}
            {{--                    <div class="mt-2">--}}
            {{--                        <label for="quantity">Количество</label>--}}
            {{--                        <input type="text" id="quantity" name="quantity" required class="form form-control">--}}
            {{--                    </div>--}}
            {{--                    <div class="mt-2">--}}
            {{--                        <label for="price">Цена</label>--}}
            {{--                        <br>--}}
            {{--                        <input id="price" type="text" name="price" required class="form form-control">--}}
            {{--                    </div>--}}
            {{--                    <input class="btn btn-success mt-2" type="submit" value="Добавить">--}}
            {{--                </form>--}}
            {{--            </div>--}}

            <div class="card">
                <h5 class="card-header">Добавить игру вручную</h5>
                <form class="d-flex flex-column m-2 card-body" action="{{route('addProduct')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product_name">Название игры</label>
                        <br>
                        <input class="form form-control" id="product_name" type="text" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label for="dateInput">Выберите дату выхода:</label>
                        <input type="date" class="form-control" name="dateInput" id="dateInput" required="required" placeholder="Выберите дату">
                    </div>
                    <div class="form-group">
                        <label for="genres">Выберите жанры</label>
                        <br>
                        <div id="genres" class="custom-checkbox-group">
                            @foreach($genres as $genre)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="genres[]" value="{{$genre->id}}" id="genre{{$genre->id}}">
                                    <label class="form-check-label" for="genre{{$genre->id}}">
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
                    <div class="form-group">
                        <label for="category">Выберите категорию</label>
                        <br>
                        <select id="category" name="category" required="required" class="custom-select">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="metascore">Metascore</label>
                        <input type="text" id="metascore" name="metascore" required class="form form-control">
                        <label for="userscore">Userscore</label>
                        <input type="text" id="userscore" name="userscore" required class="form form-control">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Количество</label>
                        <input type="text" id="quantity" name="quantity" required class="form form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <br>
                        <input id="price" type="text" name="price" required class="form form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <br>
                        <textarea class="form form-control" id="description" name="description" cols="30" rows="5"
                                  maxlength="1000">Описание пока не добавили.</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Ссылка на изображение</label>
                        <br>
                        <input id="image" type="text" name="image" required class="form form-control">
                    </div>
                    <input class="btn btn-success mt-2" type="submit" value="Добавить">
                </form>
            </div>

            <div>
                <form class="d-flex flex-column m-2" action="{{route('addGenre')}}" method="POST">
                    @csrf
                    <h5>Добавить жанр</h5>
                    <label for="name">Название жанра</label>
                    <input class="form form-control" type="text" id="name" name="name" required>
                    <input class="btn btn-success mt-2" type="submit" value="Добавить">
                </form>

                <form class="d-flex flex-column m-2 mt-4" action="{{route('addCategory')}}" method="POST">
                    @csrf
                    <h5>Добавить категорию</h5>
                    <label for="category_name">Название категории</label>
                    <input class="form form-control" type="text" id="category_name" name="category_name" required>
                    <input class="btn btn-success mt-2" type="submit" value="Добавить">
                </form>

                <form class="d-flex flex-column m-2 mt-4" action="{{route('linkProductGenre')}}" method="POST">
                    @csrf
                    <h5>Связать продукт и жанры</h5>
                    <label for="product_id">Выберите игру</label>
                    <select class="custom-select" id="product_id" name="product_id" required="required">
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <label for="genres_id">Выберите жанры (через Ctrl)</label>
                        <br>
                        <select id="genres_id" name="genres_id[]" multiple="multiple" size="4" required="required"
                                class="custom-select">
                            @foreach($genres as $genre)
                                <option value="{{$genre->id}}">
                                    @if($genre->rus_name == null)
                                        {{$genre->eng_name}}
                                    @else
                                        {{$genre->rus_name}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input class="btn btn-success mt-2" type="submit" value="Связать">
                </form>
            </div>

            <div class="w-25">
                <form class="d-flex flex-column m-2" action="{{route('changeQuantity')}}"
                      method="POST">
                    @csrf
                    <h5>Изменить количество</h5>
                    <label for="product_id">Выберите продукт</label>
                    <select class="custom-select" id="product_id" name="product_id" required="required">
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                    <label for="quantity">Изменить кол-во копий</label>
                    <input class="form form-control" type="text" id="quantity" name="quantity" required>
                    <input class="btn btn-success mt-2" type="submit" value="Изменить">
                </form>


                <form class="d-flex flex-column m-2" action="{{route('changeDescription')}}"
                      method="POST">
                    @csrf
                    <div>
                        <h5>Редактировать описание:</h5>
                        <label for="game_name">Выберите игру</label>
                        <select class="custom-select" id="game_name" name="game_name" required="required">
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="new_description">Введите новое описание</label>
                        <textarea class="form form-control" id="new_description" name="new_description" cols="50"
                                  rows="5" required>Описание пока не добавили.</textarea>
                    </div>
                    <input class="btn btn-success mt-2" type="submit" value="Изменить">
                </form>

                <form class="d-flex flex-column m-2" action="{{route('changeProductPicture')}}"
                      method="POST">
                    @csrf
                    <h5>Изменить изображение продукта</h5>
                    <label for="product_id">Выберите игру</label>
                    <select class="custom-select" id="product_id" name="product_id" required="required">
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                    <label class="mt-2" for="picture">Вставьте ссылку на изображение</label>
                    <input class="form form-control" type="text" id="picture" name="picture" required>
                    <input class="btn btn-success mt-2" type="submit" value="Изменить">
                </form>
            </div>
        </div>
    </div>

@endsection
