@extends('fontend.home.layout')
@section('page_title')
    Bee Cloudy
@endsection
@section('content')
    <div class="" id="app">
        <div class="container-fluid p-0 bg-white z-1">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if ($bannerHome1)
                        @foreach ($bannerHome1 as $key => $valBannerHead)
                            @php
                                $image = json_decode($valBannerHead->album);
                                $totalImages = count($image);
                            @endphp
                            @if ($totalImages > 0)
                                @foreach ($image as $index => $valImgHead)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $valImgHead }}"
                                            class="d-block w-100 object-fit-cover transition-opacity duration-500 ease-in-out"
                                            alt="Slide Image {{ $index + 1 }}" height="650">
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="carousel-indicators">
                    @if ($bannerHome1)
                        @foreach ($bannerHome1 as $valBannerHead)
                            @php
                                $image = json_decode($valBannerHead->album);
                            @endphp
                            @if (count($image) > 0)
                                @foreach ($image as $index => $valImgHead)
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}"
                                        style="width: 12px; height: 12px; border-radius: 50%; margin: 0 6px;">
                                    </button>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
                <button class="carousel-control-prev opacity-75 hover:opacity-100 transition-opacity duration-300"
                    type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next opacity-75 hover:opacity-100 transition-opacity duration-300"
                    type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="container-fluid p-0 bg-white">
            <div class="container policy py-5">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center flex-xl-row flex-column">
                                    <div class="feature-icon bg-light rounded-circle p-3 me-3 text-center text-xl-start">
                                        <i class="fa-solid fa-medal fs-3 text-info"></i>
                                    </div>
                                    <div class="d-none d-xl-block">
                                        <h5 class="card-title mb-1 text-muted">Sản phẩm độc quyền</h5>
                                        <p class="card-text text-muted mb-0 fz-14 ">Chất lượng đảm bảo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center flex-xl-row flex-column">
                                    <div class="feature-icon bg-light rounded-circle p-3 me-3 text-center text-xl-start">
                                        <i class="fa-solid fa-box fs-3 text-info"></i>
                                    </div>
                                    <div class="d-none d-xl-block">
                                        <h5 class="card-title mb-1 text-muted">Đóng gói chất lượng</h5>
                                        <p class="card-text text-muted mb-0 fz-14 ">An toàn & bảo vệ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center flex-xl-row flex-column">
                                    <div class="feature-icon bg-light rounded-circle p-3 me-3 text-center text-xl-start">
                                        <i class="fa-solid fa-money-bill fs-3 text-info"></i>
                                    </div>
                                    <div class="d-none d-xl-block">
                                        <h5 class="card-title mb-1 text-muted">Thanh toán dễ dàng</h5>
                                        <p class="card-text text-muted mb-0 fz-14 ">Nhiều phương thức</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center flex-xl-row flex-column">
                                    <div class="feature-icon bg-light rounded-circle p-3 me-3 text-center text-xl-start">
                                        <i class="fa-solid fa-truck-fast fs-3 text-info"></i>
                                    </div>
                                    <div class="d-none d-xl-block">
                                        <h5 class="card-title mb-1 text-muted">Miễn phí vận chuyển</h5>
                                        <p class="card-text text-muted mb-0 fz-14 ">Toàn quốc</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <div class="container p-3 pb-4 my-4 bg-white px-3 pt-3 rounded-2">
                <div class="title-product col-xl-2 col-lg-2 col-8 mb-3">
                    <div class="price-banner">
                        <div
                            class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                            <div class="price-icon">
                                <i class="fa-solid fa-fire text-white"></i>
                            </div>
                            <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                Danh mục
                            </h4>
                        </div>
                    </div>
                </div>
                <div id="thumbnail-carouselHome" class="splide category-slide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @if ($productCatalogues)
                                @foreach ($productCatalogues as $keyPCate => $valPCate)
                                    <li class="splide__slide">
                                        <a href="{{ route('product.category', ['id' => $valPCate->id]) }}">
                                            <div class="card card-cate shadow-sm border-0 carh-height-100 mb-3">
                                                <img src="{{ $valPCate->image }}" alt="product image" width="100%"
                                                    height="160" class=" rounded-top-3 object-fit-cover">
                                                <div class="card-body bg-light p-2 rounded-bottom-3">
                                                    <h5 class="fw-medium">
                                                        <a href="{{ route('product.category', ['id' => $valPCate->id]) }}"
                                                            class="text-break w-100 text-muted text-uppercase fz-16 fw-bold">
                                                            <span class="d-inline-block text-truncate"
                                                                style="max-width: 145px;">
                                                                {{ $valPCate->name }}
                                                            </span>
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container newArrive mt-3 px-3 pt-3 rounded-2 mb-4 flash-sale">
                <div class="product-category p-2 ">
                    <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                        <div class="title-product col-xl-3 col-lg-3 col-8 mb-3">
                            <div class="price-banner">
                                <div
                                    class="price-content border-start border-white rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                                    <div class="price-icon bg-white">
                                        <i class="fa-solid fa-bolt text-info"></i>
                                    </div>
                                    <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-white">
                                        Siêu Sale 
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-product-cate row flex-wrap">
                        @if (count($productSupperSales) != 0 && !empty($productSupperSales))
                            @foreach ($productSupperSales as $key => $productSupperSale)
                                @php
                                    $shownColors = []; // Mảng để theo dõi các màu đã được hiển thị

                                    $promotion =
                                        $productSupperSale->del != 0 && $productSupperSale->del != null
                                            ? (($productSupperSale->price - $productSupperSale->del) / $productSupperSale->price) * 100
                                            : '0';
                                    $price =
                                        $productSupperSale->del != 0 && $productSupperSale->del != null
                                            ? number_format($productSupperSale->del, '0', ',', '.')
                                            : number_format($productSupperSale->price, '0', ',', '.');
                                    //-- // lấy phiên bản đầu tiên của sản phẩm làm mặc định
                                    $variantFirst = $productSupperSale->productVariant->first();
                                @endphp
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="card card-product shadow-sm border-0 mb-2 py-0">
                                        <div class="position-absolute z-1 w-100">
                                            <div class="head-card ps-0 d-flex justify-content-between">
                                                <span
                                                    class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $productSupperSale->del == 0 || $productSupperSale->del == null ? 'hidden-visibility' : '' }}">
                                                    -  {{ round($promotion, 0) . '%' }}
                                                </span>
                                                <span class="text-end mt-2 me-2 text-muted toggleWishlist"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ in_array($productSupperSale->id, $productInWishlist) ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' }}"
                                                    data-id="{{ $productSupperSale->id }}">
                                                    <i
                                                        class="fa-{{ in_array($productSupperSale->id, $productInWishlist) ? 'solid' : 'regular' }} fa-bookmark fz-16"></i>

                                                    <span class="product_id_wishlist d-none">
                                                        {{ $productSupperSale->id }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="image-main-product position-relative">
                                            <a href="{{ route('product.detail', ['slug' => $productSupperSale->slug]) }}">
                                                <img src="{{ $productSupperSale->image }}" alt="product image" width="100%"
                                                    height="250" class="img-fluid object-fit-cover rounded-top-2"
                                                    style="height: 300px">
                                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                    <div class="hstack gap-3">
                                                        <div class="p-2 overflow-x-hidden">
                                                            <span
                                                                class="fz-12 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                                {{ $productSupperSale->productCatalogues[0]->name }}
                                                            </span>
                                                        </div>
                                                        <div class="p-2 ms-auto">
                                                            <div class="product-image-color">
                                                                @foreach ($productSupperSale->productVariant as $variant)
                                                                    @foreach ($variant->attributes as $attribute)
                                                                        @if ($attribute->attribute_catalogue_id == 1 && !in_array($attribute->name, $shownColors))
                                                                            <img src="{{ $attribute->image }}"
                                                                                alt="{{ $attribute->name }}"
                                                                                width="14" height="14"
                                                                                class="rounded-circle border border-2 border-info object-fit-cover me-1 ">
                                                                            @php
                                                                                // Đánh dấu màu này đã được hiển thị
                                                                                $shownColors[] = $attribute->name;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body p-2">
                                            <h6 class="fw-medium overflow-hidden " style="height: 39px">
                                                <a href="{{ route('product.detail', ['slug' => $productSupperSale->slug]) }}"
                                                    class="text-break w-100 text-muted">{{ $productSupperSale->name }}</a>
                                            </h6>
                                            <div class="d-flex justify-content-start mb-2 ">
                                                <span class="text-danger fz-20 fw-medium me-3 product-variant-price"
                                                    data-price="{{ $price }}">{{ $price }}đ
                                                </span>
                                                <span class="mt-1 ">
                                                    <del
                                                        class="text-secondary fz-14 {{ $productSupperSale->del == 0 && $productSupperSale->del == null ? 'hidden-visibility' : '' }}">{{ number_format($productSupperSale->price, '0', ',', '.') }}đ</del>
                                                </span>
                                            </div>
                                            <div class="box-action">
                                                <a href="{{ route('cart.index') }}"
                                                    class="action-cart-item-buy addToCart buyNow"
                                                    data-id="{{ $productSupperSale->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                                    <span>Mua ngay</span>
                                                </a>
                                                <a href="" class="action-cart-item-add addToCart"
                                                    data-id="{{ $productSupperSale->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                                    <span>thêm giỏ hàng</span>
                                                </a>
                                            </div>
                                            <div class="head-card d-flex p-1">
                                                <span class="fz-14 ">
                                                    Mã sản phẩm
                                                </span>
                                                <span class="ms-auto text-dark fw-500 fz-14">{{ $productSupperSale->sku }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="order-null p-3">
                                <div class="img-null text-center">
                                    <img src="/libaries/upload/images/order-null.png" alt="" class=""
                                        width="300" height="200">
                                </div>
                                <div class="flex flex-col text-center align-items-center">
                                    <h5 class="mb-2 fw-semibold">Hiện chưa có sản phẩm được sale!
                                    </h5>
                                    <a href="{{ route('shop.index') }}"
                                        class="btn btn-info text-white rounded-pill mt-3 pz-3">Quay lại</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container p-3 my-4 bg-white px-3 pt-3 rounded-2">
                <div class="title-product col-xl-2 col-lg-2 col-8 mb-3">
                    <div class="price-banner">
                        <div
                            class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                            <div class="price-icon">
                                <i class="fa-solid fa-fire text-white"></i>
                            </div>
                            <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                Thương hiệu
                            </h4>
                        </div>
                    </div>
                </div>
                <div id="thumbnail-carouselbrand" class="splide category-slide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @if ($brands)
                                @foreach ($brands as $keybBrand => $valbBrand)
                                    <li class="splide__slide">
                                        <a href="{{ route('product.brand', ['id' => $valbBrand->id]) }}">
                                            <div class="card border-0 carh-height-100 mb-3">
                                                <img src="{{ $valbBrand->image }}" alt="product image" width="160"
                                                    height="160" class="object-fit-contain rounded-circle border-info border border-3">
                                                <div class="card-body text-center p-2">
                                                    <h5 class="fw-medium">
                                                        <a href="{{ route('product.brand', ['id' => $valbBrand->id]) }}"
                                                            class="text-break w-100 text-muted text-uppercase fz-16 fw-bold">
                                                            <span class="d-inline-block text-truncate"
                                                                style="max-width: 145px;">
                                                                {{ $valbBrand->name }}
                                                            </span>
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container newArrive mt-3 bg-white px-3 pt-3 rounded-2 mb-4">
                <div class="product-category p-2">
                    <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                        <div class="title-product col-xl-3 col-lg-3 col-8 mb-3">
                            <div class="price-banner">
                                <div
                                    class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                                    <div class="price-icon">
                                        <i class="fa-solid fa-fire text-white"></i>
                                    </div>
                                    <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                        Sản phẩm mới
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('shop.index') }}">Xem tất cả</a>
                    </div>
                    <div class="content-product-cate row flex-wrap">
                        @if (count($productNew) != 0 && !empty($productNew))
                            @foreach ($productNew as $key => $productN)
                                @php
                                    $shownColors = []; // Mảng để theo dõi các màu đã được hiển thị

                                    $promotion =
                                        $productN->del != 0 && $productN->del != null
                                            ? (($productN->price - $productN->del) / $productN->price) * 100
                                            : '0';
                                    $price =
                                        $productN->del != 0 && $productN->del != null
                                            ? number_format($productN->del, '0', ',', '.')
                                            : number_format($productN->price, '0', ',', '.');
                                    //-- // lấy phiên bản đầu tiên của sản phẩm làm mặc định
                                    $variantFirst = $productN->productVariant->first();
                                @endphp
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="card card-product shadow-sm border-0 mb-2 py-0">
                                        <div class="position-absolute z-1 w-100">
                                            <div class="head-card ps-0 d-flex justify-content-between">
                                                <span
                                                    class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $productN->del == 0 || $productN->del == null ? 'hidden-visibility' : '' }}">
                                                    -  {{ round($promotion, 0) . '%' }}
                                                </span>
                                                <span class="text-end mt-2 me-2 text-muted toggleWishlist"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ in_array($productN->id, $productInWishlist) ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' }}"
                                                    data-id="{{ $productN->id }}">
                                                    <i
                                                        class="fa-{{ in_array($productN->id, $productInWishlist) ? 'solid' : 'regular' }} fa-bookmark fz-16"></i>

                                                    <span class="product_id_wishlist d-none">
                                                        {{ $productN->id }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="image-main-product position-relative">
                                            <a href="{{ route('product.detail', ['slug' => $productN->slug]) }}">
                                                <img src="{{ $productN->image }}" alt="product image" width="100%"
                                                    height="250" class="img-fluid object-fit-cover rounded-top-2"
                                                    style="height: 300px">
                                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                    <div class="hstack gap-3">
                                                        <div class="p-2 overflow-x-hidden">
                                                            <span
                                                                class="fz-12 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                                {{ $productN->productCatalogues[0]->name }}
                                                            </span>
                                                        </div>
                                                        <div class="p-2 ms-auto">
                                                            <div class="product-image-color">
                                                                @foreach ($productN->productVariant as $variant)
                                                                    @foreach ($variant->attributes as $attribute)
                                                                        @if ($attribute->attribute_catalogue_id == 1 && !in_array($attribute->name, $shownColors))
                                                                            <img src="{{ $attribute->image }}"
                                                                                alt="{{ $attribute->name }}"
                                                                                width="14" height="14"
                                                                                class="rounded-circle border border-2 border-info object-fit-cover me-1 ">
                                                                            @php
                                                                                // Đánh dấu màu này đã được hiển thị
                                                                                $shownColors[] = $attribute->name;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body p-2">
                                            <h6 class="fw-medium overflow-hidden " style="height: 39px">
                                                <a href="{{ route('product.detail', ['slug' => $productN->slug]) }}"
                                                    class="text-break w-100 text-muted">{{ $productN->name }}</a>
                                            </h6>
                                            <div class="d-flex justify-content-start mb-2 ">
                                                <span class="text-danger fz-20 fw-medium me-3 product-variant-price"
                                                    data-price="{{ $price }}">{{ $price }}đ
                                                </span>
                                                <span class="mt-1 ">
                                                    <del
                                                        class="text-secondary fz-14 {{ $productN->del == 0 && $productN->del == null ? 'hidden-visibility' : '' }}">{{ number_format($productN->price, '0', ',', '.') }}đ</del>
                                                </span>
                                            </div>
                                            <div class="box-action">
                                                <a href="{{ route('cart.index') }}"
                                                    class="action-cart-item-buy addToCart buyNow"
                                                    data-id="{{ $productN->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                                    <span>Mua ngay</span>
                                                </a>
                                                <a href="" class="action-cart-item-add addToCart"
                                                    data-id="{{ $productN->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                                    <span>thêm giỏ hàng</span>
                                                </a>
                                            </div>
                                            <div class="head-card d-flex p-1">
                                                <span class="fz-14 ">
                                                    Mã sản phẩm
                                                </span>
                                                <span class="ms-auto text-dark fw-500 fz-14">{{ $productN->sku }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="order-null p-3">
                                <div class="img-null text-center">
                                    <img src="/libaries/upload/images/order-null.png" alt="" class=""
                                        width="300" height="200">
                                </div>
                                <div class="flex flex-col text-center align-items-center">
                                    <h5 class="mb-2 fw-semibold">không có sản phẩm phù hợp với yêu cầu!
                                    </h5>
                                    <a href="{{ route('shop.index') }}"
                                        class="btn btn-info text-white rounded-pill mt-3 pz-3">Quay lại</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container plashSale mb-4 bg-white px-3 pt-3 rounded-2">
                <div class="product-category">
                    <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                        <div class="title-product col-xl-2 col-lg-2 col-8 mb-3">
                            <div class="price-banner">
                                <div
                                    class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                                    <div class="price-icon">
                                        <i class="fa-solid fa-fire text-white"></i>
                                    </div>
                                    <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                        Giá tốt
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('shop.index') }}">Xem tất cả</a>
                    </div>
                    <div class="content-product-cate row flex-wrap">
                        @if (count($productShopPriceMins) != 0 && !empty($productShopPriceMins))
                            @foreach ($productShopPriceMins as $key => $productPriceMin)
                                @php
                                    $shownColors = [];
                                    $promotion =
                                        $productPriceMin->del != 0 && $productPriceMin->del != null
                                            ? (($productPriceMin->price - $productPriceMin->del) /
                                                    $productPriceMin->price) *
                                                100
                                            : '0';

                                    $price =
                                        $productPriceMin->del != 0 && $productPriceMin->del != null
                                            ? number_format($productPriceMin->del, '0', ',', '.')
                                            : number_format($productPriceMin->price, '0', ',', '.');
                                    //-- // lấy phiên bản đầu tiên của sản phẩm làm mặc định
                                    $variantFirst = $productPriceMin->productVariant->first();
                                @endphp
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="card card-product shadow-sm border-0 mb-2 py-0">
                                        <div class="position-absolute z-1 w-100">
                                            <div class="head-card ps-0 d-flex justify-content-between">
                                                <span
                                                    class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $productPriceMin->del == 0 || $productPriceMin->del == null ? 'hidden-visibility' : '' }}">
                                                    -  {{ round($promotion, 0) . '%' }}
                                                </span>
                                                <span class="text-end mt-2 me-2 text-muted toggleWishlist"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ in_array($productPriceMin->id, $productInWishlist) ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' }}"
                                                    data-id="{{ $productPriceMin->id }}">
                                                    <i
                                                        class="fa-{{ in_array($productPriceMin->id, $productInWishlist) ? 'solid' : 'regular' }} fa-bookmark fz-16"></i>
                                                    <span class="product_id_wishlist d-none">
                                                        {{ $productPriceMin->id }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="image-main-product position-relative">
                                            <a href="{{ route('product.detail', ['slug' => $productPriceMin->slug]) }}">
                                                <img src="{{ $productPriceMin->image }}" alt="product image"
                                                    width="100%" height="250"
                                                    class="img-fluid object-fit-cover rounded-top-2"
                                                    style="height: 300px">
                                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                    <div class="hstack gap-3">
                                                        <div class="p-2 overflow-x-hidden">
                                                            <span
                                                                class="fz-12 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                                {{ $productPriceMin->productCatalogues[0]->name }}
                                                            </span>
                                                        </div>
                                                        <div class="p-2 ms-auto">
                                                            <div class="product-image-color">
                                                                @foreach ($productPriceMin->productVariant as $variant)
                                                                    @foreach ($variant->attributes as $attribute)
                                                                        @if ($attribute->attribute_catalogue_id == 1 && !in_array($attribute->name, $shownColors))
                                                                            <img src="{{ $attribute->image }}"
                                                                                alt="{{ $attribute->name }}"
                                                                                width="14" height="14"
                                                                                class="rounded-circle border border-2 border-info object-fit-cover me-1 ">
                                                                            @php
                                                                                // Đánh dấu màu này đã được hiển thị
                                                                                $shownColors[] = $attribute->name;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body p-2">
                                            <h6 class="fw-medium overflow-hidden " style="height: 39px">
                                                <a href="{{ route('product.detail', ['slug' => $productPriceMin->slug]) }}"
                                                    class="text-break w-100 text-muted">{{ $productPriceMin->name }}</a>
                                            </h6>
                                            <div class="d-flex justify-content-start mb-2 ">
                                                <span class="text-danger fz-20 fw-medium me-3 product-variant-price"
                                                    data-price="{{ $price }}">{{ $price }}đ
                                                </span>
                                                <span class="mt-1 ">
                                                    <del
                                                        class="text-secondary fz-14 {{ $productPriceMin->del == 0 && $productPriceMin->del == null ? 'hidden-visibility' : '' }}">{{ number_format($productPriceMin->price, '0', ',', '.') }}đ</del>
                                                </span>
                                            </div>
                                            <div class="box-action">
                                                <a href="{{ route('cart.index') }}"
                                                    class="action-cart-item-buy addToCart buyNow"
                                                    data-id="{{ $productPriceMin->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                                    <span>Mua ngay</span>
                                                </a>
                                                <a href="" class="action-cart-item-add addToCart"
                                                    data-id="{{ $productPriceMin->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                                    <span>thêm giỏ hàng</span>
                                                </a>
                                            </div>
                                            <div class="head-card d-flex p-1">
                                                <span class="fz-14 ">
                                                    Mã sản phẩm
                                                </span>
                                                <span
                                                    class="ms-auto text-dark fw-500 fz-14">{{ $productPriceMin->sku }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner mb-5">
                    @if ($bannerHome2)
                        @foreach ($bannerHome2 as $key => $valBannerHead)
                            @php
                                $image = json_decode($valBannerHead->album);
                                $totalImages = count($image);
                            @endphp
                            @if ($totalImages > 0)
                                @foreach ($image as $index => $valImgHead)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $valImgHead }}"
                                            class="d-block w-100 object-fit-cover transition-opacity duration-500 ease-in-out"
                                            alt="Slide Image {{ $index + 1 }}" height="650">
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="carousel-indicators">
                    @if ($bannerHome2)
                        @foreach ($bannerHome2 as $valBannerHead)
                            @php
                                $image = json_decode($valBannerHead->album);
                            @endphp
                            @if (count($image) > 0)
                                @foreach ($image as $index => $valImgHead)
                                    <button type="button" data-bs-target="#carouselExampleIndicators2"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}"
                                        style="width: 12px; height: 12px; border-radius: 50%; margin: 0 6px;">
                                    </button>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>

                <!-- Navigation Buttons -->
                <button class="carousel-control-prev opacity-75 hover:opacity-100 transition-opacity duration-300"
                    type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next opacity-75 hover:opacity-100 transition-opacity duration-300"
                    type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="container promotion bg-white px-3 pt-3 rounded-2 mb-4">
                <div class="product-category">
                    <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                        <div class="title-product mb-0 col-xl-3 col-lg-3 col-8 mb-3">
                            <div class="price-banner">
                                <div
                                    class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                                    <div class="price-icon">
                                        <i class="fa-solid fa-fire text-white"></i>
                                    </div>
                                    <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                        Khuyến mãi
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('shop.index') }}">Xem tất cả</a>
                    </div>
                    <div class="content-product-cate row flex-wrap">
                        @if (count($productSales) != 0 && !empty($productSales))
                            @foreach ($productSales as $key => $productSale)
                                @php
                                    $shownColors = []; // Mảng để theo dõi các màu đã được hiển thị

                                    $promotion =
                                        $productSale->del != 0 && $productSale->del != null
                                            ? (($productSale->price - $productSale->del) / $productSale->price) * 100
                                            : '0';
                                    $price =
                                        $productSale->del != 0 && $productSale->del != null
                                            ? number_format($productSale->del, '0', ',', '.')
                                            : number_format($productSale->price, '0', ',', '.');
                                    //-- // lấy phiên bản đầu tiên của sản phẩm làm mặc định
                                    $variantFirst = $productSale->productVariant->first();
                                @endphp
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
                                    <div class="card card-product shadow-sm border-0 mb-2 py-0">
                                        <div class="position-absolute z-1 w-100">
                                            <div class="head-card ps-0 d-flex justify-content-between">
                                                <span
                                                    class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $productSale->del == 0 || $productSale->del == null ? 'hidden-visibility' : '' }}">
                                                    -  {{ round($promotion, 0) . '%' }}
                                                </span>
                                                <span class="text-end mt-2 me-2 text-muted toggleWishlist"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ in_array($productSale->id, $productInWishlist) ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' }}"
                                                    data-id="{{ $productSale->id }}">
                                                    <i
                                                        class="fa-{{ in_array($productSale->id, $productInWishlist) ? 'solid' : 'regular' }} fa-bookmark fz-16"></i>

                                                    <span class="product_id_wishlist d-none">
                                                        {{ $productSale->id }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="image-main-product position-relative">
                                            <a href="{{ route('product.detail', ['slug' => $productSale->slug]) }}">
                                                <img src="{{ $productSale->image }}" alt="product image" width="100%"
                                                    height="250" class="img-fluid object-fit-cover rounded-top-2"
                                                    style="height: 300px">
                                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                    <div class="hstack gap-3">
                                                        <div class="p-2 overflow-x-hidden">
                                                            <span
                                                                class="fz-12 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                                {{ $productSale->productCatalogues[0]->name }}
                                                            </span>
                                                        </div>
                                                        <div class="p-2 ms-auto">
                                                            <div class="product-image-color">
                                                                @foreach ($productSale->productVariant as $variant)
                                                                    @foreach ($variant->attributes as $attribute)
                                                                        @if ($attribute->attribute_catalogue_id == 1 && !in_array($attribute->name, $shownColors))
                                                                            <img src="{{ $attribute->image }}"
                                                                                alt="{{ $attribute->name }}"
                                                                                width="14" height="14"
                                                                                class="rounded-circle border border-2 border-info object-fit-cover me-1 ">
                                                                            @php
                                                                                // Đánh dấu màu này đã được hiển thị
                                                                                $shownColors[] = $attribute->name;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body p-2">
                                            <h6 class="fw-medium overflow-hidden " style="height: 39px">
                                                <a href="{{ route('product.detail', ['slug' => $productSale->slug]) }}"
                                                    class="text-break w-100 text-muted">{{ $productSale->name }}</a>
                                            </h6>
                                            <div class="d-flex justify-content-start mb-2 ">
                                                <span class="text-danger fz-20 fw-medium me-3 product-variant-price"
                                                    data-price="{{ $price }}">{{ $price }}đ
                                                </span>
                                                <span class="mt-1 ">
                                                    <del
                                                        class="text-secondary fz-14 {{ $productSale->del == 0 && $productSale->del == null ? 'hidden-visibility' : '' }}">{{ number_format($productSale->price, '0', ',', '.') }}đ</del>
                                                </span>
                                            </div>
                                            <div class="box-action">
                                                <a href="{{ route('cart.index') }}"
                                                    class="action-cart-item-buy addToCart buyNow"
                                                    data-id="{{ $productSale->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                                    <span>Mua ngay</span>
                                                </a>
                                                <a href="" class="action-cart-item-add addToCart"
                                                    data-id="{{ $productSale->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                                    <span>thêm giỏ hàng</span>
                                                </a>
                                            </div>
                                            <div class="head-card d-flex p-1">
                                                <span class="fz-14 ">
                                                    Mã sản phẩm
                                                </span>
                                                <span
                                                    class="ms-auto text-dark fw-500 fz-14">{{ $productSale->sku }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="order-null p-3">
                                <div class="img-null text-center">
                                    <img src="/libaries/upload/images/order-null.png" alt="" class=""
                                        width="300" height="200">
                                </div>
                                <div class="flex flex-col text-center align-items-center">
                                    <h5 class="mb-2 fw-semibold">không có sản phẩm phù hợp với yêu cầu!
                                    </h5>
                                    <a href="{{ route('shop.index') }}"
                                        class="btn btn-info text-white rounded-pill mt-3 pz-3">Quay lại</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
    </section>
    <section>
        <div class="container my-4 bg-white py-3 rounded-2">
            <!-- Section Header -->
            <div class="title-product col-xl-3 col-lg-4 col-8 mb-4">
                <div class="price-banner">
                    <div
                        class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                        <div class="price-icon">
                            <i class="fa-solid fa-fire text-white"></i>
                        </div>
                        <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info w-100">
                            Phong cách phối đồ
                        </h4>
                    </div>
                </div>
            </div>
            <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true" data-bs-interval="3000">
                <div class="carousel-inner">
                    @if ($postHomes)
                        @foreach ($postHomes as $keyPostH => $valuePostH)
                            <div class="carousel-item {{ $keyPostH === 0 ? 'active' : '' }}">
                                <div class="mb-4">
                                    <div class="card border-0 shadow-sm rounded-4">
                                        <div class="row g-0">
                                            <div class="col-md-8 overflow-hidden">
                                                <img src="{{ $valuePostH->image }}"
                                                    class="w-100 object-fit-cover rounded-start-4"
                                                    alt="{{ $valuePostH->name }}" height="450">
                                            </div>
                                            <div class="col-md-4 d-flex align-items-center bg-light rounded-end-4">
                                                <div class="card-body py-2 px-3">
                                                    <div class="mb-3">
                                                        <span class="badge text-bg-dark rounded-pill px-3 py-2">
                                                            Nổi bật
                                                        </span>
                                                    </div>
                                                    <h3 class="display-6 fw-bold mb-3">{{ $valuePostH->name }}</h3>
                                                    <p class="text-muted mb-4">{{ $valuePostH->cre }}</p>
                                                    <a href="{{ route('post.detail', ['slug' => $valuePostH->slug]) }}"
                                                        class="btn btn-dark rounded-pill px-4">
                                                        Đọc bài
                                                        <i class="fa fa-arrow-right ms-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button class="carousel-control-prev ms-4" type="button" data-bs-target="#carouselExampleRide"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next me-4" type="button" data-bs-target="#carouselExampleRide"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Posts Grid Section -->
            <div class="row g-4">
                @if ($postHomeNews)
                    @foreach ($postHomeNews as $key => $valPostStand3)
                        @php
                            $created_atc3 = $valPostStand3->created_at;
                            $nowc3 = now();
                            $dayDifferc3 = date_diff($created_atc3, $nowc3)->format('%a ngày trước');

                            $authorc3 = optional($valPostStand3->users()->first());
                            $authorNamec3 = $authorc3->name ? $authorc3->name : $valPostStand3->cre;
                            $imageAuthorc3 =
                                $authorc3->image ??
                                '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif';
                        @endphp
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <a href="{{ route('post.detail', ['slug' => $valPostStand3->slug]) }}"
                                class="text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm rounded-3">
                                    <div class="overflow-hidden">
                                        <img src="{{ $valPostStand3->image }}" alt="{{ $valPostStand3->name }}"
                                            class="card-img-top object-fit-cover" style="height: 200px">
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold text-dark mb-3 text-truncate">
                                            {{ $valPostStand3->name }}
                                        </h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $imageAuthorc3 }}" alt="{{ $authorNamec3 }}"
                                                    class="rounded-circle me-2" width="30" height="30">
                                                <small class="text-muted">{{ $authorNamec3 }}</small>
                                            </div>
                                            <small class="text-muted">
                                                <i class="fa-regular fa-clock me-1"></i>
                                                {{ $dayDifferc3 }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                list: [],
                list_chil: [],
            },
            created() {
                this.LoadPost();
                this.LoadPost2();
            },
            methods: {
                LoadPost() {
                    axios
                        .get('/post-home/data')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                LoadPost2() {
                    axios
                        .get('/post-home/data-2')
                        .then((res) => {
                            this.list_chil = res.data.data;
                        });
                }
            },
        });
    </script>
@endsection
