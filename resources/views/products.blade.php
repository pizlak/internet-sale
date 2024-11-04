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
            @if(Route::currentRouteNamed('products'))
                <form action="{{ route('products') }}" method="GET">
                    @elseif(Route::currentRouteNamed('products.user'))
                        <form action="{{ route('products.user', Auth::user()) }}" method="GET">
                            @endif
                            <div class="row mb-3">
                                <p>Фильтр:</p>
                                <div class="col-5">
                                    <select name="column" class="form-select">
                                        <option
                                            value="title" {{ $request->input('column') == 'title' ? 'selected' : '' }}>
                                            По названию
                                        </option>
                                        <option
                                            value="price" {{ $request->input('column') == 'price' ? 'selected' : '' }}>
                                            По цене
                                        </option>
                                        <option
                                            value="created_at" {{ $request->input('column') == 'created_at' ? 'selected' : '' }}>
                                            По дате создания
                                        </option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select name="method" class="form-select">
                                        <option
                                            value="desc" {{ $request->input('method') == 'desc' ? 'selected' : '' }}>По
                                            убыванию
                                        </option>
                                        <option value="asc" {{ $request->input('method') == 'asc' ? 'selected' : '' }}>
                                            По возрастанию
                                        </option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary">Сортировать</button>
                                    <a class="btn btn-warning ms-3"
                                       @if(Route::currentRouteNamed('products'))
                                       href="{{ route('products') }}
                                       @elseif(Route::currentRouteNamed('products.user'))
                                       href="{{ route('products.user', Auth::user()) }}
                                       @endif
                                       ">Сброить</a>
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
