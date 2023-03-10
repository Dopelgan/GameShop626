@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center w-75 container">
        <div class="d-flex flex-column p-3 mb-2 bg-dark text-white-50">
            <h3 class="d-flex justify-content-center text-white">Главная страница магазина </h3>
            <div class="d-flex justify-content-center">
                @foreach($platforms as $platform)
                    <a href="/platform/{{$platform->name}}">
                        <img
                            src="{{$platform->picture}}"
                            class="img-fluid m-1"
                            width="200"></a>
                @endforeach
                </div>
                <h5 class="text-white">Игры в наличии:</h5>
                <div class="row">
                    @foreach($games as $game)
                        @if(!$game->amount == 0)
                            <div style="text-align:center" class="d-flex flex-column">
                                <a href="/game_page/{{$game->name}}">
                                    <img src='{{$game->image}}'
                                         class="img-fluid m-1"
                                         width="110"></a>
                                <h5 class="m-1">{{$game->price}} ₽</h5>
                            </div>
                        @endif
                    @endforeach
                </div>
                <h5 class="text-white">Временно нет в наличии:</h5>
                <div class="row">
                    @foreach($games as $game)
                        @if($game->amount == 0)
                            <div style="text-align:center" class="d-flex flex-column">
                                <a href="/game_page/{{$game->name}}">
                                    <img src='{{$game->image}}'
                                         class="img-fluid m-1"
                                         width="110"
                                         alt="Пример"></a>
                                <h5 class="m-1">{{$game->price}} ₽</h5>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

@endsection
