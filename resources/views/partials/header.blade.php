<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a class="navbar-brand" href="/">Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <div class="nav-item">
            <a class="nav-link" href="{{ route('shopping_cart') }}"><i class="fas
            fa-cart-plus"></i>
                Shopping
                Cart <span
                        class="badge badge-primary">{{ Session::has('cart') ? Session::get
                        ('cart')->totalQty : ''
                        }}</span></a>
        </div>
        <div class="dropdown">
            <i class="far fa-user"></i>
            <a class="dropdown-toggle" style="cursor: pointer"
                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                Account
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @auth
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById
                           ('logout-form').submit();"> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    <a class="dropdown-item" href="{{ route('userProfile') }}">Profile</a>
                    @else
                    <a class="dropdown-item" href="/login">Login</a>
                    <a class="dropdown-item" href="/register">Sign up</a>
                    @endif
            </div>
        </div>
        </div>
</nav>