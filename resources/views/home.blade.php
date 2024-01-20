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
                                    <button id="add_game_to_basket" class="btn btn-outline-warning text-white">Добавить в
                                        корзину
                                    </button>
                                    <button id="add_favorite" class="btn btn-outline-success text-white" type="submit">Добавить в избранное</button>
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
                                    <button id="add_favorite" class="btn btn-outline-success text-white" type="submit">Добавить в избранное</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        <script>
            $('#add_game_to_basket').on('click', function () {
                $.ajax({
                    type: "POST", // METHOD
                    url: "{{ route('add_game_to_basket') }}", // route
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        game_name: "{{$game->name}}",
                        user_name: "Admin"
                    },
                    success: function (response) {
                        console.log(response.result)
                    },
                    error: function (response) {
                        alert(response.message)
                    }
                });
            })
            $('#add_favorite').on('click', function () {
                $.ajax({
                    type: "POST",
                    url: "{{route('add_favorite')}}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        game_name: "{{$game->name}}",
                        user_name: "Admin"
                    },
                    success: function (response) {
                        console.log(response.result)
                    },
                    error: function (response) {
                        alert(response.message)
                    }
                })
            })
        </script>

@endsection
