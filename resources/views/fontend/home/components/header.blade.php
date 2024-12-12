<section>
    <header>
        <div class="container-fuild text-bg-dark">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center p-2 fz-15">
                    <div class="splide" id="promo-carousel">
                        <div class="splide__track">
                            <ul class="splide__list fz-14">
                                @if (Auth::check())
                                    <li class="splide__slide text-truncate">
                                        <span>Nhiều khuyến mãĩ hấp dẫn đang chờ đợi bạn </span>
                                    </li>
                                    <li class="splide__slide text-truncate">
                                        <span>Miễn phí vận chuyển cho đơn hàng trên 300.000đ</span>
                                    </li>
                                    <li class="splide__slide text-truncate">
                                        <span>Giảm 20% khi thanh toán qua thẻ</span>
                                    </li>
                                @else
                                    <li class="splide__slide text-truncate">
                                        <span>Giảm giá 10% cho đơn hàng đầu tiên</span>
                                    </li>
                                    <li class="splide__slide text-truncate">
                                        <span>Miễn phí vận chuyển toàn quốc khi mua đơn hàng trên 300.000đ</span>
                                    </li>
                                    <li class="splide__slide text-truncate">
                                        <span>Rất nhiều voucher đang chờ bạn, đừng bỏ lỡ chúng.</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="search-final">
                        <form action="{{ route('search') }}" method="get" class="app-search d-none d-md-block ">
                            <div class="input-group input-group-sm w-100 position-relative">
                                <input type="text" id="keyword" name="keyword"
                                    class="form-control search-header py-0" placeholder="Bạn đang cần gì?"
                                    value="{{ old('keyword') }}">
                                <input type="hidden" name="type" value="product">
                                <button type="submit" class="input-group-text" id="inputGroup-sizing-sm">
                                    <i class='bx bx-search-alt-2'></i>
                                </button>
                            </div>
                            <div class="position-relative">
                                <div
                                    class="wallpaper d-none position-absolute start-50 translate-middle z-3 card-height-100">
                                    <div class="card card-height-100 p-2 border-0 rounded-1 shadow-sm justify-content-center"
                                        style="width: 500px !important">
                                        <div class="card-body py-2 px-2">
                                            <div class="title-search-recent">
                                                <h6 class="text-overflow text-muted mb-0 text-uppercase fz-13">Sản phẩm
                                                    mới</h6>
                                            </div>
                                            <div class="content-search-recent mt-3">
                                                @if ($nameStand->isNotEmpty())
                                                    @foreach ($nameStand as $key => $keywordStand)
                                                        <span
                                                            class="search-recent-item search-item m-1 fz-14 text-truncate"
                                                            style="max-width: 200px">
                                                            <a href="javascript:void(0)"
                                                                class="text-decoration-none text-muted">
                                                                <i class='bx bx-search-alt-2 fz-16 me-2'></i>
                                                                <span
                                                                    class="keyword-recent ">{{ $keywordStand->name }}</span>
                                                            </a>
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body list-search d-none py-2 px-2">
                                            <div class="title-search-recent">
                                                <h6 class="text-overflow text-muted mb-0 text-uppercase fz-13">Danh sách
                                                    tìm kiếm</h6>
                                            </div>
                                            <div class="content-search-hot mt-3 d-block overflow-y-auto"
                                                style="max-height: 100px">
                                                <ul id="suggestions-list" class="list-unstyled">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="fw-medium d-none d-lg-block">
                        <a href="{{ route('shop.index') }}" class="text-white">Cửa hàng</a>
                        <span class="ms-2">Hotline: <a href="tel:0900112583">0900112583</a></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
