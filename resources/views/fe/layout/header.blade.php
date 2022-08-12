<header>
    {{-- Top header --}}
    <nav class="navbar navbar-expand-lg" id="header-title">
        <div class="container">
            <div>
                <p class="m-0">
                    <i class="fas fa-phone-alt"></i>
                    111-111-111 (Hours of Operation: 24/7)
                </p>
                <p class="m-0">
                    <i class="fas fa-envelope"></i>
                    <a href="">otakool@email.com</a>
                </p>
            </div>

            <div class="m-0 me-3 d-flex flex-row align-items-center">
                @guest('customer')
                    <a href="{{ Route('customer.login') }}">Login</a>
                    <span class="mx-2">|</span>
                    <a href="{{ Route('customer.register') }}">Create Account</a>
                @endauth
                @auth('customer')
                    <a href="{{ Route('customer.account') }}">
                        <i class="icon fa fa-user"></i> My Account
                    </a>
                @endauth

                @php
                    $hasCart = null;
                    if (Auth::guard('customer')->check()) {
                        $customer = Auth::guard('customer')->user();
                        $hasCart = App\Models\Order::where([['cust_id', $customer->id], ['status', 'cart']])->first();
                    }
                @endphp
                <a href="{{ Route('mycart') }}" class="cart-container fs-3">
                    <i class="fa fa-shopping-cart"></i>
                    @if (isset($hasCart))
                        <span class="notification fs-4">
                            <i class="fa fa-exclamation"></i>
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>
    {{-- /Top header --}}

    {{-- Nav bar --}}
    <nav class="navbar navbar-expand-lg" id="navbar-scroll">
        <div class="container">
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expand="false" aria-label="Toggle navigation">
                <i class="fas fa-bars fa-lg"></i>
            </button>

            <div class="collapse navbar-collapse md-4" id="navbarContent">
                <ul class="navbar-nav nav-justified align-items-center w-100 h-100 me-auto">
                    <li class="nav-item">
                        <a href="{{ route('index') }}" class="nav-link p-0">
                            <img src="{{ asset('images/logo/otakool-logo.png') }}" id="navbar-logo" alt="Otakool Logo">
                        </a>

                    </li>

                    <li class="nav-item my-auto">
                        <a href="{{ route('productShow', 'manga') }}" class="nav-link">MANGA</a>

                    </li>

                    <li class="nav-item my-auto">
                        <a href="{{ route('productShow', 'anime') }}" class="nav-link">ANIME</a>

                    </li>

                    <li class="nav-item my-auto">
                        <a href="{{ route('productShow', 'figures') }}" class="nav-link">FIGURES</a>

                    </li>

                    <li class="nav-item my-auto">
                        <a href="{{ route('productShow', 'merchandise') }}" class="nav-link">MERCHANDISE</a>

                    </li>

                    <li class="nav-item my-auto">
                        <a href="{{ route('promotion') }}" class="nav-link">PROMOTIONS</a>

                    </li>

                    <li class="nav-item my-auto">
                        <a href="{{ route('news') }}" class="nav-link">NEWS</a>

                    </li>
                </ul>
                <form class="d-flex my-2 ms-3" method="get" action="{{ route('search') }}">
                    <input class="form-control me-2" type="search" placeholder="Find products ..." name="query">
                    <button class="btn btn-outline-warning" type="submit">
                        <i class="fa fa-search-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    {{-- /Nav bar --}}

    <div id="nav-padding"></div>
</header>
