@extends('master')

@section('title', 'Проданные продукты')

@section('body')
    <div class="container">
        @foreach($products as $product)
            @if(!$product->orders->isEmpty())
                <h3>{{ $product->title }}</h3>
                <p>Остаток: {{ $product->count }}</p>
                <p>Продажи:</p>
                @foreach($product->orders as $order)
                    @foreach($order->products as $orderProduct)

                    @endforeach
                    <p> Пользователь - {{ $order->user->fullName($order->user->id) }}
                        купил {{ $order->updated_at->format('d.m.Y г. в H:i') }} в
                        количестве {{ $orderProduct->pivot->count }} шт. </p>
                @endforeach
                <hr>
            @endif
        @endforeach
    </div>
@endsection
