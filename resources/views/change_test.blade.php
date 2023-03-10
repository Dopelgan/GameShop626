@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form class="d-flex flex-column w-25 m-2" action="{{route('game_genre')}}" method="POST">
                @csrf
                <h5>Связать игру и жанры</h5>
                <label for="game_name">Выберите игру</label>
                <select class="custom-select" id="game_name" name="game_name" required="required">
                    @foreach($games as $game)
                        <option value="{{$game->name}}">{{$game->name}}</option>
                    @endforeach
                </select>
                <div class="mt-2">
                    <label for="game_name">Выберите жанры (через Ctrl)</label>
                    <br>
                    <select id="game_name" name="genre_name[]" multiple="multiple" size="4" required="required"
                            class="custom-select">
                        @foreach($genres as $genre)
                            <option value="{{$genre->name}}">{{$genre->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input class="btn btn-success mt-2" type="submit" value="Связать">
            </form>

            <form class="d-flex flex-column w-25 m-2" action="{{route('game_platform')}}" method="POST">
                @csrf
                <h5>Связать игру и платформу</h5>
                <div>
                    <label for="game_name">Выберите игру</label>
                    <br>
                    <select class="custom-select" id="game_name" name="game_name" required="required">
                        @foreach($games as $game)
                            <option value="{{$game->name}}">{{$game->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="platform_name">Выберите платформу</label>
                    <br>
                    <select class="custom-select" id="platform_name" name="platform_name" required="required">
                        @foreach($platforms as $platform)
                            <option value="{{$platform->name}}">{{$platform->name}}</option>
                        @endforeach
                    </select>
                </div>

                <input class="btn btn-success mt-2" type="submit" value="Связать">
            </form>

            <form class="d-flex flex-column w-25 m-2" action="{{route('change_game_amount')}}"
                  method="POST">
                @csrf
                <h5>Изменить количество игр</h5>
                <label for="game_name">Выберите игру</label>
                <select class="custom-select" id="game_name" name="game_name" required="required">
                    @foreach($games as $game)
                        <option value="{{$game->name}}">{{$game->name}}</option>
                    @endforeach
                </select>
                <label for="new_amount">Изменить кол-во копий</label>
                <input class="form form-control" type="text" id="new_amount" name="new_amount" required>
                <input class="btn btn-success mt-2" type="submit" value="Изменить">
            </form>


            <form class="d-flex flex-column w-25 m-2" action="{{route('change_description')}}"
                  method="POST">
                @csrf
                <div>
                    <h5>Редактировать описание:</h5>
                    <label for="game_name">Выберите игру</label>
                    <select class="custom-select" id="game_name" name="game_name" required="required">
                        @foreach($games as $game)
                            <option value="{{$game->name}}">{{$game->name}}</option>
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

            <form class="d-flex flex-column w-25 m-2" action="{{route('change_game_image')}}"
                  method="POST">
                @csrf
                <h5>Изменить изображение игры</h5>
                <label for="game_name">Выберите игру</label>
                <select class="custom-select" id="game_name" name="game_name" required="required">
                    @foreach($games as $game)
                        <option value="{{$game->name}}">{{$game->name}}</option>
                    @endforeach
                </select>
                <label class="mt-2" for="new_image">Вставьте ссылку на изображение</label>
                <input class="form form-control" type="text" id="new_image" name="new_image" required>
                <input class="btn btn-success mt-2" type="submit" value="Изменить">
            </form>

        </div>
    </div>

@endsection
