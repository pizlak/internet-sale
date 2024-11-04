<nav class="navbar navbar-expand-lg bg-body-tertiary ms-5 me-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Интернет магазин</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Главная</a>
                </li>
                @auth()
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile', Auth::user()) }}">Личный кабинет</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('products.user', Auth::user()) }}">Мои товары</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('categories') }}">Категории</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('products') }}">Все продукты</a>
                </li>
            </ul>
            @guest()
                <div class="d-flex">
                    <a class="btn btn-primary" href="{{ route('register') }}">Зарегистрироваться</a>
                    <a class="btn btn-success ms-1" href="{{ route('login') }}">Войти</a>
                </div>
            @endguest
            @auth()
                <div class="d-flex">
                    <a class="btn btn-primary position-relative" href="{{ route('basket') }}">
                        Корзина
                        @if(!is_null(Auth::user()->orders()->where('status', 0)->first()))
                        <span class="position-absolute top-0 start-25 translate-middle badge rounded-pill bg-danger">
                            {{ App\Models\Order::getFullPrice(Auth::user()->orders()->where('status', 0)->first()) }} руб.
                        </span>
                        @endif
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="ms-3 btn btn-danger">Выйти</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
