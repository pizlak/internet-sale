@extends('master')

@section('title', 'Продукты')

@section('body')
    <div class="container mt-3">
        <h1> Все продукты
            @if(Route::currentRouteNamed('products.user'))
                {{ Auth::user()->fullName(Auth::user()->id) }}
            @endif
        </h1>
        @auth()
            <div class="alert alert-success d-flex justify-content-center">
                <strong>
                    <a href="{{ route('product.form') }}">Разместить товар для продажи</a>
                </strong>
            </div>
        @endauth

        <div class="row">

            <form action="{{ route('products') }}" method="GET">
                <div class="row mb-3">
                    <p>Фильтр:</p>
                    <div class="col-5">
                        <select name="column" class="form-select">
                            <option value="title" selected>По названию</option>
                            <option value="price">По цене</option>
                            <option value="created_at">По дате создания</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <select  name="method" class="form-select">
                            <option value="desc" selected>По убыванию</option>
                            <option value="asc">По возрастанию</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary">Сортировать</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($products as $product)
                @include('card', ['product' => $product])
            @endforeach
        </div>
    </div>
@endsection
