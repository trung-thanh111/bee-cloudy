@extends('fontend.home.layout')
@section('page_title')
TÌm kiếm
@endsection
@section('content')
<section>
    <article>
        <div class="container p-0">
            <!-- breadcrumb  -->
            <nav class="pt-3 pb-3" aria-label="breadcrumb">
                <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                    <li class="breadcrumb-item "><a href="#" class="text-decoration-none text-muted">Trang chủ </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
                </ol>
            </nav>
            <!-- end breadcrumb  -->
            <div class="" >
                <h4 class=" mt-4 mb-5 w-100">
                    Kết quả tìm kiếm của bạn về " <span class=" fs-4 fw-bold mb-3 text-uppercase text-truncate">{{ $keyword }} </span>"
                    <hr class=" border-4 border-info mb-2" style="width: 140px;">
                </h4>
            </div>
            <!-- content detail -->
            @if (count($resultSearchs) != 0 && !empty($resultSearchs))
            <div class="row mb-3 flex-wrap bg-white text-muted mx-0">
                <div class="col-lg-3 col-md-3 col-12 shadow-sm p-2 h-100">
                    <div class="filter-product-item">
                        <h6 class="text-uppercase fz-16 p-2">
                            lọc sản phẩm
                        </h6>
                        <form action="#" method="#">
                            <div class="accordion text-muted mb-1 rounded-2" id="default-accordion-example">
                                <div class="accordion-item material-shadow border-0">
                                    <button class="accordion-button px-2 py-2 fz-14 fw-500 " id="headingOne"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <span class="fz-16">Danh mục</span>

                                    </button>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                        <div class="accordion-body fz-14 pb-0">
                                            <ul class="ps-0">
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion text-muted mb-1 rounded-2" id="default-accordion-example">
                                <div class="accordion-item material-shadow border-0">
                                    <button class="accordion-button px-2 py-2 fz-14 fw-500 " id="headingTwo"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                        aria-expanded="true" aria-controls="collapseTwo">
                                        <span class="fz-16">Thương hiệu</span>

                                    </button>
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                        <div class="accordion-body fz-14 pb-0">
                                            <ul class="ps-0">
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                                <li class="list-unstyled mb-3">
                                                    <input type="checkbox" class="form-check-input me-2 mt-1 fz-16">
                                                    <a href="#" class=" text-muted fz-14 mt-1">Áo thun
                                                        nam</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion text-muted mb-1 rounded-2" id="default-accordion-example">
                                <div class="accordion-item material-shadow border-0">
                                    <button class="accordion-button px-2 py-2 fz-14 fw-500 " id="headingThree"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="true" aria-controls="collapseThree">
                                        <span class="fz-16">Kích thước</span>

                                    </button>
                                    <div id="collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                        <div class="accordion-body fz-14 pb-0">
                                            <ul class="ps-0 d-flex flex-wrap choose-size">
                                                <li class="list-unstyled mb-3 me-5 choose-size-item">
                                                    <input type="radio" class="form-check-input me-2 mt-1 fz-16" name="size">
                                                    <a href="#" class="text-uppercase text-muted fz-14 mt-1">s</a>
                                                </li>
                                                <li class="list-unstyled mb-3 me-5 choose-size-item">
                                                    <input type="radio" class="form-check-input me-2 mt-1 fz-16" name="size">
                                                    <a href="#" class="text-uppercase text-muted fz-14 mt-1">m</a>
                                                </li>
                                                <li class="list-unstyled mb-3 me-5 choose-size-item">
                                                    <input type="radio" class="form-check-input me-2 mt-1 fz-16" name="size">
                                                    <a href="#" class="text-uppercase text-muted fz-14 mt-1">l</a>
                                                </li>
                                                <li class="list-unstyled mb-3 me-5 choose-size-item">
                                                    <input type="radio" class="form-check-input me-2 mt-1 fz-16" name="size" checked>
                                                    <a href="#" class="text-uppercase text-muted fz-14 mt-1">xl</a>
                                                </li>
                                                <li class="list-unstyled mb-3 me-5 choose-size-item">
                                                    <input type="radio" class="form-check-input me-2 mt-1 fz-16" name="size">
                                                    <a href="#" class="text-uppercase text-muted fz-14 mt-1">2xl</a>
                                                </li>
                                            </ul>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion text-muted mb-1 rounded-2" id="default-accordion-example">
                                <div class="accordion-item material-shadow border-0">
                                    <button class="accordion-button px-2 py-2 fz-14 fw-500 " id="headingFor"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseFor"
                                        aria-expanded="true" aria-controls="collapseFor">
                                        <span class="fz-16">Màu sắc</span>

                                    </button>
                                    <div id="collapseFor" class="accordion-collapse collapse show"
                                        aria-labelledby="headingFor" data-bs-parent="#default-accordion-example">
                                        <div class="accordion-body fz-14 pb-0">
                                            <ul class="ps-0 ">
                                                <li class="list-unstyled d-flex justify-content-between flex-wrap  mb-lg-3 me-lg-4">
                                                    <div class="img-choose-color">
                                                        <img src="/libaries/images/green.png" alt="" width="30" height="30" class="img-fluid rounded-circle mb-md-1">
                                                    </div>
                                                    <div class="img-choose-color">
                                                        <img src="/libaries/images/green.png" alt="" width="30" height="30" class="img-fluid rounded-circle mb-md-1">
                                                    </div>
                                                    <div class="img-choose-color">
                                                        <img src="/libaries/images/green.png" alt="" width="30" height="30" class="img-fluid rounded-circle mb-md-1">
                                                    </div>
                                                    <div class="img-choose-color">
                                                        <img src="/libaries/images/green.png" alt="" width="30" height="30" class="img-fluid rounded-circle mb-md-1">
                                                    </div>
                                                    <div class="img-choose-color">
                                                        <img src="/libaries/images/green.png" alt="" width="30" height="30" class="img-fluid rounded-circle mb-md-1">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion text-muted mb-1 rounded-2" id="default-accordion-example">
                                <div class="accordion-item material-shadow border-0">
                                    <button class="accordion-button px-2 py-2 fz-14 fw-500 " id="headingFive"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="true" aria-controls="collapseFive">
                                        <span class="fz-16">Mức giá (đ)</span>
                                    </button>
                                    <div id="collapseFive" class="accordion-collapse collapse show"
                                        aria-labelledby="headingFive" data-bs-parent="#default-accordion-example">
                                        <div class="accordion-body fz-14 pb-0">
                                            <ul class="ps-0 d-flex flex-wrap">
                                                <li class="list-unstyled me-2 mb-4">
                                                    <a href="#" class=" box-item-choose-money fz-14 p-2">
                                                        0 - 200.000
                                                    </a>
                                                </li>
                                                <li class="list-unstyled me-2 mb-4">
                                                    <a href="#" class=" box-item-choose-money fz-14 p-2">
                                                        200 - 400.000
                                                    </a>
                                                </li>
                                                <li class="list-unstyled me-2 mb-4">
                                                    <a href="#" class=" box-item-choose-money fz-14 p-2">
                                                        200 - 400.000
                                                    </a>
                                                </li>
                                                <li class="list-unstyled me-2 mb-4">
                                                    <a href="#" class=" box-item-choose-money fz-14 p-2">
                                                        1M - 1.4M
                                                    </a>
                                                </li>
                                                <li class="list-unstyled me-2 mb-4">
                                                    <a href="#" class=" box-item-choose-money fz-14 p-2">
                                                        200 - 400.000
                                                    </a>
                                                </li>
                                                <li class="list-unstyled me-2 mb-4">
                                                    <a href="#" class=" box-item-choose-money fz-14 p-2">
                                                        200 - 400.000
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-12 ">
                    <div class="product-category p-2">
                        <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fs-5 text-uppercase mt-2">Sản phẩm</h5>
                        </div>
                        <div class="content-product-cate row flex-wrap">
                            
                                    @foreach ($resultSearchs as $key => $product)
                                        @php
                                            $shownColors = []; // Mảng để theo dõi các màu đã được hiển thị

                                            $promotion =
                                                $product->del != 0 && $product->del != null
                                                    ? (($product->price - $product->del) / $product->price) * 100
                                                    : '0';

                                            $price = ($product->del != 0 && $product->del != null) ?number_format($product->del, '0', ',', '.') : number_format($product->price, '0', ',', '.')
                                        @endphp
                                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                                            <div class="card card-product shadow-sm border-0 mb-2 pt-0">
                                                <div class="position-absolute z-1 w-100">
                                                    <div class="head-card ps-0 d-flex justify-content-between">
                                                        <span
                                                            class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $product->del == 0 || $product->del == null ? 'hidden-visibility' : '' }}">
                                                            giảm {{ round($promotion, 1) . '%' }}
                                                        </span>
                                                        <span class="text-end mt-2 me-2 text-muted"
                                                            data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                                                            <i class="fa-regular fa-bookmark fz-16"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="image-main-product position-relative">
                                                    <img src="{{ $product->image }}" alt="product image" width="100%"
                                                        height="250" class="img-fluid object-fit-cover rounded-top-2"
                                                        style="height: 300px">
                                                    <div
                                                        class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                        <div class="hstack gap-3">
                                                            <div class="p-2 overflow-x-hidden w-50">
                                                                <span
                                                                    class="fz-14 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                                    @foreach ($product->productCatalogues as $catalogue)
                                                                        {{ $catalogue->name }}
                                                                    @endforeach
                                                                </span>
                                                            </div>
                                                            <div class="p-2 ms-auto">
                                                                <div class="product-image-color">
                                                                    @foreach ($product->productVariant as $variant)
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
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="fw-medium overflow-hidden " style="height: 35px">
                                                        <a href="#"
                                                            class="text-break w-100 text-muted">{{ $product->name }}</a>
                                                    </h6>
                                                    <div class="d-flex justify-content-start mb-2 ">
                                                        <span
                                                            class="text-danger fz-20 fw-medium me-3 product-variant-price" data-price="{{ $price }}">{{ $price }}đ 
                                                        </span>
                                                        <span
                                                            class="mt-1 ">
                                                            <del
                                                                class="text-secondary fz-14 {{ $product->del == 0 && $product->del == null ? 'hidden-visibility' : '' }}">{{ number_format($product->price, '0', ',', '.') }}đ</del>
                                                        </span>
                                                    </div>
                                                    <div class="box-action">
                                                        <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="action-cart-item-buy">
                                                            <span>Xem chi tiết</span>
                                                        </a>
                                                        <a href="#" class="action-cart-item-add addToCart" data-id="{{ $product->id }}">
                                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                                            <span>thêm giỏ hàng</span>
                                                        </a>
                                                    </div>
                                                    <div class="head-card d-flex p-1">
                                                        <span class="fz-14 ">
                                                            Mã sản phẩm
                                                        </span>
                                                        <span class="ms-auto text-dark fw-500 fz-14">{{ $product->sku }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach   
                        </div>
                    </div>
                    <div class="d-flex justify-content-end pagination pagination-sm">
                        {{ $resultSearchs->appends(request()->except('page'))->onEachSide(3)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            @else 
            <h5 class="text-center fs-2 py-5">Không có bản ghi phù hợp.</h5>
            @endif
        </div>
    </article>
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