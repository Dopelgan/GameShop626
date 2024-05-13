<!-- resources/views/user/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card w-50">
            <h1 class="card-header">Редактировать профиль</h1>
            <form class="card-body" action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                           value="{{ $user->last_name }}">
                </div>

                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                           value="{{ $user->first_name }}">
                </div>

                <div class="form-group">
                    <label for="middle_name">Отчество</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name"
                           value="{{ $user->middle_name }}">
                </div>

                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                </div>

                <div class="form-group">
                    <label for="phone_number">Номер телефона</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                           value="{{ $user->phone_number }}">
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
