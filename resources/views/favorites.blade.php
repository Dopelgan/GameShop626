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
                    <form action="{{route('clear_basket')}}" method="post">
                        @csrf
                        <button class="btn btn-outline-danger text-white mt-2" type="submit">Очистить корзину</button>
                    </form>
                @else
                    <div class="d-flex justify-content-center">
                        <h5>Избранное</h5>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h6>Пока что здесь пусто</h6>
                    </div>
                @endif

            <div class="d-flex w-75 flex-column">
                @foreach($games as $game)
                    <div class="d-flex align-items-center mt-2">
                        <div class="w-50">
                            <a href="/game_page/{{$game->name}}">
                                <img src='{{$game->image}}'
                                     class="img-fluid m-1"
                                     width="80"></a>
                            <a class="text-white-50"
                               href="/game_page/{{$game->name}}">{{$game->name}}</a>
                        </div>
                        <div class="mr-2">{{$game->price}}р</div>
                        <form action="{{route('delete_from_favorites')}}" method="post">
                            @csrf
                            <input type="hidden" name="game_name" value="{{$game->name}}">
                            <button class="btn btn-outline-danger text-white mt-2" type="submit">Удалить</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

@endsection
