@extends('layouts.app')

@section('content')

    <div class="p-3 mb-2 bg-dark text-white-50">
        <div class="d-flex justify-content-around container">
            <div class="d-flex justify-content-center w-75">
                @if(!$game->image==null)
                    <div>
                        <img
                            src='{{$game->image}}'
                            class="img-fluid mr-2"
                            width="240">
                        @endif
                        @if (!$game->amount == 0)
                            <div class="mb-1"> В наличии: {{$game->amount}} шт.</div>
                            <form class="card text-white bg-dark m-1 border-secondary"
                                  action="{{route('add_game_to_basket')}}" method="POST">
                                @csrf
                                <input id="game_name" name="game_name" value="{{$game->name}}" type="hidden">
                                <input id="user_name" name="user_name" value="Admin" type="hidden">
                                <input id="page" name="page" value="/game_page/{{$game->name}}" type="hidden">
                                <input class="btn btn-outline-warning text-white" type="submit"
                                       value="Добавить в корзину">
                            </form>
                        @else
                            <div class="mb-1">Нет в наличии.</div>
                        @endif
                        <form class="card text-white bg-dark m-1 border-secondary"
                              action="{{route('add_favorite')}}" method="POST">
                            @csrf
                            <input id="game_name" name="game_name" value="{{$game->name}}" type="hidden">
                            <input id="user_name" name="user_name" value="Admin" type="hidden">
                            <input id="page" name="page" value="/game_page/{{$game->name}}" type="hidden">
                            <input class="btn btn-outline-success text-white" type="submit"
                                   value="Добавить в избранное">

                        </form>
                    </div>

                    <div class="w-50">
                        <h5 class="text-white">{{$game->name}} {{$game->year}}г.</h5>
                        <h6>
                            @foreach($genres as $genre)
                                @if(!$genre == [])
                                    {{$genre}}
                                @endif
                            @endforeach
                        </h6>
                        <p>{{$game->description}}</p>

                    </div>
            </div>
        </div>
    </div>

@endsection
