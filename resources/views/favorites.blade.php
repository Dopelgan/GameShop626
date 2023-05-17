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
                    <button class="btn btn-outline-danger text-white mt-2" type="submit">Очистить избранное</button>
                </form>
            @else
                <div class="d-flex justify-content-center">
                    <h5>Избранное</h5>
                </div>
                <div class="d-flex justify-content-center">
                    <h6>Пока что здесь пусто</h6>
                </div>
            @endif
            <button id="clear_favorites">clear_favorites</button>
            <div id="games_block" class="d-flex w-75 flex-column">
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

        <script>
            $('#clear_favorites').on('click', function () {
                $.ajax({
                    type: "POST",
                    url: "{{route('clear_favorites')}}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_name: "Admin"
                    },
                    success: function (response) {
                        $('#games_block').html("<div><h3>Пока что здесь пусто</h3></div>")
                        $('#clear_favorites').remove()
                    },
                    error: function (response) {
                        alert(response.message)
                    }
                })
            })
        </script>

@endsection
