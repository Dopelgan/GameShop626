@extends('layouts.app')

@section('content')

    <!-- resources/views/profile.blade.php -->
    <div class="container d-flex flex-column">
        <h1 class="d-flex justify-content-center">Профиль</h1>
        <div class="d-flex flex-row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label for="last_name">Фамилия:</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required
                                       value="{{ $user->last_name }}">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Имя:</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required
                                       value="{{ $user->first_name }}">
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Отчество:</label>
                                <input type="text" id="middle_name" name="middle_name" class="form-control" required
                                       value="{{ $user->middle_name }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Адрес:</label>
                                <input type="text" id="address" name="address" class="form-control" required
                                       value="{{ $user->address }}">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Номер телефона:</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control" required
                                       value="{{ $user->phone_number }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="w-75 ml-4 card">
                <h2 class="m-3">Ваши заказы</h2>

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

@endsection
