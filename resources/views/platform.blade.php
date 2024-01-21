@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center"><img
            src="{{$platform->picture}}"
            class="img-fluid m-1"
            width="200">
    </div>

    <h5 class="d-flex justify-content-center m-2 text-white">Игры в наличии:</h5>
    <div class="d-flex row justify-content-center">
        @foreach($games as $game)
            @if(!$game->amount == 0)

                <div class="card text-white bg-dark m-1 border-secondary" style="width: 16rem;">
                    <a href="/game_page/{{$game->name}}">
                        <img class="card-img-top" src="{{$game->image}}" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <a href="/game_page/{{$game->name}}">
                            <h6 class="card-title text-white">{{$game->name}}</h6>
                        </a>
                        <p class="card-text">{{$game->price}} р.</p>
                        <form class="card text-white bg-dark m-1 border-secondary"
                              action="{{route('add_game_to_basket')}}" method="POST">
                            @csrf
                            <input id="game_name" name="game_name" value="{{$game->name}}" type="hidden">
                            <input id="user_name" name="user_name" value="Admin" type="hidden">
                            <input id="page" name="page" value="home" type="hidden">
                            <input class="btn btn-outline-warning text-white" type="submit"
                                   value="Добавить в корзину">
                        </form>
                        <form class="card text-white bg-dark m-1 border-secondary"
                              action="{{route('add_favorite')}}" method="POST">
                            @csrf
                            <input id="game_name" name="game_name" value="{{$game->name}}" type="hidden">
                            <input id="user_name" name="user_name" value="Admin" type="hidden">
                            <input class="btn btn-outline-success text-white" type="submit"
                                   value="Добавить в избранное">

                        </form>
                    </div>
                </div>

            @endif

        @endforeach
    </div>
    <h5 class="d-flex justify-content-center m-2 text-white">Временно нет в наличии:</h5>
    <div class="d-flex row justify-content-center">
        @foreach($games as $game)
            @if($game->amount == 0)
                <div class="card text-white bg-dark m-1 border-secondary" style="width: 16rem;">
                    <a href="/game_page/{{$game->name}}">
                        <img class="card-img-top" src="{{$game->image}}" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <a href="/game_page/{{$game->name}}">
                            <h6 class="card-title text-white">{{$game->name}}</h6>
                        </a>
                        <p class="card-text">{{$game->price}} р.</p>
                        <button id="add_favorite" class="btn btn-outline-success text-white" type="submit">
                            Добавить в избранное
                        </button>
                    </div>
                </div>

            @endif
        @endforeach
    </div>

@endsection
