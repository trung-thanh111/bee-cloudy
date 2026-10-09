@extends('fontend.home.layout')
@section('page_title')
Trang Chủ
@endsection
@section('content')
<div class="" id="app">
    <div class="container-fluid p-0">
        <img src="/libaries/templates/bee-cloudy-user/libaries/images/mainbanner.jpg" class="img-fluid" alt="...">
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
                                    <p class="card-text text-muted mb-0 fz-14">Chất lượng đảm bảo</p>
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
                                    <p class="card-text text-muted mb-0 fz-14">An toàn & bảo vệ</p>
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
                                    <p class="card-text text-muted mb-0 fz-14">Nhiều phương thức</p>
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
                                    <p class="card-text text-muted mb-0 fz-14">Toàn quốc</p>
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
        <div class="sub-banner my-5">
            <div class="container-fluid p-0">
                <div class="row">
                    {{-- <div class="col-lg-5 col-md-6 col-12 mb-4">
                        <img src="/libaries/templates/bee-cloudy-user/libaries/images/banner-sub1.webp" class="img-fluid" alt="...">
                    </div> --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-4"></div>
                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/banner-sub2.jpg" class="img-fluid"
                        alt="...">
                </div>
            </div>
        </div>
        {{-- </div> --}}
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