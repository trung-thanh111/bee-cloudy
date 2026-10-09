@extends('fontend.home.layout')
@section('page_title')
    Trang Chủ
@endsection
@section('content')
    <div class="" id="app">
        <div class="container-fluid p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    @if ($bannerHome1)
                        @foreach ($bannerHome1 as $key => $valBannerHead)
                            @php
                                $image = json_decode($valBannerHead->album);
                                $totalImages = count($image);
                            @endphp
                            @if ($totalImages > 0)
                                @foreach ($image as $index => $valImgHead)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="5000">
                                        <img src="{{ $valImgHead }}"
                                            class="d-block w-100 object-fit-cover transition-opacity duration-500 ease-in-out"
                                            alt="Slide Image {{ $index + 1 }}" height="635" loading="lazy">
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

                <!-- Navigation Buttons -->
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
        <div class="container-fluid p-0" style="background-color:#fff">
            <div class="container policy py-5">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon bg-light rounded-circle p-3 me-3">
                                        <i class="fa-solid fa-medal fs-3 text-info"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-1">Sản phẩm độc quyền</h5>
                                        <p class="card-text text-muted mb-0 fz-14 ">Chất lượng đảm bảo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon bg-light rounded-circle p-3 me-3">
                                        <i class="fa-solid fa-box fs-3 text-info"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-1">Đóng gói chất lượng</h5>
                                        <p class="card-text text-muted mb-0 fz-14 ">An toàn & bảo vệ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon bg-light rounded-circle p-3 me-3">
                                        <i class="fa-solid fa-money-bill fs-3 text-info"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-1">Thanh toán dễ dàng</h5>
                                        <p class="card-text text-muted mb-0 fz-14 ">Nhiều phương thức</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon bg-light rounded-circle p-3 me-3">
                                        <i class="fa-solid fa-truck-fast fs-3 text-info"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-1">Miễn phí vận chuyển</h5>
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
            <div class="container newArrive mt-3">
                <div class="product-category p-2">
                    <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fs-5 text-uppercase mt-2">Sản phẩm mới ra mắt</h5>
                        <a href="{{ route('shop.index') }}">Xem tất cả</a>
                    </div>
                    <div class="content-product-cate row flex-wrap">
                        @if (count($productNew) != 0 && !empty($productNew))
                            @foreach ($productNew as $key => $productNew)
                                @php
                                    $shownColors = []; // Mảng để theo dõi các màu đã được hiển thị

                                    $promotion =
                                        $productNew->del != 0 && $productNew->del != null
                                            ? (($productNew->price - $productNew->del) / $productNew->price) * 100
                                            : '0';
                                    $price =
                                        $productNew->del != 0 && $productNew->del != null
                                            ? number_format($productNew->del, '0', ',', '.')
                                            : number_format($productNew->price, '0', ',', '.');
                                @endphp
                                <div class="col-lg-3 col-md-6 col-12 mb-4">
                                    <div class="card card-product shadow-sm border-0 mb-2 py-0">
                                        <div class="position-absolute z-1 w-100">
                                            <div class="head-card ps-0 d-flex justify-content-between">
                                                <span
                                                    class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $productNew->del == 0 || $productNew->del == null ? 'hidden-visibility' : '' }}">
                                                    giảm {{ round($promotion, 1) . '%' }}
                                                </span>
                                                <span class="text-end mt-2 me-2 text-muted toggleWishlist"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ in_array($productNew->id, $productInWishlist) ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' }}"
                                                    data-id="{{ $productNew->id }}">
                                                    <i
                                                        class="fa-{{ in_array($productNew->id, $productInWishlist) ? 'solid' : 'regular' }} fa-bookmark fz-16"></i>

                                                    <span class="product_id_wishlist d-none">
                                                        {{ $productNew->id }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="image-main-product position-relative">
                                            <a href="{{ route('product.detail', ['slug' => $productNew->slug]) }}">
                                                <img src="{{ $productNew->image }}" alt="product image" width="100%"
                                                    height="250" class="img-fluid object-fit-cover rounded-top-2"
                                                    style="height: 300px">
                                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                    <div class="hstack gap-3">
                                                        <div class="p-2 overflow-x-hidden">
                                                            <span
                                                                class="fz-12 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                                {{ $productNew->productCatalogues[0]->name }}
                                                            </span>
                                                        </div>
                                                        <div class="p-2 ms-auto">
                                                            <div class="product-image-color">
                                                                @foreach ($productNew->productVariant as $variant)
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
                                                <a href="{{ route('product.detail', ['slug' => $productNew->slug]) }}"
                                                    class="text-break w-100 text-muted">{{ $productNew->name }}</a>
                                            </h6>
                                            <div class="d-flex justify-content-start mb-2 ">
                                                <span class="text-danger fz-20 fw-medium me-3 product-variant-price"
                                                    data-price="{{ $price }}">{{ $price }}đ
                                                </span>
                                                <span class="mt-1 ">
                                                    <del
                                                        class="text-secondary fz-14 {{ $productNew->del == 0 && $productNew->del == null ? 'hidden-visibility' : '' }}">{{ number_format($productNew->price, '0', ',', '.') }}đ</del>
                                                </span>
                                            </div>
                                            <div class="box-action">
                                                <a href="{{ route('cart.index') }}"
                                                    class="action-cart-item-buy addToCart buyNow"
                                                    data-id="{{ $productNew->id }}">
                                                    <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                                    <span>Mua ngay</span>
                                                </a>
                                                <a href="" class="action-cart-item-add addToCart"
                                                    data-id="{{ $productNew->id }}">
                                                    <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                                    <span>thêm giỏ hàng</span>
                                                </a>
                                            </div>
                                            <div class="head-card d-flex p-1">
                                                <span class="fz-14 ">
                                                    Mã sản phẩm
                                                </span>
                                                <span class="ms-auto text-dark fw-500 fz-14">{{ $productNew->sku }}</span>
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
        <section class="homeCategory">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="category-item position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/image_17.webp"
                                class="img-fluid rounded" alt="Speakers">
                            <div class="category-text position-absolute bottom-0 start-0 text-white">
                                <h5 class="mb-0">Speakers</h5>
                                <p class="mb-0">6</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="category-item position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/image_17.webp"
                                class="img-fluid rounded" alt="Headphones">
                            <div class="category-text position-absolute bottom-0 start-0 text-white">
                                <h5 class="mb-0">Headphones</h5>
                                <p class="mb-0">3</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="category-item position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/image_17.webp"
                                class="img-fluid rounded" alt="Cameras">
                            <div class="category-text position-absolute bottom-0 start-0 text-white">
                                <h5 class="mb-0">Cameras</h5>
                                <p class="mb-0">5</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                        <div class="category-item position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/image_17.webp"
                                class="img-fluid rounded" alt="Accessories">
                            <div class="category-text position-absolute bottom-0 start-0 text-white">
                                <h5 class="mb-0">Accessories</h5>
                                <span class="mb-0">5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container plashSale">
                <div class="product-category p-2">
                    <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fs-5 text-uppercase mt-2">Ưu đãi chớp nhoáng</h5>
                        <p>Xem tất cả</p>
                    </div>
                    <div class="content-product-cate row flex-wrap">
                        <div class="col-lg-3 col-md-6 col-12 mb-4">
                            <div class="card card-product shadow-sm border-0 mb-2">
                                <div class="head-card d-flex px-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-2">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-4">
                            <div class="card card-product shadow-sm border-0 mb-2">
                                <div class="head-card d-flex px-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-2">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-4">
                            <div class="card card-product shadow-sm border-0 mb-2">
                                <div class="head-card d-flex px-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-2">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-4">
                            <div class="card card-product shadow-sm border-0 mb-2">
                                <div class="head-card d-flex px-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-2">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container promotion">
                <div class="product-category p-2">
                    <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fs-5 text-uppercase mt-2">Siêu khuyến mãi</h5>
                        <p>Xem tất cả</p>
                    </div>
                    <div class="content-product-cate row flex-wrap">
                        <div class="col-lg-3 col-md-6 col-12 mb-4">
                            <div class="card card-product shadow-sm border-0 mb-2">
                                <div class="head-card d-flex px-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-2">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-4">
                            <div class="card card-product shadow-sm border-0 mb-2">
                                <div class="head-card d-flex px-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-2">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-4">
                            <div class="card card-product shadow-sm border-0 mb-2">
                                <div class="head-card d-flex px-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-2">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-4">
                            <div class="card card-product shadow-sm border-0 mb-2">
                                <div class="head-card d-flex px-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-2">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="FULL_news">
            <div class="all_contents">
                <div class="form-title">
                    <template v-for="(v,k) in list">
                        <a :href="`/post/detail/${v.slug}`">
                            <span style="font-size: 22px;font-weight: 700;">Journal</span>
                            <div class="card_news">
                                <img class="img_news" v-bind:src="v.image" alt="">
                                <div class="text-news">
                                    <div class="first">
                                        <a style="color: #fff; font-size: 24px;font-weight: 600;flex-wrap: wrap;text-decoration: none;"
                                            href="">@{{ v.name }}</a>
                                    </div>
                                    <div class="end">
                                        <a style="color: #fff;  font-size: 13px; text-decoration: none;"
                                            href="">@{{ v.cre }}</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </template>
                </div>
                <div class="form-group">
                    <span style="font-size: 16px;font-weight: 700;float:right ;"> go to journal ____</span>
                    <div class="cart_all">
                        <template v-for="(v,k) in list_chil">
                            <div class="cart_one">
                                <a :href="`/post/detail/${v.slug}`">
                                    <div>
                                        <img class="card_img_one" v-bind:src="v.image" alt="">
                                    </div>
                                    <div class="form-end">
                                        <div>
                                            <a :href="`/post/detail/${v.slug}`" class="text"> @{{ v.name }}</a>
                                        </div>
                                        <div class="end">
                                            <a :href="`/post/detail/${v.slug}`" class="author"> @{{ v.cre }}</a>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </template>

                        {{-- <div class="cart_two">
                            <div>
                                <img class="card_img_two"
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSU63Bu5jU6z_65Rlxi6I-gTSUjrnaZwTIClg&s"
                                    alt="">
                            </div>
                            <div class="form-end">
                                <div>
                                    <a href="" class="text"> Samsung Galaxy watch5:what we want to see</a>
                                </div>
                                <div class="end">
                                    <a href="" class="author"> Sound Stories</a>

                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <a href="#" class="text-decoration-none back-to-top text-end position-fixed z-3 d-none"
                style="bottom: 60px; right: 30px;">
                <div class=" border-2 rounded-circle">
                    <i class="fa-solid fa-chevron-up fs-5 border-1 border-danger text-bg-secondary rounded-circle p-2"></i>
                </div>
            </a>
            <!-- <div class=" live-chat ms-lg-16">
                                                                                                                                                                                                                                                                                                                    <a href="zalo">
                                                                                                                                                                                                                                                                                                                        <img class="rounded-circle " src="public/image/zalo.png" alt="" width="50">
                                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                                </div> -->
        </div>
        <div class="">
            <a href="#" class="text-decoration-none back-to-top text-end position-fixed z-3 d-none"
                style="bottom: 60px; right: 30px;">
                <div class=" border-2 rounded-circle">
                    <i class="fa-solid fa-chevron-up fs-5 border-1 border-danger text-bg-secondary rounded-circle p-2"></i>
                </div>
            </a>
            <!-- <div class=" live-chat ms-lg-16">
                                                                                                                                                                                                                                                                                                                    <a href="zalo">
                                                                                                                                                                                                                                                                                                                        <img class="rounded-circle " src="public/image/zalo.png" alt="" width="50">
                                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                                </div> -->
        </div>
    </div>
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
