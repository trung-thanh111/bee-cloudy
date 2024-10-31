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
                    $variantId = 0;
                    foreach ($product->productVariant as $variant) {
                        $totalSoldCount += $variant->sold_count;
                        $variantId = $variant->id;
                    }

                    foreach ($product->productVariant as $variant) {
                        $totalReviewCount += $variant->rating_count;
                    }
                    // -- //
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
                                {{-- @dd($variantId) --}}
                                <div class="box-favourite position-absolute z-3 toggleWishlist" data-bs-toggle="tooltip"
                                    data-bs-title="{{ in_array($variantId, $productInWishlist) ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' }}">
                                    <div class="position-relative">
                                        <a href="#" class="position-absolute start-50 translate-middle border-0"
                                            style="top: 20px;">
                                            <i
                                                class="icon-favourite fa-{{ in_array($variantId, $productInWishlist) ? 'solid' : 'regular' }} fa-bookmark fz-20 text-muted  "></i>
                                        </a>

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
                                {{-- @if (isset($product->productVariant) && $product->productVariant->isNotEmpty())
                                        {{ $product->productVariant->first()->id ?? null }}
                                    @endif --}}
                                <div class="hstack gap-3 fz-14 flex-wrap">
                                    <div class="py-2">Đánh giá ({{ $totalReviewCount }})</div>
                                    <div class="py-2">
                                        <span><i class="fa-solid fa-star rated"></i></span>
                                        <span><i class="fa-solid fa-star rated"></i></span>
                                        <span><i class="fa-solid fa-star rated"></i></span>
                                        <span><i class="fa-solid fa-star rated"></i></span>
                                        <span><i class="fa-solid fa-star rated"></i></span>
                                    </div>
                                    <div class="vr " style="width: 1px !important;"></div>
                                    <div class="py-2">
                                        <span class="fw-500">Đã bán:</span>
                                        <span class="product-variant-sold">{{ $totalSoldCount . ' ' }} sản phẩm</span>
                                    </div>
                                </div>
                            </div>
                            <h4 class="fs-5 py-3">
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
                                                            class="choose-attribute {{ $keyAttr == 0 ? 'active' : '' }}  {{ $val->id == 1 ? 'color-item' : 'size-item' }} "
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
                            {{-- <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="">
                                <input type="hidden" name="price" value="">
                            </form> --}}
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
                                                                <span class="fz-14 text-warning mx-2">Đây chỉ là bảng
                                                                    size
                                                                    mô phỏng, độ chính xác tương đối.</span>
                                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/bang-size-ao.jpg"
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
                                        <span class="fw-medium fz-18">Số lượng</span>
                                    </div>
                                    <div class=" hstack gap-3 ps-5 flex-sm-wrap flex-xs-wrap flex-md-wrap mb-3">
                                        <div class="input-group componant-quantity shadow-sm flex-grow mb-3 w-25">
                                            <button class="quantity-minus w-md-100 rounded-3 " type="button"
                                                id="button-addon1">
                                                <i class='bx bx-minus fw-medium'></i>
                                            </button>
                                            <input type="text" name="quantity-product-variant w-sm-25"
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
                                    <div class="mb-3 w-100">
                                        <a type="submit" href="#" class="btn w-100 btn-success fw-medium fz-18">
                                            <i class="fa-solid fa-cart-shopping me-2"></i>Mua Ngay
                                            <p class="fz-14 fw-normal mb-0"> Giao hàng tận nơi hoặc nhận tại cửa hàng
                                            </p>
                                        </a>
                                        <div class="row w-100 mt-2 ms-0">
                                            <div class="col px-0 w-100 ">
                                                <a href="#" class="addToCart" data-id="{{ $product->id }}">
                                                    <!-- d-none d-md-inline-block: Ẩn trên màn hình nhỏ hơn md (< 768px), chỉ hiển thị từ kích thước màn hình md (>= 768px) trở lên. -->
                                                    <button
                                                        class=" btn btn-outline-success py-2 w-100 fz-18 fw-medium shadow-sm d-none d-md-inline-block">Thêm
                                                        vào giỏ hàng</button>
                                                    <!-- d-block d-md-none: Hiển thị trên các màn hình nhỏ hơn md (< 768px), bao gồm màn hình < 480px. -->
                                                    <button
                                                        class="btn btn-outline-success py-2 w-100 fz-18 fw-medium shadow-sm d-block d-md-none "
                                                        data-bs-toggle="tooltip" data-bs-title="Thêm vào giỏ hàng"><i
                                                            class="fa-solid fa-cart-plus "></i></button>
                                                </a>
                                            </div>
                                            <div class="col pe-0">
                                                <a href="#">
                                                    <button
                                                        class="btn btn-outline-success py-2 w-100 fz-18 fw-medium shadow-sm">Mua
                                                        Trả Góp</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="commit-quality mb-5">
                    <div class="container text-start">
                        <div class="row flex-wrap">
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                                <div
                                    class="commit-quality-item shadow-sm bg-white d-flex justify-content-start align-items-center text-muted p-4 rounded-2">
                                    <i class="fa-solid fa-truck-fast me-3 fs-2"></i>
                                    <span class="fs-6 fw-medium text-truncate">Miễn phí vận chuyển</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                                <div
                                    class="commit-quality-item shadow-sm bg-white d-flex justify-content-start align-items-center text-muted p-4 rounded-2">
                                    <i class='fa-solid fa-barcode me-3 fs-2'></i>
                                    <span class="fs-6 fw-medium text-truncate">Bảo hành 6 tháng</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                                <div
                                    class="commit-quality-item shadow-sm bg-white d-flex justify-content-start align-items-center text-muted p-4 rounded-2">
                                    <i class='bx bx-archive me-3 fs-2'></i>
                                    <span class="fs-6 fw-medium text-truncate">Đổi trả hàng trong 7 ngày</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                                <div
                                    class="commit-quality-item shadow-sm bg-white d-flex justify-content-start align-items-center text-muted p-4 rounded-2">
                                    <i class="fa-solid fa-money-bill-wave me-3 fs-2"></i>
                                    <span class="fs-6 fw-medium text-truncate">Đổi trả hàng hóa</span>
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
                        <div class="accordion shadow-sm  text-muted mb-5 rounded-2 border-0"
                            id="default-accordion-example">
                            <div class="accordion-item border-secondary material-shadow ">
                                <h2 class="accordion-header border-0" id="headingOne">
                                    <button class="accordion-button fz-16 fw-500 text-dark" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <span class="">Mô tả sản phẩm </span>

                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                                    data-bs-parent="#default-accordion-example">
                                    <div class="accordion-body bg-light fz-14">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                {{-- <div class="py-2 me-3">
                                                    <span class="fw-500 fz-16">Đánh giá </span>
                                                </div> --}}
                                                <div class="item-two">
                                                    <div class="rating">
                                                        <label style="margin-right: 5px" for="rating-select">Chất lượng
                                                            sản phẩm: </label>
                                                        <select id="rating-select" v-model="create.publish">
                                                            <option selected value="0" style="color: black">--Chọn số
                                                                sao--</option>
                                                            <option class="star" value="1">&#9733;</option>
                                                            <option class="star" value="2">&#9733;&#9733;</option>
                                                            <option class="star" value="3">&#9733;&#9733;&#9733;
                                                            </option>
                                                            <option class="star" value="4">
                                                                &#9733;&#9733;&#9733;&#9733;</option>
                                                            <option class="star" value="5">
                                                                &#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-comment ">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-12 d-block justify-content-center">
                                                    <button type="button" class="btn border-0 px-0">
                                                        <span class="d-block align-items-center">
                                                            <img class="rounded-circle header-profile-user"
                                                                src="/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif"
                                                                alt="Avatar User" class="rounded-circle object-fit-cover"
                                                                width="60" height="60">
                                                            <p class="text-center mt-2">
                                                                @if (Auth::check())
                                                                    <span
                                                                        class="d-none d-xl-inline-block ms-1 fw-medium text-muted">{{ Auth::user()->name }}</span>
                                                                @endif
                                                            </p>
                                                        </span>
                                                    </button>
                                                </div>
                                                <div
                                                    class="col-lg-10 col-md-10 col-12 d-block justify-content-center ps-0">
                                                    <form>
                                                        <div class="form-group position-relative ">
                                                            <textarea v-model="create.content" class=" textarea-comment form-control rounded-2  shadwo-sm" id="comment"
                                                                rows="4" placeholder="Hãy cho chúng tôi biết ban đang nghĩ gì?"></textarea>
                                                            <button type="button"
                                                                class="btn btn-success position-absolute z-3  py-1 px-4"
                                                                style="bottom: 8px ; right: 20px;"
                                                                v-on:click="DanhGiaSP()">Gửi</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-coment mt-3 mb-2">
                                            <div class="py-2 me-3 mb-3">
                                                <span class="fw-500 fz-16 ">Xem đánh giá (@{{ comment }})</span>
                                            </div>
                                            <template v-for="(v,k) in list">
                                                <div class="row mx-2">
                                                    <div
                                                        class="col-lg-2 col-md-2 col-12 d-flex justify-content-end align-items-start">
                                                        <button type="button" class="btn  border-0 px-0">
                                                            <span class="d-block justify-content-end align-items-center">
                                                                <img class="rounded-circle header-profile-user"
                                                                    src="/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif"
                                                                    alt="Avatar User"
                                                                    class="rounded-circle object-fit-cover" width="50"
                                                                    height="50">
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
                                                                        <h6 class="fz-18 mb-0">@{{ v.name }}</h6>
                                                                    </div>
                                                                    <div class="pt-2 d-inline-block">
                                                                        <option class="star" :value="v.publish">
                                                                            <span
                                                                                v-html=" '&#9733;'.repeat(v.publish) "></span>
                                                                        </option>
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
                                                                            <template v-if="v.edit_count == 0">
                                                                                <li class="p-1"
                                                                                    v-on:click="edit = Object.assign({},v)"
                                                                                    data-bs-toggle='modal'
                                                                                    data-bs-target='#edit'>
                                                                                    <a href="#"
                                                                                        class="text-decoration-none text-muted fz-14 ps-1">
                                                                                        <i
                                                                                            class="fa-solid fa-circle-info me-2"></i>Chỉnh
                                                                                        sửa
                                                                                    </a>
                                                                                </li>
                                                                            </template>
                                                                            <template v-if="v.edit_count ==1">
                                                                                <li class="p-1">
                                                                                    <a
                                                                                        class="text-decoration-none text-muted fz-14 ps-1">
                                                                                        <i
                                                                                            class="fa-solid fa-circle-info me-2"></i>Đã
                                                                                        chỉnh sửa
                                                                                    </a>
                                                                                </li>
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
                                                                <div class="icon-reaction pb-2">
                                                                    <button v-on:click="Like(k)" :id="'likeBtn-' + k">
                                                                        <i class="fa-regular fa-heart me-2"></i>
                                                                    </button>
                                                                    <span :id="'likeCount-' + k">0</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <!-- item review  -->

                                            <!-- phân trang bình luận  -->
                                            <div class="d-flex justify-content-center align-items-center mt-3">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination pagination-sm">
                                                        <li class="page-item">
                                                            <a class="page-link" href="#" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                        <li class="page-item"><a class="page-link active"
                                                                href="#">1</a>
                                                        </li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a>
                                                        </li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#" aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aside-product-detail col-lg-4 col-md-12 col-12">
                        <div class="card border-0 rounded-1 shadow-sm mb-4">
                            <div class="card-header">
                                <h6 class="card-title fw-18 fw-500">Voucher</h6>
                            </div>
                            <div class="card-body py-2">
                                <div class="voucher-item mb-3">
                                    <ul class="ps-0 mb-0">
                                        <li class="list-unstyled d-flex justify-content-start text-muted mb-2">
                                            <div class="image-voucher-item ">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/voucher1.avif"
                                                    alt="" width="80" class="img-fuild  me-2">
                                            </div>
                                            <div class="title-date-voucher">
                                                <div class="col">
                                                    <h6 class="fz-16 pb-2">Giảm 50% cho đơn hàng đầu tiên của tài khoản
                                                        đăng ký </h6>
                                                </div>
                                                <div class="col d-flex justify-content-between align-items-center">
                                                    <p class="fz-12">Hạn sử dụng: <strong>3 ngày</strong></p>
                                                    <a href="#" class="">
                                                        <button
                                                            class="btn rounded-2 btn-info fz-12 fw-medium text-white">Sử
                                                            dụng</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="voucher-item mb-3">
                                    <ul class="ps-0 mb-0">
                                        <li class="list-unstyled d-flex justify-content-start text-muted mb-2">
                                            <div class="image-voucher-item me-2">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/voucher1.avif"
                                                    alt="" width="80" class="img-fuild  me-2">
                                            </div>
                                            <div class="title-date-voucher">
                                                <div class="col">
                                                    <h6 class="fz-16 pb-2">Giảm 50% cho đơn hàng đầu tiên của tài khoản
                                                        đăng ký </h6>
                                                </div>
                                                <div class="col d-flex justify-content-between align-items-center">
                                                    <p class="fz-12">Hạn sử dụng: <strong>3 ngày</strong></p>
                                                    <a href="#" class="">
                                                        <button
                                                            class="btn rounded-2 btn-info fz-12 fw-medium text-white">Sử
                                                            dụng</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="voucher-item mb-3">
                                    <ul class="ps-0 mb-0">
                                        <li class="list-unstyled d-flex justify-content-start text-muted mb-2">
                                            <div class="image-voucher-item me-2">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/voucher1.avif"
                                                    alt="" width="80" class="img-fuild  me-2">
                                            </div>
                                            <div class="title-date-voucher">
                                                <div class="col">
                                                    <h6 class="fz-16 pb-2">Giảm 50% cho đơn hàng đầu tiên của tài khoản
                                                        đăng ký </h6>
                                                </div>
                                                <div class="col d-flex justify-content-between align-items-center">
                                                    <p class="fz-12">Hạn sử dụng: <strong>3 ngày</strong></p>
                                                    <a href="#" class="">
                                                        <button
                                                            class="btn rounded-2 btn-info fz-12 fw-medium text-white">Sử
                                                            dụng</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 rounded-1 shadow-sm mb-4">
                            <div class="card-header">
                                <h6 class="card-title fw-18 fw-500">Danh mục</h6>
                            </div>
                            <div class="card-body p-1">
                                <div class="categoryP-item mb-3 overflow-y-scroll">
                                    <ul class="list-group list-group-flush">
                                        @if (!is_null($categories) && !empty($categories))
                                            @foreach ($categories as $category)
                                                <li class="list-group-item">
                                                    <a href="#"
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
                                <div class="brand-item mb-3 overflow-y-scroll">
                                    <ul class="list-group list-group-flush">
                                        @if (!is_null($brands) && !empty($brands))
                                            @foreach ($brands as $brand)
                                                <li class="list-group-item">
                                                    <a href="#"
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
                <div class="product-similar mb-3 text-muted">
                    <div class="title-product-similar mb-4">
                        <h6 class="fs-3 fw-bold text-muted">Sản phẩm tương tự</h6>
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
                                @endphp
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <div class="card card-product shadow-sm border-0 mb-2 pt-0">
                                        <div class="position-absolute z-1 w-100">
                                            <div class="head-card ps-0 d-flex justify-content-between">
                                                <span
                                                    class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $valProductSimilar->del == 0 || $valProductSimilar->del == null ? 'hidden-visibility' : '' }}">
                                                    giảm {{ round($promotion, 1) . '%' }}
                                                </span>
                                                <span class="text-end mt-2 me-2 text-muted toggleWishlist"
                                                    data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích"
                                                    data-id="{{ $product->id }}">
                                                    <i class="fa-regular fa-bookmark fz-16"></i>
                                                </span>
                                                <span class="product_variant_id_wishlist">
                                                    @if (isset($product->productVariant) && $product->productVariant->isNotEmpty())
                                                        {{ $product->productVariant->first()->id ?? null }}
                                                    @endif
                                                </span>
                                                <span class="product_id_wishlist">
                                                    {{ $product->id }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="image-main-product position-relative">
                                            <img src="{{ $valProductSimilar->image }}" alt="product image"
                                                width="100%" height="250"
                                                class="img-fluid object-fit-cover rounded-top-2" style="height: 300px">
                                            <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                <div class="hstack gap-3">
                                                    <div class="p-2 overflow-x-hidden w-50">
                                                        <span
                                                            class="fz-14 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                            @foreach ($valProductSimilar->productCatalogues as $catalogue)
                                                                {{ $catalogue->name }}
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                    <div class="p-2 ms-auto">
                                                        <div class="product-image-color ">
                                                            @foreach ($valProductSimilar->productVariant as $variant)
                                                                @foreach ($variant->attributes as $attribute)
                                                                    @if ($attribute->attribute_catalogue_id == 1 && !in_array($attribute->name, $shownColors))
                                                                        <img src="{{ $attribute->image }}"
                                                                            alt="{{ $attribute->name }}" width="14"
                                                                            height="14"
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
                                                <a href="{{ route('product.detail', ['slug' => $valProductSimilar->slug]) }}"
                                                    class="action-cart-item-buy">
                                                    <span>Xem chi tiết</span>
                                                </a>
                                                <a href="#" class="action-cart-item-add">
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
                    <div class='modal-body'>
                        <div class="comment-item">
                            <div class="item-two">
                                <div class="rating">
                                    <label style="margin-right: 5px" for="rating-select">Chất lượng sản phẩm: </label>
                                    <select id="rating-select" v-model="edit.publish">
                                        <option selected value="0" style="color: black">--Chọn số sao--</option>
                                        <option class="star" value="1">&#9733;</option>
                                        <option class="star" value="2">&#9733;&#9733;</option>
                                        <option class="star" value="3">&#9733;&#9733;&#9733;</option>
                                        <option class="star" value="4">&#9733;&#9733;&#9733;&#9733;</option>
                                        <option class="star" value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-input">
                                <input v-model="edit.content" style="width: 460px;outline: none;" type="text"
                                    class="input-form" placeholder="Nhập nội dung bình luận của bạn!">
                            </div>
                            <div class="submit-btn">
                                <button v-on:click="Update()" class="btn-submit"
                                    style="background-color: red;color: #fff" data-bs-dismiss='modal'>Gửi đánh
                                    giá</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // tuyền mảng id product và productvariant sang js đổ vào chuổi
        let productInWishlist = @json($productInWishlist);
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
                imagePath: '',
            },
            created() {
                this.LoadBinhLuan();
            },
            methods: {

                LoadBinhLuan() {
                    const pathname = window.location.pathname;
                    const slug = pathname.substring(pathname.lastIndexOf('/') + 1);
                    axios
                        .get('/producreview-data/' + slug, )
                        .then((res) => {
                            this.list = res.data.data;
                            this.comment = res.data.comment_count;
                        });
                },
                DanhGiaSP() {
                    const pathname = window.location.pathname;
                    const slug = pathname.substring(pathname.lastIndexOf('/') + 1);
                    axios
                        .post('/producreview/create/' + slug, this.create)
                        .then((res) => {
                            if (res.data.status) {
                                // alert(res.data.message);
                                this.create = {};
                                this.LoadBinhLuan();
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
                                this.create = {};
                                this.LoadBinhLuan();
                            } else {}
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                Like(k) {
                    if (this.likes[k] === 0) {
                        this.likes[k] = 1;
                    } else {
                        this.likes[k] = 0;
                    }
                    let likeCountElement = document.getElementById('likeCount-' + k);
                    likeCountElement.textContent = this.likes[k];

                    let heartIcon = document.getElementById('likeBtn-' + k).querySelector('i');
                    if (this.likes[k] === 1) {
                        heartIcon.classList.remove('fa-regular');
                        heartIcon.classList.add('fa-solid');
                    } else {
                        heartIcon.classList.remove('fa-solid');
                        heartIcon.classList.add('fa-regular');
                    }
                },
                formatDate(dateString) {
                    const options = {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        p
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