</section>
<section>
    <header>
        <div class="container-fuild">
            <nav class="navbar navbar-expand-lg shadow-sm bg-white p-0 sticky-nav">
                <div class="container p-0">
                    <a class="navbar-brand" href="{{ route('home.index') }}">
                        <img src="/libaries/upload/images/logo/logo_index.png" class="object-fit-contain logo-index"
                            alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-lg-center justify-content-md-center justify-content-sm-start"
                        id="navbarSupportedContent">
                        <ul
                            class="nav fw-bold justify-content-lg-center justify-content-md-center justify-content-sm-start align-items-center text-color">
                            <li class=" px-2 py-3">
                                <a href="{{ route('home.index') }}"
                                    class=" menu-item-a text-uppercase text-decoration-none fz-16 {{ request()->routeIs('home.index') ? 'active' : '' }}">Trang
                                    chủ</a>
                            </li>
                            <li class="menu-li-item px-2 py-3 dropdown align-items-center">
                                <a href="{{ route('shop.index') }}"
                                    class="menu-item-a text-uppercase text-decoration-none fz-16 dropdown-a {{ request()->segment(1) === 'product' || request()->segment(1) === 'shop' ? 'active' : '' }}">Cửa
                                    hàng <i class="fas fa-minus fz-12 fw-bold"></i></a>
                                <ul class="ul-menu-header p-0 dropdown-content list-unstyled">
                                    @if ($productCategories)
                                        @foreach ($productCategories as $keyPCate => $productCate)
                                            <li
                                                class="nav-item li-menu-header {{ $productCate->childrenReference->isNotEmpty() ? 'menu-item-v2' : '' }} position-relative">
                                                <a href="{{ route('product.category', ['id' => $productCate->id]) }}"
                                                    class="d-flex justify-content-between align-items-center position-relative ">
                                                    <span class="nav-link menu-link p-0 text-muted">
                                                        <span>{{ $productCate->name }}</span>
                                                    </span>
                                                    <i
                                                        class="fa-solid fa-chevron-right fz-12 text-muted {{ $productCate->childrenReference->isEmpty() ? 'd-none' : '' }}"></i>
                                                </a>
                                                <div
                                                    class="menu-dropdown-v2 position-absolute start-100 top-0 p-0 shadow-sm w-100">
                                                    <ul class="menu-link p-0 list-unstyled">
                                                        @if ($productCate->childrenReference->isNotEmpty())
                                                            @foreach ($productCate->childrenReference as $keyChild => $valChild)
                                                                <li
                                                                    class="nav-item li-menu-header position-relative ps-2 menu-item-v2">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center px-1 position-relative">
                                                                        <a class="nav-link menu-link p-0 menu-item-v3"
                                                                            href="{{ route('product.category', ['id' => $valChild->id]) }}">
                                                                            <span>{{ $valChild->name }}</span>
                                                                        </a>
                                                                        {{-- <i
                                                                        class="fa-solid fa-chevron-right fz-12 text-muted"></i> --}}
                                                                    </div>
                                                                    {{-- <div
                                                            class="menu-dropdown-v3 position-absolute start-100 top-0 p-0 shadow-sm w-100">
                                                            <ul class="menu-link p-0 list-unstyled">
                                                                <li
                                                                    class="nav-item li-menu-header position-relative ps-2 menu-item-v3">
                                                                    <a href="#" class="nav-link menu-link p-0">Quản
                                                                        lý</a>
                                                                </li>
                                                            </ul>
                                                        </div> --}}
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li
                                        class="nav-item li-menu-header menu-item-v2 {{ $brandHeaders == null ? 'd-none' : '' }} position-relative">
                                        <a href="javascript:void(0)"
                                            class="d-flex justify-content-between align-items-center px-1 position-relative ">
                                            <span class="nav-link menu-link p-0  text-muted">
                                                <span>Thương hiệu</span>
                                            </span>
                                            <i class="fa-solid fa-chevron-right fz-12 text-muted"></i>
                                        </a>
                                        <div
                                            class="menu-dropdown-v2 position-absolute start-100 top-0 p-0 shadow-sm w-100">
                                            <ul class="menu-link p-0 list-unstyled">
                                                @if ($brandHeaders)
                                                    @foreach ($brandHeaders as $keyBrand => $valBrand)
                                                        <li
                                                            class="nav-item li-menu-header position-relative ps-2 menu-item-v2">
                                                            <a href="{{ route('product.brand', ['id' => $valBrand->id]) }}"
                                                                class="d-flex justify-content-between align-items-center px-1 position-relative">
                                                                <span
                                                                    class="nav-link menu-link p-0 menu-item-v3 text-muted">
                                                                    {{ $valBrand->name }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-li-item px-2 py-3 align-items-center position-relative">
                                <a href="{{ route('post.page') }}"
                                    class="menu-item-a text-uppercase text-decoration-none fz-16 {{ request()->segment(1) === 'post' ? 'active' : '' }}">Bài
                                    viết
                                    <i class="fa-solid fa-minus fz-12 fw-bold"></i>
                                </a>
                                <ul class="ul-menu-header p-0 dropdown-content list-unstyled">
                                    @if ($postCatalogueHeaders)
                                        @foreach ($postCatalogueHeaders as $keyPostCate => $valPostCate)
                                            <li class="nav-item li-menu-header">
                                                <a href="{{ route('post.category', ['id' => $valPostCate->id]) }}"
                                                    class="d-flex justify-content-between align-items-center px-1">
                                                    <span class="nav-link menu-link p-0 text-muted">
                                                        {{ $valPostCate->name }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>

                            <li class="menu-li-item px-2 py-3">
                                <a href="{{ route('home.contact') }}"
                                    class="menu-item-a text-uppercase text-decoration-none fz-16 {{ request()->is('contact') ? 'active' : '' }}">Liên
                                    hệ</a>
                            </li>
                            <li class="menu-li-item px-2 py-3 dropdown align-items-center">
                                <a href="#"
                                    class="menu-item-a text-uppercase text-decoration-none fz-16 dropdown-a {{ request()->is('about_us') || request()->is('promotion') || request()->is('faq') || request()->is('terms_and_conditions') || request()->is('return_and_warranty_policy') || request()->is('security_center') || request()->is('profile') || request()->is('cart/index') || request()->is('wishlist/index') ? 'active' : '' }}">Trang
                                    khác <i class="fas fa-minus fz-12 fw-bold"></i></a>
                                <ul class="ul-menu-header p-0 dropdown-content">
                                    <li class="li-menu-header">
                                        <a href="{{ route('home.about_us') }}"
                                            class="text-decoration-none fz-16 text-color">Giới thiệu</a>
                                    </li>
                                    <li class="li-menu-header">
                                        <a href="{{ route('promotion.home_index') }}"
                                            class="text-decoration-none fz-16 text-color">Khuyến mãi</a>
                                    </li>
                                    <li class="li-menu-header">
                                        <a href="{{ route('home.faq') }}"
                                            class="text-decoration-none fz-16 text-color">Câu hỏi thường gặp</a>
                                    </li>
                                    <li class="li-menu-header">
                                        <a href="{{ route('home.terms_and_conditions') }}"
                                            class="text-decoration-none fz-16 text-color">Điều khoản</a>
                                    </li>
                                    <li class="li-menu-header">
                                        <a href="{{ route('home.return_and_warranty_policy') }}"
                                            class="text-decoration-none fz-16 text-color">Chính sách</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex icon-header align-items-center">
                        <div class="icon-item">
                            <span class="box-icon-profile">
                                <a href="{{ route('wishlist.index') }}" type="button">
                                    <i class="fa-solid fa-bookmark" data-bs-toggle="tooltip"
                                        data-bs-title="Yêu thích"></i>
                                </a>
                            </span>
                        </div>
                        
                        <div class="icon-item">
                            <span class="box-icon-profile">
                                <a href="{{ route('cart.index') }}" type="button"
                                    class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle">
                                    <i class="fa-solid fa-cart-shopping fz-16" data-bs-toggle="tooltip"
                                        data-bs-title="Giỏ hàng"></i>
                                    <span
                                        class="position-absolute topbar-badge fs-10 translate-middle badge count-element rounded-pill bg-info {{ $productInCart == 0 ? 'hidden-visibility' : '' }}">{{ !is_null($productInCart) ? $productInCart : '' }}</span>
                                </a>
                            </span>
                        </div>
                        <div class="icon-item dropdown">
                            <!-- đã đăng nhập  -->
                            @if (Auth::check())
                                @php
                                    $user = Auth::user();
                                @endphp
                                <button type="button" class="btn border-0 dropdown-toggle "
                                    data-bs-toggle="dropdown">
                                    <span class="d-flex align-items-center">
                                        <img class="rounded-circle header-profile-user"
                                            src="{{ $user->image != null ? $user->image : '/libaries/upload/images/user-default.avif' }}"
                                            alt="Avatar User" class="rounded-circle object-fit-cover" width="40"
                                            height="40">
                                    </span>
                                </button>
                                <div class="rounded-1 shadow-sm dropdown-menu dropdown-menu-end border-0 "
                                    style="min-width: 180px;">
                                    <ul class="ul-menu p-0 mb-1 text-muted z-3">
                                        <li class="list-unstyled p-2">
                                            <span class="text-decoration-none fw-medium fz-14 ps-1">
                                                Xin chào {{ $user->name }}!
                                            </span>
                                        </li>
                                        <li class="li-menu-header p-2">
                                            <a href="{{ route('profile.user') }}"
                                                class="text-decoration-none fz-13 text-muted"
                                                style="padding-left:2px ">
                                                <i class="fa-solid fa-user p-0 me-2"></i>Thông tin cá nhân
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-2">
                                            <a href="{{ route('cart.index') }}"
                                                class="text-decoration-none fz-13 text-muted">
                                                <i class="fa-solid fa-cart-shopping p-0 me-2"></i>Giỏ hàng
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-2">
                                            <a href="{{ route('wishlist.index') }}"
                                                class="text-decoration-none fz-13 ps-1 text-muted">
                                                <i class="fa-solid fa-bookmark p-0 me-2"></i>Yêu thích
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-2">
                                            <a href="{{ route('promotion.home_index') }}"
                                                class="text-decoration-none fz-13 ps-1 text-muted">
                                                <i class="fa-solid fa-tags p-0 me-2"></i>Khuyến mãi
                                            </a>
                                        </li>
                                        @if ($user->user_catalogue_id == 2)
                                            <li class="li-menu-header p-2">
                                                <a href="{{ route('dashboard.index') }}"
                                                    class="text-decoration-none fz-13 ps-1">
                                                    <i class="fa-solid fa-user-gear me-2"></i>Quản trị Website
                                                </a>
                                            </li>
                                        @endif
                                        <hr>
                                        <li class="li-menu-header p-2">
                                            <a href="{{ route('auth.logout') }}"
                                                class="text-decoration-none fz-13 ps-1 text-danger">
                                                <i
                                                    class="fa-solid fa-arrow-right-from-bracket me-2 text-danger"></i>Đăng
                                                xuất
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            @else
                                <!-- chưa đăng nhập  -->
                                <span class="box-icon-profile">
                                    <a class="acount-profile" href="{{ route('auth.login') }}">
                                        <i class="fa-solid fa-user fz-20 p-3" data-bs-toggle="tooltip"
                                            data-bs-title="đăng nhập"></i>
                                    </a>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</section>
<script>
    window.productInWishlist = @json($productInWishlist)
</script>
