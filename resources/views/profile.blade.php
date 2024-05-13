@extends('layouts.app')

@section('content')

    <!-- resources/views/profile.blade.php -->
    <div class="container d-flex flex-column">
        <h1 class="text-center">Профиль</h1>
        <div class="d-flex flex-row justify-content-center">
                <div class="card w-25">
                    <h3 class="card-header">Ваши данные:</h3>
                    <div class="card-body">
                        <h6>ФИО:</h6>
                        <h5>{{ $user->last_name }}</h5>
                        <h5>{{ $user->first_name }}</h5>
                        <h5>{{ $user->middle_name }}</h5>
                        <h6>Адрес:</h6>
                        <h5>{{ $user->address }}</h5>
                        <h6>Номер телефона:</h6>
                        <h5>{{ $user->phone_number }}</h5>
                    </div>
                    <form action="{{ route('user.edit') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary mb-3 ml-3">Изменить информацию</button>
                    </form>
                </div>
            <div class="w-75 ml-4 card">
                <h2 class="card-header">Ваши заказы</h2>

                @if ($packages->isEmpty())
                    <p>У вас нет заказов</p>
                @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Номер заказа</th>
                            <th>Дата создания</th>
                            <th>Статус</th>
                            <th>Общая стоимость</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td>{{ $package->id }}</td>
                                <td>{{ $package->created_at }}</td>
                                <td>{{ $package->current_status }}</td>
                                <td>{{ $package->price }}</td>
                                <td>
                                    <a href="{{ route('package', ['id' => $package->id]) }}">Подробнее</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    </div>

@endsection
