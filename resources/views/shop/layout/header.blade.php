<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">0987654321</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">example@example.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">Giao hàng 3-5 ngày làm việc & Trả lại miễn phí</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="/">Plaything</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Danh mục sản phẩm</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
{{--                        @foreach($catalogs as $catalog)--}}
{{--                        <a class="dropdown-item" href="shop.html">{{ $catalog->getCatalogName() }}</a>--}}
{{--                        @endforeach--}}
                    </div>
                </li>
                <li class="nav-item">
                    <div class="sb-example-3">
                        <div class="search__container">
                            <form action="{{ route("shop.product.list") }}" method="GET">
                                <input class="search__input" type="text" name="product_name" placeholder="Tìm kiếm">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav">
                <li class="nav-item active"><a href="{{ route("home") }}" class="nav-link">Trang chủ</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Giới thiệu</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Tin Tức</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Liên hệ</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" style="font-size: 14px"><span class="icon-user-plus"></span></a></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown05">
                        <a class="dropdown-item" href="{{ Auth::guard("web")->check() ? route("home") : route("login") }}">Tài khoản</a>
                        <a class="dropdown-item" href="{{ Auth::guard("web")->check() ? route("home") : route("login") }}">Kiểm tra đơn hàng</a>
                        @if(Auth::guard("web")->check())
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Đăng xuất</a>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <a class="dropdown-item" href="{{ route("login") }}">Đăng nhập</a>
                        @endif
                    </div>
                </li>
                <li class="nav-item cta cta-colored"><a href="{{ route('cart.list') }}" class="nav-link" style="font-size: 14px"><span class="icon-shopping_cart"></span>[0]</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
