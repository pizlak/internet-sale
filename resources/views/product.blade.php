@extends('master')

@section('title', 'Продукт ' . $product->title)

@section('body')
    <div class="container mt-3">
        <div class="card mb-3" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('storage/'. $product->image) }}" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text"><strong> Описание: </strong> {{ $product->description }}</p>
                        <h3 class="card-text">Цена: {{ $product->price }} бел. руб.</h3>
                        <p class="card-text"><strong> Остаток: </strong> {{ $product->count }} шт.</p>
                        <p class="card-text"><small class="text-body-secondary"> Продавец: {{ $product->user->fullName($product->user->id) }}</small></p>
                        @auth()
                        @if($product->user_id !== Auth::user()->id)
                            <form action="{{ route('product.add', $product) }}" method="POST">
                                @csrf
                                <button class="btn btn-success">В корзину</button>
                            </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
