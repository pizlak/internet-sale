@extends('master')

@section('title', 'Корзина заказа')

@section('body')
    <div class="container">
        @if(!empty($order))
            <strong>
                <div class="row mt-3">
                    <div class="col-2 d-flex  justify-content-center align-items-center">Изображение</div>
                    <div class="col-4 d-flex  justify-content-center align-items-center">Название и описание</div>
                    <div class="col-2 d-flex  justify-content-center align-items-center">Количество</div>
                    <div class="col-2 d-flex  justify-content-center align-items-center">Цена за шт.</div>
                    <div class="col-2 d-flex  justify-content-center align-items-center">Сумма</div>
                </div>
            </strong>
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
                        <div class="row"><p> Остаток: {{ $product->count }} шт.</p></div>

                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <div class="d-flex btn-group w-50">
                            <form action="{{ route('product.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-success btn"
                                    {{ $product->count <= $product->pivot->count ? 'disabled' : '' }}>+
                                </button>
                            </form>
                            <button class="btn" disabled>{{ $product->pivot->count }}</button>
                            <form action="{{ route('product.remove', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-danger btn">-</button>
                            </form>
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
            <div class="row mt-2">
                <div class="col-10"></div>
                <div class="col-2">
                    <form action="{{ route('basket.complete') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">
                            Оформить заказ ({{ $order->getFullPrice($order) }} бел. руб.)
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="row row align-items-center" style="height: 100%;">
                <div class="col text-center">
                    <h3>Ваша корзина пуста!</h3>
                    <a class="btn btn-success" href="{{ route('home') }}">Начать покупки.</a>
                </div>
            </div>
        @endif
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
