@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Информация о заказе</div>

                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between">
                            <p><strong>Номер заказа:</strong> {{ $parentPackage->id }}</p>
                            <form class="d-flex justify-content-end" action="{{route('packageRemove')}}" method="POST">
                                @csrf
                                <input type="hidden" id="package_id" name="package_id" value="{{$parentPackage->id}}">
                                <button type="submit" class="btn btn-danger">Отменить заказ</button>
                            </form>
                        </div>
                        <p><strong>Дата создания:</strong> {{ $parentPackage->created_at }}</p>
                        <p><strong>Статус:</strong> {{ $parentPackage->current_status }}</p>
                        <p><strong>Состав заказа:</strong></p>
                        <div class="card">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Наименование</th>
                                <th>Количество</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($childPackages as $childPackage)

                                <tr>
                                    <td>{{ $childPackage->product->name }}</td>
                                    <td>{{ $childPackage->quantity }}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        </div>
                        <h6 class="mt-3 text-right"><strong>Стоимость заказа:</strong></h6>
                        <h3 class="text-right">{{ $parentPackage->price }} р.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
