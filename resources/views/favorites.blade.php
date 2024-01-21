@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="container">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($games->count()>0)
                <div class="d-flex justify-content-center">
                    <h5>Избранное</h5>
                </div>
                @csrf
                <div class="d-flex justify-content-end">
                    <button id="clear_favorites" class="btn btn-outline-danger text-white m-2" type="submit">Очистить
                        избранное
                    </button>
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <h5>Избранное</h5>
                </div>
                <div class="d-flex justify-content-center">
                    <h6>Пока что здесь пусто</h6>
                </div>
            @endif

            <div id="games_block" class="d-flex justify-content-center row">
                @foreach($games as $game)
                    <div class="card text-white bg-dark m-1 border-secondary" style="width: 16rem;">
                        <a href="/game_page/{{$game->name}}">
                            <img class="card-img-top" src="{{$game->image}}" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <a href="/game_page/{{$game->name}}">
                                <h6 class="card-title text-white">{{$game->name}}</h6>
                            </a>
                            <p class="card-text">{{$game->price}} р.</p>
                            @if($game->amount != 0)
                                <form class="card text-white bg-dark m-1 border-secondary"
                                      action="{{route('add_game_to_basket')}}" method="POST">
                                    @csrf
                                    <input id="game_name" name="game_name" value="{{$game->name}}" type="hidden">
                                    <input id="user_name" name="user_name" value="Admin" type="hidden">
                                    <input id="page" name="page" value="favorites" type="hidden">
                                    <input class="btn btn-outline-warning text-white" type="submit"
                                           value="Добавить в корзину">
                                </form>
                            @else
                                <h5>Нет в наличии</h5>
                            @endif
                            <form class="card text-white bg-dark m-1 border-secondary"
                                  action="{{route('delete_from_favorites')}}" method="POST">
                                @csrf
                                <input id="game_name" name="game_name" value="{{$game->name}}" type="hidden">
                                <input id="user_name" name="user_name" value="Admin" type="hidden">
                                <input id="page" name="page" value="favorites" type="hidden">
                                <input class="btn btn-outline-danger text-white" type="submit"
                                       value="Удалить из избранного">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

@endsection
