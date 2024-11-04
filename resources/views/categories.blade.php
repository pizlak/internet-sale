@extends('master')

@section('title', 'Категории')

@section('body')
    <div class="container mt-3">
        <h1>Категории:</h1>
        <div class="list-group">
            @foreach($categories as $category)
                <a href="{{ route('category', $category->slug) }}">
                    <button type="button" class="list-group-item list-group-item-action">{{ $category->title }} ({{$category->products->count()}})</button>
                </a>
            @endforeach
        </div>
    </div>
@endsection
