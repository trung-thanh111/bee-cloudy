@extends('fontend.home.layout')
@section('page_title')
Trang Chủ
@endsection
@section('content')
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/image_17.webp" class="img-fluid rounded" alt="Speakers">
                    <div class="category-text position-absolute bottom-0 start-0 text-white">
                        <h5 class="mb-0">Speakers</h5>
                        <p class="mb-0">6</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="category-item position-relative">
                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/image_17.webp" class="img-fluid rounded" alt="Headphones">
                    <div class="category-text position-absolute bottom-0 start-0 text-white">
                        <h5 class="mb-0">Headphones</h5>
                        <p class="mb-0">3</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="category-item position-relative">
                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/image_17.webp" class="img-fluid rounded" alt="Cameras">
                    <div class="category-text position-absolute bottom-0 start-0 text-white">
                        <h5 class="mb-0">Cameras</h5>
                        <p class="mb-0">5</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="category-item position-relative">
                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/image_17.webp" class="img-fluid rounded" alt="Accessories">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                <!-- <div class="col-lg-5 col-md-6 col-12 mb-4">
                    <img src="libaries/images/banner-sub1.webp" class="img-fluid" alt="...">
                </div> -->
                <div class="col-lg-6 col-md-6 col-12 mb-4"></div>
                    <img src="libaries/images/banner-sub2.jpg" class="img-fluid" alt="...">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
                            <span class="ms-auto text-muted" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                <i class="fa-regular fa-bookmark fz-16"></i>
                            </span>
                        </div>
                        <div class="image-main-product position-relative">
                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%" height="250" class="img-fluid">
                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                <div class="hstack gap-3">
                                    <div class="p-2">
                                        <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                            nam</span>
                                    </div>
                                    <div class="p-2 ms-auto">
                                        <div class="product-image-color">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
                                            <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product" width="14" height="14" class="rounded-circle img-fluid me-1">
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
 <div class="">
    <a href="#" class="text-decoration-none back-to-top text-end position-fixed z-3 d-none"
        style="bottom: 60px; right: 30px;">
        <div class=" border-2 rounded-circle">
            <i
                class="fa-solid fa-chevron-up fs-5 border-1 border-danger text-bg-secondary rounded-circle p-2"></i>
        </div>
    </a>
    <!-- <div class=" live-chat ms-lg-16">
        <a href="zalo">
            <img class="rounded-circle " src="public/image/zalo.png" alt="" width="50">
        </a>
    </div> -->
</div>
@endsection