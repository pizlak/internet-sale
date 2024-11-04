@extends('master')

@section('title', 'Профиль')

@section('body')
    <div class="container">
        <div class="row">
            <h1>{{  $user->fullName($user->id) }}</h1>
            <p>{{ $user->email }}</p>
        </div>
        <hr>
        <div class="row">
            <h2> Товары</h2>
            <div class="col"><a href="{{ route('products.user', Auth::user()) }}">Все товары</a></div>
            <div class="col"><a href="{{ route('products.sold', Auth::user()) }}">Проданные</a></div>
            <div class="col"><a href="{{ route('products.purchased', Auth::user()) }}">Купленные</a></div>
        </div>
        <hr>
        <div class="row">
            <h2>Архив зааказов:</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Заказ</th>
                    <th>Дата</th>
                    <th>Цена</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>№{{ $order->id }}</td>
                        <td>{{ $order->updated_at->format('d.m.Y г. в H:i') }}</td>
                        <td>{{ $order->getFullPrice($order) }} бел. руб. </td>
                        <td><a href="{{ route('order.info', $order) }}">Подробнее</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
