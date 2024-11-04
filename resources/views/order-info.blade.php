@extends('master')

@section('title', 'Профиль')

@section('body')
    <div class="container">
       <h3 class="mb-3">Заказ №{{ $order->id }} от {{ $order->updated_at->format('d.m.Y г. в H:i') }}</h3>
        @foreach($order->products as $product)
            <div class="row mt-1">
                <div class="col-2 d-flex  justify-content-center align-items-center">
                    <div class="square-container">
                        <img class="w-100" src="{{ asset('storage/' . $product->image) }}" alt="">
                    </div>
                </div>
                <div class="col-4">
                    <div class="row"><h3>{{ $product->title }}</h3></div>
                    <div class="row"><p>{{ $product->description }}</p></div>

                </div>
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <div class="d-flex btn-group w-50">
                       {{ $product->pivot->count }} шт.
                    </div>
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center">{{ $product->price }} бел.
                    руб.
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center">{{ $product->getSumPrice() }}
                    бел. руб.
                </div>
            </div>
        @endforeach
        <div class="full-price mt-3">
            <h5> Общая стоимость: {{ $order->getFullPrice($order) }} бел. руб.</h5>
        </div>
    </div>
    <style>
        .square-container {
            width: 100px;
            height: 100px;
            overflow: hidden;
        }

        .square-container img {
            width: auto;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection
