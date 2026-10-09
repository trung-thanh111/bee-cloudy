@extends('fontend.home.layout')
@section('page_title')
    Thương hiệu
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="{{ route('home.index') }}"
                                class="text-decoration-none text-muted">Trang Chủ</a>
                        </li>
                        <li class="breadcrumb-item "><a href="{{ route('shop.index') }}"
                                class="text-decoration-none text-muted">Cửa hàng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thương hiệu</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <!-- content detail -->
                <div
                    class="main-product-category row flex-wrap text-muted pt-3 mx-0 bg-main-color shadow-sm rounded-1 mb-5">
                    <div class="col-lg-4 col-md-4 col-12 position-relative" style="height: 300px">
                        <div class="title-category position-absolute top-50 w-75 translate-middle" style="left: 50%;">
                            <h3 class="text-uppercase">{{ $brand->name }}</h3>
                            <p class="fz-14">{!! $brand->description !!}</p>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div id="thumbnail-carousel2" class="splide category-slide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @if ($brandAll)
                                        @foreach ($brandAll as $keyB => $valB)
                                            <li class="splide__slide">
                                                <a href="{{ route('product.category', ['id' => $valB->id]) }}">
                                                    <div class="card card-cate shadow-sm border-0 carh-height-100 mb-3">
                                                        <img src="{{ $valB->image }}" alt="product image" width="100%"
                                                            height="160" class=" rounded-top-3 object-fit-cover">
                                                        <div class="card-body bg-light p-2 rounded-bottom-3">
                                                            <h5 class="fw-medium">
                                                                <a href="{{ route('product.category', ['id' => $valB->id]) }}"
                                                                    class="text-break w-100 text-muted text-uppercase fz-16 fw-bold">{{ $valB->name }}</a>
                                                            </h5>
                                                            <div class="catagory-item-text">
                                                                <span
                                                                    class="d-inline-block text-muted fz-14 truncate-custom">
                                                                    {!! $valB->description !!}
                                                                </span>
                                                            </div>
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

                </div>
                <div class="row mb-3 flex-wrap bg-white text-muted mx-0">
                    <div class="col-lg-3 col-md-3 col-12 shadow-sm p-2 h-100">
                        <div class="filter-product-item">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-uppercase fz-16 p-2">
                                    Lọc sản phẩm
                                </h6>
                                <a href="{{ route('product.brand', ['id' => request('id')]) }}" class="fz-14 text-danger">Bỏ
                                    lọc</a>
                            </div>
                            <form>
                                <div class="accordion text-muted mb-1 rounded-2" id="default-accordion-example">
                                    <div class="accordion-item material-shadow border-0">
                                        <button class="accordion-button px-2 py-2 fz-14 fw-500 " id="headingOne"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <span class="fz-16">Thương hiệu</span>
                                        </button>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body fz-14 pb-0 overflow-y-auto filter-brand">
                                                <ul class="ps-0">
                                                    <li class="list-unstyled mb-3 me-5 choose-size-item form-check">
                                                        <input type="radio" name="brand" value="" checked
                                                            class="form-check-input submitFilter me-2 fz-16"
                                                            id="no-filter-brand">
                                                        <label class="form-check-label label-filter-shop text-muted fz-14"
                                                            for="no-filter-brand">Không lọc</label>
                                                        </input>
                                                    </li>
                                                    @if (count($brandFilters) > 0 && !empty($brandFilters))
                                                        @foreach ($brandFilters as $KeyBrandF => $valBrandF)
                                                            <li class="list-unstyled mb-3 form-check">
                                                                <input type="radio" name="brand"
                                                                    id="brand_filter{{ $KeyBrandF }}"
                                                                    value="{{ $valBrandF->slug }}"
                                                                    {{ request('brand') == $valBrandF->slug ? 'checked' : '' }}
                                                                    class="form-check-input submitFilter me-2 fz-16">
                                                                <label
                                                                    class="form-check-label label-filter-shop text-muted fz-14"
                                                                    for="brand_filter{{ $KeyBrandF }}">{{ $valBrandF->name }}</label>
                                                            </li>
                                                        @endforeach
                                                    @endif
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
                                            <span class="fz-16">Danh mục</span>

                                        </button>
                                        <div id="collapseTwo" class="accordion-collapse collapse show"
                                            aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body fz-14 pb-0 overflow-y-auto filter-category">
                                                <ul class="ps-0">
                                                    <li class="list-unstyled mb-3 me-5 choose-size-item form-check">
                                                        <input type="radio" name="category" value="" checked
                                                            class="form-check-input submitFilter me-2 fz-16"
                                                            id="no-filter-category">
                                                        <label class="form-check-label label-filter-shop text-muted fz-14"
                                                            for="no-filter-category">Không lọc</label>
                                                        </input>
                                                    </li>
                                                    @if (count($productCatalogues) > 0 && !empty($productCatalogues))
                                                        @foreach ($productCatalogues as $KeyCatalogueF => $valCatalogueF)
                                                            <li class="list-unstyled mb-3 form-check">
                                                                <input type="radio" name="category"
                                                                    id="category_filter{{ $KeyCatalogueF }}"
                                                                    value="{{ $valCatalogueF->slug }}"
                                                                    {{ request('category') == $valCatalogueF->slug ? 'checked' : '' }}
                                                                    class="form-check-input submitFilter me-2 fz-16">
                                                                <label
                                                                    class="form-check-label label-filter-shop text-muted fz-14"
                                                                    for="category_filter{{ $KeyCatalogueF }}">{{ $valCatalogueF->name }}</label>
                                                            </li>
                                                        @endforeach
                                                    @endif
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
                                                <ul class="ps-0 d-flex flex-wrap choose-size gap-3">
                                                    <li class="list-unstyled mb-3 me-3 choose-size-item form-check">
                                                        <input type="radio" name="size" value="" checked
                                                            class="form-check-input submitFilter me-2 fz-16">
                                                        <label
                                                            class="form-check-label label-filter-shop text-muted fz-14">Không
                                                            lọc</label>
                                                        </input>
                                                    </li>
                                                    @if (count($attributeSizes) > 0 && !empty($attributeSizes))
                                                        @foreach ($attributeSizes as $KeySizeF => $valSizeF)
                                                            <li class="list-unstyled mb-3 me-3 form-check">
                                                                <input type="radio" name="size"
                                                                    id="size_filter{{ $KeySizeF }}"
                                                                    value="{{ $valSizeF->id }}"
                                                                    {{ request('size') == $valSizeF->id ? 'checked' : '' }}
                                                                    class="form-check-input submitFilter me-2 fz-16">
                                                                <label
                                                                    class="form-check-label label-filter-shop text-muted fz-14"
                                                                    for="size_filter{{ $KeySizeF }}">{{ $valSizeF->name }}</label>
                                                            </li>
                                                        @endforeach
                                                    @endif
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
                                                    <li
                                                        class="list-unstyled submitFilter d-flex justify-content-between flex-wrap grid mb-2">
                                                        <div
                                                            class="img-choose-color {{ request('color') == '' ? 'active' : '' }} ">
                                                            <label class="color-selector">
                                                                <img src="/libaries/upload/images/img-notfound.png"
                                                                    alt="" width="30" height="30"
                                                                    data-color="" class="rounded-circle ">
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-unstyled submitFilter d-flex justify-content-between flex-wrap grid gap-2">
                                                        @if (count($attributeColors) > 0 && !empty($attributeColors))
                                                            @foreach ($attributeColors as $KeyColorF => $valColorF)
                                                                <div class="img-choose-color  {{ request('color') == $valColorF->id ? 'active' : '' }}"
                                                                    data-color="{{ $valColorF->id }}">
                                                                    <label class="color-selector">
                                                                        <img src="{{ $valColorF->image ?? '/libaries/upload/images/img-notfound.png' }}"
                                                                            alt="" width="30" height="30"
                                                                            class="rounded-circle mb-md-1">

                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </li>
                                                    <input type="hidden" name="color" class="colorFilter"
                                                        value="{{ request('color') }}">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion text-muted mb-1 rounded-2" id="default-accordion-example"
                                    style="height: 100%">
                                    <div class="accordion-item material-shadow border-0">
                                        <button class="accordion-button px-2 py-2 fz-14 fw-500 " id="headingFive"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                            aria-expanded="true" aria-controls="collapseFive">
                                            <span class="fz-16">Mức giá (đ)</span>
                                        </button>
                                        <div id="collapseFive" class="accordion-collapse collapse show"
                                            aria-labelledby="headingFive" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body fz-14 pb-0">
                                                <ul class="ps-0 d-flex flex-wrap gap-2 box-price-filter">
                                                    <li class="list-unstyled submitFilter">
                                                        <label
                                                            class="box-item-choose-money fz-14 p-2 {{ request('price') == '' ? 'active' : '' }}">Không
                                                            lọc</label>
                                                    </li>
                                                    <li class="list-unstyled submitFilter">
                                                        <label
                                                            class="box-item-choose-money fz-14 p-2 {{ request('price') == '0-200000' ? 'active' : '' }} "
                                                            data-price="0-200000">Dưới 200.000</label>
                                                    </li>
                                                    <li class="list-unstyled submitFilter">
                                                        <label
                                                            class="box-item-choose-money fz-14 p-2 {{ request('price') == '200000-400000' ? 'active' : '' }} "
                                                            data-price="200000-400000">200 - 400.000</label>
                                                    </li>
                                                    <li class="list-unstyled submitFilter">
                                                        <label
                                                            class="box-item-choose-money fz-14 p-2 {{ request('price') == '400000-800000' ? 'active' : '' }} "
                                                            data-price="400000-800000">400 - 800.000</label>
                                                    </li>
                                                    <li class="list-unstyled submitFilter">
                                                        <label
                                                            class="box-item-choose-money fz-14 p-2 {{ request('price') == '800000-1200000' ? 'active' : '' }} "
                                                            data-price="800000-1200000">800 - 1.200K</label>
                                                    </li>
                                                    <li class="list-unstyled submitFilter">
                                                        <label
                                                            class="box-item-choose-money fz-14 p-2 {{ request('price') == '1200000-' ? 'active' : '' }} "
                                                            data-price="1200000-">Trên 1.200K</label>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="price" class="priceFilter"
                                                    value="{{ request('price') }}">
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
                                @if (count($productInBrands) != 0 && !empty($productInBrands))
                                    @foreach ($productInBrands as $key => $product)
                                        @php
                                            $shownColors = []; // Mảng để theo dõi các màu đã được hiển thị

                                            $promotion =
                                                $product->del != 0 && $product->del != null
                                                    ? (($product->price - $product->del) / $product->price) * 100
                                                    : '0';
                                            $price =
                                                $product->del != 0 && $product->del != null
                                                    ? number_format($product->del, '0', ',', '.')
                                                    : number_format($product->price, '0', ',', '.');
                                            //-- // lấy phiên bản đầu tiên của sản phẩm làm mặc định
                                            $variantFirst = $product->productVariant->first();
                                        @endphp
                                        <div class="col-xl-4 col-md-6 col-12 mb-4">
                                            <div class="card card-product shadow-sm border-0 mb-2 py-0">
                                                <div class="position-absolute z-1 w-100">
                                                    <div class="head-card ps-0 d-flex justify-content-between">
                                                        <span
                                                            class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $product->del == 0 || $product->del == null ? 'hidden-visibility' : '' }}">
                                                            -  {{ round($promotion, 0) . '%' }}
                                                        </span>
                                                        <span class="text-end mt-2 me-2 text-muted toggleWishlist"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-title="{{ in_array($product->id, $productInWishlist) ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' }}"
                                                            data-id="{{ $product->id }}">
                                                            <i
                                                                class="fa-{{ in_array($product->id, $productInWishlist) ? 'solid' : 'regular' }} fa-bookmark fz-16"></i>

                                                            <span class="product_id_wishlist d-none">
                                                                {{ $product->id }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="image-main-product position-relative">
                                                    <a href="{{ route('product.detail', ['slug' => $product->slug]) }}">
                                                        <img src="{{ $product->image }}" alt="product image"
                                                            width="100%" height="250"
                                                            class="img-fluid object-fit-cover rounded-top-2"
                                                            style="height: 300px">
                                                        <div
                                                            class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                            <div class="hstack gap-3">
                                                                <div class="p-2 overflow-x-hidden">
                                                                    <span
                                                                        class="fz-12 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                                        {{ $product->productCatalogues[0]->name }}
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
                                                                                        $shownColors[] =
                                                                                            $attribute->name;
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
                                                        <a href="{{ route('product.detail', ['slug' => $product->slug]) }}"
                                                            class="text-break w-100 text-muted">{{ $product->name }}</a>
                                                    </h6>
                                                    <div class="d-flex justify-content-start mb-2 ">
                                                        <span
                                                            class="text-danger fz-20 fw-medium me-3 product-variant-price"
                                                            data-price="{{ $price }}">{{ $price }}đ
                                                        </span>
                                                        <span class="mt-1 ">
                                                            <del
                                                                class="text-secondary fz-14 {{ $product->del == 0 && $product->del == null ? 'hidden-visibility' : '' }}">{{ number_format($product->price, '0', ',', '.') }}đ</del>
                                                        </span>
                                                    </div>
                                                    <div class="box-action">
                                                        <a href="{{ route('cart.index') }}"
                                                            class="action-cart-item-buy addToCart buyNow"
                                                            data-id="{{ $product->id }}"
                                                            data-product-variant-id="{{ $variantFirst->id }}"
                                                            data-product-variant-price="{{ $variantFirst->price }}"
                                                            data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                                            <span>Mua ngay</span>
                                                        </a>
                                                        <a href="" class="action-cart-item-add addToCart"
                                                            data-id="{{ $product->id }}"
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
                                                            class="ms-auto text-dark fw-500 fz-14">{{ $product->sku }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="order-null p-3">
                                        <div class="img-null text-center">
                                            <img src="/libaries/upload/images/order-null.png" alt=""
                                                class="" width="300" height="200">
                                        </div>
                                        <div class="flex flex-col text-center align-items-center">
                                            <h5 class="mb-2 fw-semibold">không có sản phẩm phù hợp với yêu cầu!
                                            </h5>
                                            <a href="{{ route('product.brand', ['id' => request('id')]) }}"
                                                class="btn btn-info text-white rounded-pill mt-3 pz-3">Quay lại</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pagination pagination-sm">
                            {{ $productInBrands->appends(request()->except('page'))->onEachSide(3)->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
                <div class="banner-shop my-3">
                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/banner-event.avif" alt=""
                        width="100%" height="" class="img-fluid rounded-2">
                </div>
                <div class="product-shop-new mt-4 mb-3 text-muted">
                    <div class="title-product mb-4 col-xl-3 col-lg-3 col-8">
                        <div class="price-banner">
                            <div
                                class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                                <div class="price-icon">
                                    <i class="fa-solid fa-fire text-white"></i>
                                </div>
                                <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                    sản phẩm mới
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row flex-wrap">
                        @if (count($productShopNews) != 0 && !empty($productShopNews))
                            @foreach ($productShopNews as $key => $productNew)
                                @php
                                    $shownColors = [];
                                    $promotion =
                                        $productNew->del != 0 && $productNew->del != null
                                            ? (($productNew->price - $productNew->del) / $productNew->price) * 100
                                            : '0';

                                    $price =
                                        $productNew->del != 0 && $productNew->del != null
                                            ? number_format($productNew->del, '0', ',', '.')
                                            : number_format($productNew->price, '0', ',', '.');
                                    //-- // lấy phiên bản đầu tiên của sản phẩm làm mặc định
                                    $variantFirst = $productNew->productVariant->first();
                                @endphp
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="card card-product shadow-sm border-0 mb-2 py-0">
                                        <div class="position-absolute z-1 w-100">
                                            <div class="head-card ps-0 d-flex justify-content-between">
                                                <span
                                                    class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $productNew->del == 0 || $productNew->del == null ? 'hidden-visibility' : '' }}">
                                                    -  {{ round($promotion, 0) . '%' }}
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
                                                    data-id="{{ $productNew->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                                    <span>Mua ngay</span>
                                                </a>
                                                <a href="" class="action-cart-item-add addToCart"
                                                    data-id="{{ $productNew->id }}"
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
                                                <span class="ms-auto text-dark fw-500 fz-14">{{ $productNew->sku }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="product-shop-hot my-3 text-muted">
                    <div class="title-product mb-4 col-xl-2 col-lg-2 col-5">
                        <div class="price-banner">
                            <div
                                class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                                <div class="price-icon">
                                    <i class="fa-solid fa-tags text-white"></i>
                                </div>
                                <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                    Giá tốt
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row flex-wrap">
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
                <hr class="pb-3 pt-3 " class="border-3">
                <div class="row flex-wrap">
                    <div class="col-lg-9 col-md-12 col-12">
                        <!-- Base Example -->
                        <div class="accordion shadow-sm text-muted mb-3 rounded-2 border-0">
                            <div class="accordion-item material-shadow border-0">
                                <h2 class="accordion-header border-0" id="headingOne">
                                    <button class="accordion-button fz-16 fw-500 text-dark" type="button">
                                        <span class="">Thông tin chung </span>
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse show">
                                    <div class="accordion-body bg-light fz-14">
                                        <div class="mb-3">
                                            <h4 class="mb-3"><i class="fa-solid fa-circle-info me-2"></i>Sản phẩm</h4>
                                            <p>Sản phẩm thời trang của chúng tôi là sự kết hợp hoàn hảo giữa chất liệu và
                                                phong cách, mang lại sự tự tin và thoải mái cho người mặc trong mọi hoàn
                                                cảnh. Chúng tôi tập trung vào các yếu tố chính sau:</p>
                                            <img src="https://mfvietnam.com/wp-content/uploads/2020/07/top-6-fashion-influencer-viet-nam-ho-la-ai.jpg"
                                                class="img-fluid mb-3 object-fit-contain rounded-2" width="100%"
                                                height="300" alt="Giới thiệu sản phẩm">
                                            <ul>
                                                <li><strong>Thiết kế phong phú và đa dạng:</strong>
                                                    <ul>
                                                        <li><strong>Phong cách cổ điển</strong> – các thiết kế theo xu hướng
                                                            vintage, phong cách cổ điển luôn là sự lựa chọn hàng đầu cho
                                                            những người yêu thích sự tinh tế và giản dị.</li>
                                                        <li><strong>Phong cách hiện đại</strong> – với các đường nét mạnh mẽ
                                                            và cắt may sáng tạo, sản phẩm của chúng tôi phù hợp cho cả nam
                                                            và nữ muốn thể hiện cá tính.</li>
                                                        <li><strong>Trang phục công sở</strong> – Chúng tôi cung cấp các mẫu
                                                            thiết kế thanh lịch, phù hợp với môi trường văn phòng, giúp
                                                            người mặc cảm thấy tự tin và chuyên nghiệp.</li>
                                                        <li><strong>Thời trang năng động</strong> – các sản phẩm phù hợp cho
                                                            các hoạt động ngoài trời, dạo phố hay vui chơi, tạo sự thoải mái
                                                            và linh hoạt.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>Chất liệu cao cấp</strong>: Để đảm bảo sự hài lòng tối đa, các
                                                    sản phẩm đều sử dụng các loại vải cao cấp như:
                                                    <ul>
                                                        <li><strong>Vải cotton</strong> – tự nhiên và thoáng mát, giúp giảm
                                                            nhiệt độ cơ thể trong thời tiết nóng ẩm.</li>
                                                        <li><strong>Vải lụa</strong> – mang lại cảm giác mềm mại và sang
                                                            trọng, phù hợp cho những dịp đặc biệt.</li>
                                                        <li><strong>Vải jeans</strong> – độ bền cao, không dễ bị rách hay
                                                            mài mòn, thích hợp cho phong cách trẻ trung và cá tính.</li>
                                                        <li><strong>Vải thun lạnh</strong> – co giãn, dễ chịu và không gây
                                                            cảm giác bí bách.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>Chú trọng đến chi tiết:</strong>
                                                    <ul>
                                                        <li><strong>Đường may</strong> – kỹ thuật may tỉ mỉ, chắc chắn.</li>
                                                        <li><strong>Phụ kiện</strong> – cẩn thận từ các chi tiết nhỏ như
                                                            nút, khóa kéo, tạo sự hoàn thiện.</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mb-3">
                                            <h5><i class="fa-solid fa-award me-2"></i> Cam kết Chất lượng</h5>
                                            <p>Chất lượng sản phẩm là cam kết hàng đầu của chúng tôi, đảm bảo mọi sản phẩm
                                                đều đạt chuẩn trước khi đến tay khách hàng.</p>
                                            <img src="https://images.pexels.com/photos/573298/pexels-photo-573298.jpeg"
                                                class="img-fluid mb-3 object-fit-contain rounded-2" width="100%"
                                                height="300" alt="Cam kết chất lượng">
                                            <ul>
                                                <li><strong>Đảm bảo chất liệu và nguồn gốc:</strong>
                                                    <ul>
                                                        <li>Mỗi sản phẩm đều được chọn lọc từ nguồn nguyên liệu chất lượng
                                                            và có nguồn gốc rõ ràng.</li>
                                                        <li>Chúng tôi chỉ làm việc với các nhà cung cấp có uy tín, đã qua
                                                            kiểm định và chứng nhận.</li>
                                                        <li>Nguyên liệu thân thiện với môi trường và an toàn cho người sử
                                                            dụng.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>Kiểm tra nghiêm ngặt từng chi tiết:</strong>
                                                    <ul>
                                                        <li>Chất lượng vải – đảm bảo vải không bị lỗi, xù hoặc sờn.</li>
                                                        <li>Đường may – từng mũi may chắc chắn, không bị đứt hay lệch.</li>
                                                        <li>Phụ kiện và khóa kéo – kiểm tra tính bền và độ tiện dụng.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>Chính sách bảo hành rõ ràng:</strong>
                                                    <ul>
                                                        <li>Hỗ trợ đổi trả trong 7 ngày nếu sản phẩm không đúng mô tả.</li>
                                                        <li>Bảo hành chất lượng trong 30 ngày với cam kết đổi sản phẩm lỗi
                                                            do sản xuất.</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mb-3">
                                            <h5><i class="fa-solid fa-thumbs-up me-2"></i> Đảm bảo Uy tín</h5>
                                            <p>Chúng tôi luôn đặt uy tín lên hàng đầu với các cam kết chặt chẽ về chất lượng
                                                và dịch vụ:</p>
                                            <img src="https://images.pexels.com/photos/242236/pexels-photo-242236.jpeg"
                                                class="img-fluid mb-3 object-fit-contain rounded-2" width="100%"
                                                height="300" alt="Đảm bảo uy tín">
                                            <ul>
                                                <li><strong>Cam kết chất lượng sản phẩm:</strong> Mọi sản phẩm đều được kiểm
                                                    tra kỹ lưỡng trước khi đưa đến tay khách hàng.</li>
                                                <li><strong>Đổi trả linh hoạt:</strong> Với chính sách đổi trả rõ ràng,
                                                    khách hàng có thể hoàn trả hoặc đổi sản phẩm nếu không hài lòng.</li>
                                                <li><strong>Hỗ trợ hoàn tiền:</strong> Khách hàng được hoàn tiền nếu sản
                                                    phẩm không đáp ứng được tiêu chuẩn mô tả.</li>
                                                <li><strong>Giao hàng nhanh chóng:</strong>
                                                    <ul>
                                                        <li>Đối với khách hàng nội thành: Giao trong ngày.</li>
                                                        <li>Khách hàng ngoại tỉnh: Giao trong vòng 2-5 ngày.</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mb-3">
                                            <h5><i class="fa-solid fa-users me-2"></i> Chăm sóc Khách hàng</h5>

                                            <p>Dịch vụ chăm sóc khách hàng chuyên nghiệp và tận tâm với các chính sách rõ
                                                ràng:</p>
                                            <img src="https://images.pexels.com/photos/3183197/pexels-photo-3183197.jpeg"
                                                class="img-fluid mb-3 object-fit-contain rounded-2" width="100%"
                                                height="300" alt="Chăm sóc khách hàng">
                                            <ul>
                                                <li><strong>Hỗ trợ tư vấn miễn phí:</strong> Đội ngũ nhân viên thân thiện
                                                    luôn sẵn sàng giúp đỡ khách hàng trong việc lựa chọn sản phẩm phù hợp.
                                                </li>
                                                <li><strong>Hỗ trợ 24/7:</strong> Chúng tôi có tổng đài trực tuyến, sẵn sàng
                                                    giải đáp mọi thắc mắc bất cứ lúc nào.</li>
                                                <li><strong>Khuyến mãi dành riêng cho khách hàng thân thiết:</strong> Các
                                                    chương trình ưu đãi đặc biệt dành cho khách hàng mua hàng thường xuyên.
                                                </li>
                                                <li><strong>Quà tặng và voucher:</strong>
                                                    <ul>
                                                        <li>Giảm giá 10% cho lần mua hàng đầu tiên.</li>
                                                        <li>Tặng quà khi đạt mức chi tiêu từ 1,000,000 VND trở lên.</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aside-product col-lg-3 col-md-12 col-12">
                        <div class="card border-0 rounded-1 shadow-sm mb-4">
                            <div class="card-header">
                                <h6 class="card-title fw-18 fw-500">Danh mục</h6>
                            </div>
                            <div class="card-body p-1">
                                <div class="categoryP-item mb-3 overflow-y-auto">
                                    <ul class="list-group list-group-flush">
                                        @if (!is_null($productCatalogues) && !empty($productCatalogues))
                                            @foreach ($productCatalogues as $cataloguePro)
                                                <li class="list-group-item item-category">
                                                    <a href="{{ route('post.category', ['id' => $cataloguePro->id]) }}"
                                                        class="text-decoration-none d-flex align-items-center">
                                                        <img src="{{ $cataloguePro->image }}"
                                                            alt="{{ $cataloguePro->name }}" width="50"
                                                            height="50"
                                                            class="me-3 object-fit-contain bg-light rounded-3 ">
                                                        <span class="text-muted fw-500">{{ $cataloguePro->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 rounded-1 shadow-sm mb-4">
                            <div class="card-header">
                                <h6 class="card-title fw-18 fw-500">Thương hiệu</h6>
                            </div>
                            <div class="card-body p-1">
                                <div class="brand-item mb-3 overflow-y-auto">
                                    <ul class="list-group list-group-flush">
                                        @if (!is_null($brandAll) && !empty($brandAll))
                                            @foreach ($brandAll as $brandPage)
                                                <li class="list-group-item item-category">
                                                    <a href="{{ route('product.brand', ['id' => $brandPage->id]) }}"
                                                        class="text-decoration-none d-flex align-items-center">
                                                        <img src="{{ $brandPage->image }}"
                                                            alt="{{ $brandPage->name }}" width="50" height="50"
                                                            class="me-3 object-fit-contain bg-light rounded-3">
                                                        <span class="text-muted fw-500">{{ $brandPage->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 rounded-1 shadow-sm mb-4">
                            <div class="card-header">
                                <h6 class="card-title fw-18 fw-500">Bài viết</h6>
                            </div>
                            <div class="card-body p-1">
                                <div class="categoryP-item mb-3 overflow-y-auto">
                                    <ul class="list-group list-group-flush">
                                        @if (!is_null($postCategories) && !empty($postCategories))
                                            @foreach ($postCategories as $categoryP)
                                                <li class="list-group-item item-category">
                                                    <a href="{{ route('post.category', ['id' => $categoryP->id]) }}"
                                                        class="text-decoration-none d-flex align-items-center">
                                                        <img src="{{ $categoryP->image }}"
                                                            alt="{{ $categoryP->name }}" width="50" height="50"
                                                            class="me-3 object-fit-contain bg-light rounded-3 ">
                                                        <span class="text-muted fw-500">{{ $categoryP->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
