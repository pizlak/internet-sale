@extends('master')

@section('title', 'Домашняя страница')

@section('body')
    <div class="container mt-3">
        @auth()
            <h2> Здравствуйте, {{ $user->fullName($user->id) }}</h2>
        @if(session('success'))
                <div class="alert alert-success d-flex justify-content-center">
                    <strong>
                        {{ session('success') }}
                    </strong>
                </div>
            @endif
            <div class="alert alert-success d-flex justify-content-center">
                <strong>
                    <a href="{{ route('product.form') }}">Разместить товар для продажи</a>
                </strong>
            </div>
        @endauth
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($products as $product)
                @include('card', ['product' => $product])
            @endforeach
        </div>
    </div>
@endsection
