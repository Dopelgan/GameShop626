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
                    <button id="clear_favorites" class="btn btn-outline-danger text-white mt-2" type="submit">Очистить избранное</button>
            @else
                <div class="d-flex justify-content-center">
                    <h5>Избранное</h5>
                </div>
                <div class="d-flex justify-content-center">
                    <h6>Пока что здесь пусто</h6>
                </div>
            @endif
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
                            <button id="delete_from_favorites" class="btn btn-outline-danger text-white mt-2" type="submit">Удалить</button>
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
            $('#delete_from_favorites').on('click', function () {
                $.ajax({
                    type: "POST",
                    url: "{{route('delete_from_favorites')}}",
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
