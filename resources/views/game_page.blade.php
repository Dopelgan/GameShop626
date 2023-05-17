@extends('layouts.app')

@section('content')

    <div class="p-3 mb-2 bg-dark text-white-50">
        <div class="d-flex justify-content-around container">
            <div class="d-flex justify-content-center w-75">
                @if(!$need_game->image==null)
                    <div>
                        <img
                            src='{{$need_game->image}}'
                            class="img-fluid mr-2"
                            width="240">
                        @endif
                        @if (!$need_game->amount == 0)
                            <div class="mb-1"> В наличии: {{$need_game->amount}} шт.</div>
                            {{--                            <form class="mb-1" action="{{route('add_game_to_basket')}}" method="POST">--}}
                            {{--                                @csrf--}}
                            {{--                                <input type="hidden" name="game_name" value="{{$need_game->name}}">--}}
                            {{--                                <input type="hidden" name="user_name" value="Admin">--}}
                            <button id="add_game_to_basket" class="btn btn-outline-warning text-white">Добавить в
                                корзину
                            </button>
                            {{--                            </form>--}}
                        @else
                            <div class="mb-1">Нет в наличии.</div>
                        @endif
{{--                        <form action="{{route('add_favorite')}}" method="post">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="game_name" value="{{$need_game->name}}">--}}
{{--                            <input type="hidden" name="user_name" value="Admin">--}}
                            <button id="add_favorite" class="btn btn-outline-success text-white" type="submit">Добавить в избранное</button>
{{--                        </form>--}}
                    </div>

                    <div class="w-50">
                        <h5 class="text-white">{{$need_game->name}} {{$need_game->year}}г.</h5>
                        <h6>
                            @foreach($need_genres as $genre)
                                @if(!$genre == [])
                                    {{$genre}}
                                @endif
                            @endforeach
                        </h6>
                        <p>{{$need_game->description}}</p>

                    </div>
            </div>
        </div>
    </div>
    <button id="test">ух сука</button>
    <script>
        $('#add_game_to_basket').on('click', function () {
            $.ajax({
                type: "POST", // METHOD
                url: "{{ route('add_game_to_basket') }}", // route
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    game_name: "{{$need_game->name}}",
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
                    game_name: "{{$need_game->name}}",
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
        $('#test').on('click', function () {
            alert('ух сука')
        })
    </script>

@endsection
