@extends('layouts.app')

@section('content')

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
        @if($games_in_basket->count()>0)
            <div class="d-flex justify-content-center">
                <h5>Ваша корзина</h5>
            </div>
            <form action="{{route('clear_basket')}}" method="post">
                @csrf
                <button class="btn btn-outline-danger text-white mt-2" type="submit">Очистить корзину</button>
            </form>
        @else
            <div class="d-flex justify-content-center">
                <h5>Корзина пуста</h5>
            </div>
        @endif
        <div class="row">
            <div class="d-flex w-75 flex-column">
                @foreach($games_in_basket as $game_in_basket)
                    @foreach($games as $game)
                        @if($game->name==$game_in_basket->game_name)
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="w-50">
                                    <a href="/game_page/{{$game->name}}">
                                        <img src='{{$game->image}}'
                                             class="img-fluid m-1"
                                             width="80"></a>
                                    <a class="text-white-50"
                                       href="/game_page/{{$game_in_basket->game_name}}">{{$game_in_basket->game_name}}</a>
                                </div>
                                @if(!$game->amount <= 0)
                                    <form class="d-flex flex-row align-items-center"
                                          action="{{route('change_amount_game_to_basket')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="game_name" value="{{$game->name}}">
                                        <input type="hidden" name="game_amount" value="{{$game_in_basket->amount}}">
                                        <input type="hidden" name="user_name" value="Admin">
                                        <input class="btn btn-danger m-1" name="change" value="-" type="submit">
                                        <div>{{$game_in_basket->amount}}</div>
                                        <input class="btn btn-success m-1" name="change" value="+" type="submit">
                                    </form>
                                    <div>{{$game->price*$game_in_basket->amount}}</div>
                                @else
                                    <div> Временно нет в наличии.</div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
            <div class="d-flex w-25 flex-column align-items-center">
                <h3>ИТОГО:</h3>
            </div>
        </div>

@endsection
