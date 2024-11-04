@extends('master')

@section('title', 'Купленные продукты')

@section('body')
    <div class="container">
        @foreach($purchasedProducts as $product)
            <p>Товар: <a href="{{ route('product.show', $product['product']->id) }}"> {{$product['product']->title}} </a> в количестве {{ $product['count'] }} шт. у пользователя: {{ $product['sold_user']->fullName($product['sold_user']->id) }} </p>
        @endforeach
    </div>
@endsection
