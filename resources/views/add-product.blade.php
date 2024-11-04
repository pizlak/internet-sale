@extends('master')

@section('title', 'Добавление продукта')

@section('body')
    <div class="container mt-3">
        <h1>Добавление продукта</h1>
        <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input name="title" class="form-control form-control-lg" type="text"  value="{{ old('title') }}" placeholder="Введите название">
                @error('title')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1"  placeholder="Введите опиание" rows="3">{{ old('description') }}</textarea>
                @error('description')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input name="count" class="form-control form-control-lg" type="text" value="{{ old('count') }}" placeholder="Введите количество товара (шт.)">
                @error('count')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input name="price" class="form-control form-control-lg" type="text" value="{{ old('price') }}" placeholder="Введите цену товара (бел. руб.)">
                @error('price')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Добавьте изображение товара</label>
                <input name="image" class="form-control" type="file" id="formFile">
                @error('image')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Выбирите категорию</label>
                <select class="form-select form-select-lg mb-3" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Оформить</button>
            </div>
        </form>
    </div>
@endsection
