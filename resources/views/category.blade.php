@extends('master')

@section('title', 'Категории')

@section('body')
    <div class="container mt-3">
        <h2> Все товары категории: {{ $category->title }}</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($category->products as $product)
                @include('card', ['product' => $product])
            @endforeach
        </div>
    </div>
@endsection
