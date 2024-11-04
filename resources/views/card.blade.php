<div class="col">
    <div class="card shadow-sm">
        <div class="bd-placeholder-img card-img-top" style="width: 100%; height: 200px; overflow: hidden;">
            <a href="{{ route('product.show', $product->id) }}">
                <img class="w-100" src="{{ asset('storage/'. $product->image) }}" alt=""
                     style="height: 100%; object-fit: cover;">
            </a>
        </div>
        <div class="card-body">
            <h3 class="card-text">
                <a href="{{ route('product.show', $product->id) }}">
                    {{ $product->title }}
                </a>
            </h3>
            <p class="card-text">{{ $product->price }} бел. руб.</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    @auth()
                        @if($product->user_id !== Auth::user()->id)
                            <form action="{{ route('product.add', $product) }}" method="POST">
                                @csrf
                                <button class="btn btn-success">В корзину</button>
                            </form>
                        @endif
                    @endauth
                    <a class="btn btn-secondary" href="{{ route('product.show', $product->id) }}">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
</div>
