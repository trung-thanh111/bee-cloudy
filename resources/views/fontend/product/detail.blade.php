@extends('fontend.home.layout')
@section('page_title')
    Chi tiết sản phẩm
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0 w-100">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="{{ route('shop.index') }}"
                                class="text-decoration-none text-muted">Cửa hàng</a>
                        </li>
                        <li class="breadcrumb-item active text-truncate" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                @php
                    $price = '';
                    $priceDiscount = '';
                    $price .=
                        $product->del != 0 && $product->del != null
                            ? number_format($product->del, '0', ',', '.') .
                                'đ' .
                                ' ' .
                                '-' .
                                ' ' .
                                number_format($product->price, '0', ',', '.') .
                                'đ'
                            : number_format($product->price, '0', ',', '.') . 'đ';
                    $priceDiscount .= number_format($product->price - $product->del, '0', ',', '.') . 'đ';
                    // -- //
                    $attrCatalogues = $product->attributeCatalogue;
                    $albumVairiants = [];
                    foreach ($product->productVariant as $variant) {
                        if (!empty($variant->album)) {
                            $albumVairiants[] = $variant->album;
                        }
                    }
                    $gallerys = $albumVairiants;
                    //-- //
                    $totalSoldCount = 0;
                    $totalReviewCount = 0;
                    foreach ($product->productVariant as $variant) {
                        $totalSoldCount += $variant->sold_count;
                    }

                    foreach ($product->productVariant as $variant) {
                        $totalReviewCount += $variant->rating_count;
                    }
                    $numericPrice = (int) preg_replace('/\D/', '', $price);
                @endphp
                <!-- content detail -->
                <div class="main-detail row text-muted pt-3 mx-0 bg-white shadow-sm rounded-1 mb-5 productVariantId">
                    <div class="col-lg-5 col-md-12 col-sm-12 mb-md-4 mb-sm-3 mb-xs-2 galleryVariant">
                        <div id="main-carousel" style="margin-bottom: 10px;" class="splide " aria-label="Main Carousel">
                            <div class="splide__track ">
                                <ul class="splide__list position-relative">
                                    @if ($product)
                                        <li class="splide__slide image-product">
                                            <img src="{{ $product->image }}" alt="" class="img-fluid">
                                        </li>
                                    @elseif($product->productVariant)
                                        <li class="splide__slide image-product">
                                            <img src="{{ explode(',', $product->productVariant->album) }}" alt=""
                                                class="img-fluid">
                                        </li>
                                    @endif

                                </ul>
                                <div class="box-favourite position-absolute z-3 toggleWishlist" data-bs-toggle="tooltip"
                                    data-bs-title="Thêm vào yêu thích">
                                    <div class="position-relative">
                                        <button type="button"
                                            class="position-absolute start-50 translate-middle border-0 bg-white p-0"
                                            style="top: 20px;">
                                            <i class="icon-favourite fa-regular fa-bookmark fz-20 text-muted  "></i>
                                        </button>
                                    </div>
                                    <span class="product_variant_id_wishlist d-none"></span>
                                    <span class="product_id_wishlist d-none">
                                        {{ $product->id }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="thumbnail-carousel" class="splide mb-5">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @if ($product)
                                        <li class="splide__slide image-product">
                                            <img src="{{ $product->image }}" alt="" class="img-fluid">
                                        </li>
                                    @elseif($product->productVariant)
                                        <li class="splide__slide image-product">
                                            <img src="{{ explode(',', $product->productVariant->album) }}" alt=""
                                                class="img-fluid">
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="box-sku d-flex justify-content-between align-items-center">
                            <div class="detail-sku">
                                <span class="fz-14">
                                    <span>Sku: </span>
                                    <strong>{{ $product->sku }}</strong>
                                </span>
                            </div>
                            <div class="share">
                                <span class="fz-14">
                                    <ul class="p-0 d-flex justify-content-around align-items-center w-75">

                                        <li class="list-unstyled mx-2">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}"
                                                target="_blank" class="text-decoration-none text-dark fz-20 fw-normal">
                                                <img width="25" height="25"
                                                    src="https://img.icons8.com/color/25/facebook.png" alt="facebook"
                                                    data-bs-toggle="tooltip" data-bs-title="Chia sẻ lên Facebook" />
                                            </a>
                                        </li>
                                        <li class="list-unstyled mx-2">
                                            <a href="https://www.messenger.com/t?link={{ urlencode(Request::url()) }}"
                                                target="_blank" class="text-decoration-none text-dark fz-20 fw-normal">
                                                <img width="25" height="25"
                                                    src="https://img.icons8.com/fluency/25/facebook-messenger--v2.png"
                                                    alt="facebook-messenger--v2" data-bs-toggle="tooltip"
                                                    data-bs-title="Chia sẻ qua Messenger" />
                                            </a>
                                        </li>
                                        <li class="list-unstyled mx-2">
                                            <a href="https://zalo.me/share?url={{ urlencode(Request::url()) }}"
                                                target="_blank" class="text-decoration-none text-dark fz-20 fw-normal">
                                                <img width="25" height="25"
                                                    src="https://img.icons8.com/color/25/zalo.png" alt="zalo"
                                                    data-bs-toggle="tooltip" data-bs-title="Chia sẻ qua Zalo" />
                                            </a>
                                        </li>
                                    </ul>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 col-sm-12">
                        <div class="content-product px-2">
                            <div class="title-product ">
                                <h4 class="fs-4 fw-bold mb-1 product-variant-title">{{ $product->name }}</h4>
                                <h4 class="fs-4 fw-bold mb-1 product-variant-id d-none">
                                    {{ $product->id }}
                                </h4>
                                <div class="hstack gap-3 fz-14 flex-wrap">
                                    <div class="brands-detail">
                                        <span>Thương hiệu: </span> <span class="fw-medium text-info">{{ $product->brands->name }}</span>
                                    </div>
                                    <div class="vr" style="width: 0.5px !important;"></div>
                                    <div class="py-2">Đánh giá (<strong>@{{ comment ? comment : 0 }}</strong>)</div>
                                    <div class="py-2" v-if="avg_stars > 0">
                                        <span class="product-variant-rate">
                                            <i v-for="index in 5" :key="index"
                                                :class="[
                                                    'fas',
                                                    {
                                                        'fa-star': index <= Math.floor(avg_stars),
                                                        'fa-star-half-alt': index === Math.ceil(avg_stars) &&
                                                            avg_stars % 1 !== 0,
                                                        'far fa-star': index > Math.ceil(avg_stars)
                                                    }
                                                ]"
                                                style="color: #FFD700;"></i>
                                        </span>
                                    </div>
                                    <div class="vr" style="width: 1px !important;"></div>
                                    <div class="py-2">
                                        <span class="fw-500">Đã bán:</span>
                                        <span class="product-variant-sold">{{ $totalSoldCount . ' ' }} sản phẩm</span>
                                    </div>
                                </div>
                            </div>
                            <h4 class="fs-5 py-3 m-0">
                                @foreach ($product->productCatalogues as $productCatalogue)
                                    {{ $productCatalogue->name }}
                                @endforeach
                            </h4>

                            <div class="hstack gap-3 fz-14 mb-3">
                                <h4 class="fs-4 fw-bold text-danger mb-1 product-variant-price"
                                    data-price="{{ $price }}">{{ $price }}</h4>
                                <span
                                    class="mb-1 ms-auto {{ $product->del == 0 || $product->del == null ? 'hidden-visibility' : '' }}">

                                    <span class="text-truncate">giảm đến <del
                                            class="text-warning text-sm-start">{{ $priceDiscount }}</del> trên giá trị mỗi
                                        sản phẩm</span>
                                </span>
                            </div>
                            <p class="fz-14">{!! $product->info !!}</p>
                            @if (!is_null($attrCatalogues) && !empty($attrCatalogues))
                                <div class="product-attributes">
                                    @foreach ($attrCatalogues as $key => $val)
                                        <div class="attribute attribute-{{ $val->id == 1 ? 'color' : 'size' }}">
                                            <div class="attribute-header d-flex justify-content-between mb-2">
                                                <span class="attribute-title fw-medium fs-5">{{ $val->name }}</span>
                                                @if ($val->id == 2)
                                                    <a href="javascript:void(0)"
                                                        class="size-chart-link link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fs-6"
                                                        data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                                        Bảng size <i class="fa-solid fa-ruler"></i>
                                                    </a>
                                                @endif
                                            </div>

                                            @if (!is_null($val->attributes) && is_iterable($val->attributes))
                                                <div class="attribute-value d-flex flex-wrap gap-3 ps-4 mb-3">
                                                    @foreach ($val->attributes as $keyAttr => $attribute)
                                                        <a href="#"
                                                            class="choose-attribute  {{ $keyAttr == 0 ? 'active' : '' }}  {{ $val->id == 1 ? 'color-item' : 'size-item' }} "
                                                            data-attributeId="{{ $attribute->id }}"
                                                            title="{{ $attribute->name }}">
                                                            <div class="attribute-item">
                                                                @if ($val->id == 1)
                                                                    <img src="{{ $attribute->image }}"
                                                                        alt="{{ $attribute->name }}"
                                                                        class="me-2 rounded-circle" width="30"
                                                                        height="30">
                                                                    <span
                                                                        class="d-none d-md-inline-block">{{ $attribute->name }}</span>
                                                                @else
                                                                    <span
                                                                        class="fw-bold text-uppercase">{{ $attribute->name }}</span>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" class="attributeCatalogue" value="{{ json_encode($attrCatalogues) }}">
                            <div class="box-choose-size">
                                <div class="title-choose-size mb-2">
                                    <div class="row d-flex justify-content-between align-items-center  flex-wrap">
                                        <div class="col">
                                            <div class="table-size col-12 text-end">
                                                <div class="modal fade" id="exampleModalToggle" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-6" id="exampleModalToggleLabel">
                                                                    Gợi ý size</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <span class="fz-14 text-warning text-center mx-2">Đây chỉ
                                                                    là bảng
                                                                    size
                                                                    mô phỏng, độ chính xác tương đối.</span>
                                                                <p class="text-start">Size áo</p>
                                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/bang-size-ao.jpg"
                                                                    alt="" class="img-fluid object-fit-cover">
                                                                <p class="text-start">Size quần</p>
                                                                <img src="/libaries/upload/images/size-quan.png"
                                                                    alt="" class="img-fluid object-fit-cover">
                                                                <p class="text-start">Size Giày</p>
                                                                <img src="/libaries/upload/images/bang-size-giay.webp"
                                                                    alt="" class="img-fluid object-fit-cover">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-quantity">
                                    <div class="title-quantity mb-2">
                                        <span class="fw-medium fz-18 me-3">Số lượng</span>
                                        <span class="fz-14 text-success quantity-instock fw-medium"></span>
                                    </div>
                                    <div class=" hstack gap-3 ps-5 flex-sm-wrap flex-xs-wrap mb-3">
                                        <div class="input-group componant-quantity shadow-sm flex-grow mb-3 w-25">
                                            <button class="quantity-minus w-md-100 rounded-3 " type="button"
                                                id="button-addon1">
                                                <i class='bx bx-minus fw-medium'></i>
                                            </button>
                                            <input type="text" name="quantity-product-variant w-sm-25 "
                                                class="form-control quantity-product-variant border-0 fz-20 text-center fw-600"
                                                value="1" min="1" max="">
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="quantity-plus w-md-100 " type="button" id="button-addon2">
                                                <i class='bx bx-plus'></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group-add ">
                                    <div class="hstack gap-3 my-3">
                                        <div class="w-50">
                                            <a href="" class="addToCart" data-id="{{ $product->id }}">
                                                <button
                                                    class="animated-button fz-18 rounded-2 fw-medium shadow-sm w-100"
                                                    data-bs-toggle="tooltip" data-bs-title="Thêm vào giỏ hàng"
                                                    data-id="{{ $product->id }}">
                                                    <span> <i class="fa-solid fa-cart-plus fz-20 me-2"></i> <p class="d-none d-md-inline-block mb-0">Thêm vào </p> giỏ
                                                        hàng</span>
                                                    <span></span>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="w-50 ms-auto">
                                            <a href="{{ route('cart.index') }}"
                                                class="animated-button-success fw-medium fz-18 w-100 rounded-2 shadow-sm addToCart buyNow"
                                                data-id="{{ $product->id }}">
                                                <i class="fa-solid fa-cart-shopping me-2"></i>Mua Ngay
                                                <p class="fz-14 fw-normal mb-0 d-none d-md-inline-block">Giao hàng tận nơi hoặc nhận tại cửa hàng
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="commit-quality mb-5">
                    <div class="container policy mb-3">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <div class="card border-0 shadow-sm hover-shadow transition-all">
                                    <div class="card-body p-2">
                                        <div class="d-flex align-items-center flex-xl-row flex-column">
                                            <div
                                                class="feature-icon bg-light rounded-circle p-3 me-3 text-center text-xl-start">
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
                                            <div
                                                class="feature-icon bg-light rounded-circle p-3 me-3 text-center text-xl-start">
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
                                            <div
                                                class="feature-icon bg-light rounded-circle p-3 me-3 text-center text-xl-start">
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
                                            <div
                                                class="feature-icon bg-light rounded-circle p-3 me-3 text-center text-xl-start">
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
                <div class="row flex-wrap">
                    <div class="col-lg-8 col-md-12 col-12">
                        <!-- Base Example -->
                        <div class="accordion shadow-sm text-muted mb-3 rounded-2 border-0">
                            <div class="accordion-item material-shadow border-secondary">
                                <h2 class="accordion-header border-0" id="headingOne">
                                    <button class="accordion-button fz-16 fw-500 text-dark" type="button">
                                        <span class="">Thông tin sản phẩm </span>
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse show">
                                    <div class="accordion-body bg-light fz-14">
                                        {!! $product->info !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion shadow-sm text-muted mb-5 rounded-2 border-0"
                            id="default-accordion-example">
                            <div class="accordion-item border-secondary material-shadow ">
                                <h2 class="accordion-header border-0" id="headingOne">
                                    <button class="accordion-button fz-16 fw-500 text-dark" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <span class="">Mô tả sản phẩm </span>

                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                    <div class="accordion-body bg-light fz-14">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::check())
                            <hr style="padding: 2px ;" class="text-muted fw-bolder">
                            <div class="accordion shadow-sm text-muted mb-5 rounded-2 border-0">
                                <div class="accordion-item material-shadow ">
                                    <h2 class="accordion-header border-0" id="headingTow">
                                        <button class="accordion-button fz-16 fw-500 text-dark" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTow" aria-expanded="true"
                                            aria-controls="collapseTow">
                                            <span class="">Đánh giá sản phẩm</span>

                                        </button>
                                    </h2>
                                    <div id="collapseTow" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTow" data-bs-parent="#default-accordion-example">
                                        <div class="accordion-body bg-white fz-14">
                                            <div class="product-rating mb-3">
                                                <div class="hstack gap-2">
                                                    <div class="item-two">
                                                        <div class="rating">
                                                            <label style="margin-right: 5px" for="rating-select">Chất
                                                                lượng
                                                                sản phẩm: </label>
                                                            <select id="rating-select" v-model="create.publish">
                                                                <option style="color: gold; font-size: 20px;"
                                                                    value="1">
                                                                    &#9733;</option>
                                                                <option style="color: gold; font-size: 20px;"
                                                                    value="2">
                                                                    &#9733;&#9733;</option>
                                                                <option style="color: gold; font-size: 20px;"
                                                                    value="3">
                                                                    &#9733;&#9733;&#9733;</option>
                                                                <option style="color: gold; font-size: 20px;"
                                                                    value="4">
                                                                    &#9733;&#9733;&#9733;&#9733;</option>
                                                                <option style="color: gold; font-size: 20px;"
                                                                    value="5">
                                                                    &#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $user = Auth::user();
                                            @endphp
                                            <div class="product-comment ">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-12 d-block justify-content-center">
                                                        <button type="button" class="btn border-0 px-0">
                                                            <span class="d-block align-items-center">
                                                                <img class="rounded-circle header-profile-user"
                                                                    src="{{ $user->image ? $user->image : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif' }}"
                                                                    alt="Avatar User"
                                                                    class="rounded-circle object-fit-cover" width="60"
                                                                    height="60">
                                                                <p class="text-center mt-2">
                                                                    <span
                                                                        class="d-none d-xl-inline-block ms-1 fw-medium text-muted">{{ $user->name }}</span>
                                                                </p>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <div
                                                        class="col-lg-10 col-md-10 col-12 d-block justify-content-center ps-0">
                                                        <template v-if="!check ">
                                                            <form>
                                                                <div class="form-group position-relative w-100">
                                                                    <textarea v-model="create.content" class=" textarea-comment form-control rounded-2  shadwo-sm" id="comment"
                                                                        rows="4" placeholder="Hãy cho chúng tôi biết ban đang nghĩ gì?"></textarea>
                                                                    <button type="button"
                                                                        class="btn btn-success position-absolute z-3  py-1 px-4"
                                                                        style="bottom: 70px ; right: 20px;"
                                                                        v-on:click="DanhGiaSP()">Gửi</button>
                                                                </div>
                                                            </form>
                                                        </template>
                                                        <template v-else>
                                                            Bạn đã đánh giá sản phẩm .
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-coment mt-3 mb-2">
                                                <div v-if="avg_stars > 0" class="py-2 me-3 mb-3">
                                                    <span class="fw-500 fz-16 ">Xem đánh giá
                                                        (@{{ comment }})</span>
                                                </div>
                                                <template v-for="(v,k) in list">
                                                    <div class="row mx-2">
                                                        <div
                                                            class="col-lg-2 col-md-2 col-12 d-flex justify-content-end align-items-start">
                                                            <button type="button" class="btn  border-0 px-0">
                                                                <span
                                                                    class="d-block justify-content-end align-items-center">
                                                                    <img class="rounded-circle header-profile-user"
                                                                        src="{{ $user->image ? $user->image : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif' }}"
                                                                        alt="Avatar User"
                                                                        class="rounded-circle object-fit-cover"
                                                                        width="50" height="50">
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div
                                                            class="col-lg-10 col-md-10 col-12 d-block justify-content-center ps-0">
                                                            <div class="box-review">
                                                                <div class="review-item rounded-2 my-2">
                                                                    <div
                                                                        class="hstack gap-2 d-flex justify-content-start align-items-center">
                                                                        <div class="pt-2 d-inline-block">
                                                                            <h6 class="fz-18 mb-0">@{{ v.name }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="pt-2 d-inline-block">
                                                                            <div :data-value="v.publish">
                                                                                <span v-for="i in v.publish"
                                                                                    :key="i"
                                                                                    class="star-icon"
                                                                                    style="color: gold;">
                                                                                    <i class="fa-solid fa-star"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="dropdown ms-auto ">
                                                                            <a class=" dropdown-toggle" href="#"
                                                                                role="button" data-bs-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                <i
                                                                                    class="fa-solid fa-ellipsis-vertical fz-14 text-muted"></i>
                                                                            </a>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-end border-0 ul-menu p-0 mb-1">
                                                                                <template
                                                                                    v-if="v.user_id === {{ Auth::id() }}">
                                                                                    <template v-if="v.edit_count === 0">
                                                                                        <li class="p-1"
                                                                                            v-on:click=" edit = Object.assign({}, v)"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#edit">
                                                                                            <a href="#"
                                                                                                class="text-decoration-none text-muted fz-14 ps-1">
                                                                                                <i
                                                                                                    class="fa-solid fa-circle-info me-2"></i>Chỉnh
                                                                                                sửa
                                                                                            </a>
                                                                                        </li>
                                                                                    </template>
                                                                                    <template v-else>
                                                                                        <li class="p-1">
                                                                                            <span
                                                                                                class="text-decoration-none text-muted fz-14 ps-1">
                                                                                                <i
                                                                                                    class="fa-solid fa-circle-info me-2"></i>Đã
                                                                                                chỉnh sửa
                                                                                            </span>
                                                                                        </li>
                                                                                    </template>
                                                                                </template>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="review-time">
                                                                        <span class="fz-12">@{{ formatDate(v.created_at) }}</span>
                                                                    </div>
                                                                    <div class="content-review mt-2">
                                                                        <p class="fz-14 fst-italic fw-500">
                                                                            @{{ v.content }}
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <div class="icon-reaction pb-2">
                                                                            <button class="like-button"
                                                                                v-on:click="Like(v)"
                                                                                style="border: none; background: none; padding: 0;">
                                                                                <i class="fa-regular fa-heart me-2"></i>
                                                                            </button>
                                                                            <span>@{{ v.like_count }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="aside-product-detail col-lg-4 col-md-12 col-12">
                        <div class="card border-0 rounded-1 shadow-sm mb-4">
                            <div class="card-header">
                                <h6 class="card-title fw-18 fw-500">Voucher</h6>
                            </div>
                            <div class="card-body py-2">
                                @if ($promotions)
                                    @foreach ($promotions as $promotion)
                                        @php
                                        @endphp
                                        <div class="voucher-item brand-item mb-3 overflow-y-auto">
                                            <ul class="ps-0 mb-0">
                                                <li class="list-unstyled d-flex justify-content-start text-muted mb-2 ">
                                                    <div class="image-voucher-item ">
                                                        <img src="{{ $promotion->image != null ? $promotion->image : '/libaries/templates/bee-cloudy-user/libaries/images/voucher1.avif' }}"
                                                            alt="" width="80" height="100%"
                                                            class="img-fuild object-fit-contain  me-2">
                                                    </div>
                                                    <div class="title-date-voucher w-100">
                                                        <div class="col">
                                                            <h6 class="fz-16 pb-2">{{ $promotion->name }}</h6>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="fz-12">Sử dụng đến:
                                                                <strong>{{ date('d-m-Y', strtotime($promotion->end_date)) }}</strong></span>
                                                            <a href="{{ route('promotion.home_index') }}"
                                                                class="text-end">
                                                                <button
                                                                    class="btn rounded-2 btn-info fz-12 fw-medium text-white">Xem</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="card border-0 rounded-1 shadow-sm mb-4">
                            <div class="card-header">
                                <h6 class="card-title fw-18 fw-500">Danh mục</h6>
                            </div>
                            <div class="card-body p-1">
                                <div class="brand-item mb-3 overflow-y-auto">
                                    <ul class="list-group list-group-flush">
                                        @if (!is_null($categories) && !empty($categories))
                                            @foreach ($categories as $category)
                                                <li class="list-group-item">
                                                    <a href="{{ route('product.category', ['id' => $category->id]) }}"
                                                        class="text-decoration-none d-flex align-items-center">
                                                        <img src="{{ $category->image }}" alt="{{ $category->name }}"
                                                            width="50" height="50"
                                                            class="me-3 object-fit-contain bg-light rounded-3 ">
                                                        <span class="text-muted fw-500">{{ $category->name }}</span>
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
                                        @if (!is_null($brands) && !empty($brands))
                                            @foreach ($brands as $brand)
                                                <li class="list-group-item">
                                                    <a href="{{ route('product.brand', ['id' => $brand->id]) }}"
                                                        class="text-decoration-none d-flex align-items-center">
                                                        <img src="{{ $brand->image }}" alt="{{ $brand->name }}"
                                                            width="50" height="50"
                                                            class="me-3 object-fit-contain bg-light rounded-3">
                                                        <span class="text-muted fw-500">{{ $brand->name }}</span>
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
                <!-- product similar  -->
                <div class="product-similar mb-3 text-muted {{ count($productSimilars) > 0 ? '' : 'd-none' }}">
                    <div class="title-product mb-4 col-xl-3 col-lg-4 col-10">
                        <div class="price-banner">
                            <div
                                class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                                <div class="price-icon">
                                    <i class="fa-solid fa-tags text-white"></i>
                                </div>
                                <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                    sản phẩm tương tự
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row flex-wrap">
                        @if (count($productSimilars) != 0 && !empty($productSimilars))
                            @foreach ($productSimilars as $key => $valProductSimilar)
                                @php
                                    $shownColors = [];
                                    $promotion =
                                        $valProductSimilar->del != 0 && $valProductSimilar->del != null
                                            ? (($valProductSimilar->price - $valProductSimilar->del) /
                                                    $valProductSimilar->price) *
                                                100
                                            : '0';
                                    //-- // lấy phiên bản đầu tiên của sản phẩm làm mặc định
                                    $variantFirst = $valProductSimilar->productVariant->first();
                                @endphp
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <div class="card card-product shadow-sm border-0 mb-2 pt-0">
                                        <div class="position-absolute z-1 w-100">
                                            <div class="head-card ps-0 d-flex justify-content-between">
                                                <span
                                                    class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $valProductSimilar->del == 0 || $valProductSimilar->del == null ? 'hidden-visibility' : '' }}">
                                                    - {{ round($promotion, 0) . '%' }}
                                                </span>
                                                <span class="text-end mt-2 me-2 text-muted toggleWishlist"
                                                    data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích"
                                                    data-id="{{ $product->id }}">
                                                    <i class="fa-regular fa-bookmark fz-16"></i>
                                                </span>
                                                <span class="product_variant_id_wishlist d-none">
                                                    @if (isset($product->productVariant) && $product->productVariant->isNotEmpty())
                                                        {{ $product->productVariant->first()->id ?? null }}
                                                    @endif
                                                </span>
                                                <span class="product_id_wishlist d-none">
                                                    {{ $product->id }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="image-main-product position-relative">
                                            <a href="{{ route('product.detail', ['slug' => $valProductSimilar->slug]) }}">
                                                <img src="{{ $valProductSimilar->image }}" alt="product image"
                                                    width="100%" height="250"
                                                    class="img-fluid object-fit-cover rounded-top-2"
                                                    style="height: 300px">
                                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                    <div class="hstack gap-3">
                                                        <div class="p-2 overflow-x-hidden w-50">
                                                            <span
                                                                class="fz-12 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                                {{ $valProductSimilar->productCatalogues[0]->name }}
                                                            </span>
                                                        </div>
                                                        <div class="p-2 ms-auto">
                                                            <div class="product-image-color ">
                                                                @foreach ($valProductSimilar->productVariant as $variant)
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
                                            <h6 class="fw-medium overflow-hidden " style="height: 35px">
                                                <a href="{{ route('product.detail', ['slug' => $valProductSimilar->slug]) }}"
                                                    class="text-break w-100 text-muted">{{ $valProductSimilar->name }}</a>
                                            </h6>
                                            <div class="d-flex justify-content-start mb-2 ">
                                                <span
                                                    class="text-danger fz-20 fw-medium me-3">{{ $valProductSimilar->del != 0 && $valProductSimilar->del != null ? number_format($valProductSimilar->del, '0', ',', '.') : number_format($valProductSimilar->price, '0', ',', '.') }}đ
                                                </span>
                                                <span class="mt-1 ">
                                                    <del
                                                        class="text-secondary fz-14 {{ $valProductSimilar->del == 0 && $valProductSimilar->del == null ? 'hidden-visibility' : '' }}">{{ number_format($valProductSimilar->price, '0', ',', '.') }}đ</del>
                                                </span>
                                            </div>
                                            <div class="box-action">
                                                <a href="{{ route('cart.index') }}"
                                                    class="action-cart-item-buy addToCart buyNow"
                                                    data-id="{{ $valProductSimilar->id }}"
                                                    data-product-variant-id="{{ $variantFirst->id }}"
                                                    data-product-variant-price="{{ $variantFirst->price }}"
                                                    data-attributeId="{{ @json_encode($variantFirst->code) }}">
                                                    <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                                    <span>Mua ngay</span>
                                                </a>
                                                <a href="" class="action-cart-item-add addToCart"
                                                    data-id="{{ $valProductSimilar->id }}"
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
                                                    class="ms-auto text-dark fw-500 fz-14">{{ $valProductSimilar->sku }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </article>
        <div class='modal fade' id='edit' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Chỉnh sửa đánh giá sản phẩm</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body' style="padding: 20px; font-family: Arial, sans-serif;">
                        <div class="comment-item"
                            style="background-color: #f9f9f9; border-radius: 8px; padding: 15px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                            <div class="item-two" style="margin-bottom: 15px;">
                                <div class="rating" style="display: flex; align-items: center;">
                                    <label for="rating-select"
                                        style="margin-right: 10px; font-weight: bold; color: #333;">Chất lượng sản
                                        phẩm:</label>
                                    <select id="rating-select" v-model="edit.publish"
                                        style="padding: 5px 10px; border-radius: 5px; border: 1px solid #ccc; outline: none; font-size: 16px;">
                                        <option selected value="0" style="color: #333;">--Chọn số sao--</option>
                                        <option style="color: gold;" value="1">&#9733;</option>
                                        <option style="color: gold;" value="2">&#9733;&#9733;</option>
                                        <option style="color: gold;" value="3">&#9733;&#9733;&#9733;</option>
                                        <option style="color: gold;" value="4">&#9733;&#9733;&#9733;&#9733;</option>
                                        <option style="color: gold;" value="5">&#9733;&#9733;&#9733;&#9733;&#9733;
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-input" style="margin-bottom: 15px;">
                                <label for="" style="margin-bottom: 10px; font-weight: bold; color: #333;">Nhập
                                    nội dung: </label>
                                <input v-model="edit.content" type="text" class="input-form"
                                    placeholder="Nhập nội dung bình luận của bạn!"
                                    style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; outline: none; font-size: 16px; color: #333;">
                            </div>
                            <div class="submit-btn" style="text-align: right;">
                                <button v-on:click="Update()" class="btn-submit"
                                    style="padding: 10px 20px; background-color: #14B6A0; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;"
                                    data-bs-dismiss='modal'>Gửi đánh giá</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // tuyền mảng id product và productvariant sang js đổ vào chuổi
        let productInWishlist = @json($productInWishlist); ///
        // truyền sản phẩm lên để lấy giá -> tính discount
        let product = @json($product);
    </script>
    
    
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                create: {},
                edit: {},
                list: [],
                image: null,
                likes: [],
                comment: 0,
                total_stars: 0,
                avg_stars: 0,
                likeCount: 0,

                check: 0,
                isLiked: false,
            },
            created() {
                this.LoadBinhLuan();
                this.LoadLike();
                this.Chekc();
            },
            methods: {

                toggleLike() {
                    this.isLiked = !this.isLiked;

                },
                LoadBinhLuan() {
                    const url = new URL(window.location.href);
                    const pathname = url.pathname;
                    const slug = pathname.split('/').filter(Boolean).pop();
                    axios
                        .get('/producreview-data/' + slug)
                        .then((res) => {
                            this.list = res.data.data;
                            this.comment = res.data.comment_count;
                            this.total_stars = res.data.total_stars;
                            this.avg_stars = res.data.average_stars;
                        });
                },
                LoadLike() {
                    const url = new URL(window.location.href);
                    const pathname = url.pathname;
                    const slug = pathname.split('/').filter(Boolean).pop();
                    axios
                        .get('/producreview/like-data/' + slug)
                        .then((res) => {
                            this.list = res.data.like_count;
                            // this.like_count = res.data.like_count;
                        })
                        .catch((res) => {})
                },
                Chekc() {
                    const url = new URL(window.location.href);
                    const pathname = url.pathname;
                    const slug = pathname.split('/').filter(Boolean).pop();
                    axios
                        .get('/product/check/' + slug)
                        .then((res) => {
                            this.check = res.data.check;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {});
                        })
                },
                Like(v) {
                    axios
                        .post('/producreview/like', v)
                        .then((res) => {
                            if (res.data.status) {
                                this.LoadLike();
                                this.likeCount = res.data.like_count;
                                toaster.success(res.data.message);
                            }
                        })
                        .catch((res) => {
                            // $.each(res.response.data.errors, function(k, v) {});
                        });
                },
                DanhGiaSP() {
                    const url = new URL(window.location.href);
                    const pathname = url.pathname;
                    const slug = pathname.split('/').filter(Boolean).pop();

                    axios
                        .post('/producreview/create/' + slug, this.create)
                        .then((res) => {
                            if (res.data.status) {
                                this.check = true;
                                this.create = {};
                                this.LoadBinhLuan();
                                this.Chekc();
                                toaster.success(res.data.message);
                            } else {}
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {});
                        });
                },
                Update() {
                    axios
                        .post('/producreview-update', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                alert(res.data.message);
                                this.LoadBinhLuan();
                            } 
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },

                formatDate(dateString) {
                    const options = {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false,
                    };

                    const date = new Date(dateString);
                    return date.toLocaleString('en-GB', options).replace(',', '');
                },
            },
        });
    </script>
@endsection
