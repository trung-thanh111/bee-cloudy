@extends('fontend.home.layout')
@section('page_title')
    Danh sách yêu thích
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="{{ route('home.index') }}"
                                class="text-decoration-none text-muted">Trang chủ </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Yêu thích</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="whistlist">
                    <div class="title-product mb-4 col-lg-3 col-6">
                        <div class="price-banner">
                            <div
                                class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                                <div class="price-icon">
                                    <i class="fa-solid fa-fire text-white"></i>
                                </div>
                                <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                    Yêu thích
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- content detail -->
                <div class="row mb-3 flex-wrap bg-white text-muted mx-0">
                    <div class="col-lg-12 col-md-12 col-12 ">
                        <div class="product-category p-2">
                            <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fs-5 text-uppercase mt-2">Sản phẩm</h5>
                            </div>
                            <div class="content-product-cate row flex-wrap">
                                @if ($wishlists->isNotEmpty())
                                    @foreach ($wishlists as $key => $wishlist)
                                        @php
                                            $product = $wishlist->products;
                                            $productVariant = $wishlist->productVariants;
                                        @endphp

                                        @if ($product != null || $productVariant != null)
                                            @php
                                                if ($product) {
                                                    $item = $product;
                                                    $price =
                                                        $item->del != 0 && $item->del != null
                                                            ? number_format($item->del, '0', ',', '.')
                                                            : number_format($item->price, '0', ',', '.');
                                                    $promotion =
                                                        $item->del != 0 && $item->del != null
                                                            ? (($item->price - $item->del) / $item->price) * 100
                                                            : '0';
                                                } else {
                                                    $item = $productVariant;
                                                    $price = number_format($item->price, '0', ',', '.');
                                                    $promotion = '0';
                                                }
                                                //-- // lấy phiên bản đầu tiên của sản phẩm làm mặc định
                                                $variantFirst = $product ? $product->productVariant->first() : null;
                                            @endphp

                                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
                                                <div class="card card-product shadow-sm border-0 mb-2 py-0">
                                                    <div class="position-absolute z-1 w-100">
                                                        <div class="head-card ps-0 d-flex justify-content-between">
                                                            <span
                                                                class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $promotion == '0' ? 'hidden-visibility' : '' }}">
                                                                -  {{ round($promotion, 0) . '%' }}
                                                            </span>
                                                            <span class="text-end mt-2 me-2 text-muted toggleWishlist"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-title="{{ in_array($item->id, $productInWishlist) ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' }}"
                                                                data-id="{{ $item->id }}">
                                                                <i
                                                                    class="fa-{{ in_array($item->id, $productInWishlist) ? 'solid' : 'regular' }} fa-bookmark fz-16"></i>
                                                                <span
                                                                    class="product_id_wishlist d-none">{{ $item->id }}</span>
                                                                <span
                                                                    class="product_variant_id_wishlist d-none">{{ $productVariant ? $productVariant->id : '' }}</span>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="image-main-product position-relative">
                                                        <a
                                                            href="{{ route('product.detail', ['slug' => $product ? $product->slug : $productVariant->product->slug]) }}">
                                                            <img src="{{ $item->image ?? explode(',', $item->album)[0] }}"
                                                                alt="product image" width="100%" height="250"
                                                                class="img-fluid object-fit-cover rounded-top-2"
                                                                style="height: 300px">
                                                            <div
                                                                class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                                                <div class="hstack gap-3">
                                                                    <div class="p-2 overflow-x-hidden">
                                                                        <span
                                                                            class="fz-12 text-uppercase text-bg-light rounded-2 px-2 py-1 fw-600">
                                                                            @if ($product && $product->productCatalogues->isNotEmpty())
                                                                                {{ $product->productCatalogues->first()->name }}
                                                                            @elseif ($productVariant && $productVariant->product->productCatalogues->isNotEmpty())
                                                                                {{ $productVariant->product->productCatalogues->first()->name }}
                                                                            @else
                                                                                {{ 'Chưa xác định' }}
                                                                            @endif

                                                                        </span>
                                                                    </div>
                                                                    <div class="p-2 ms-auto">
                                                                        <div class="product-image-color">
                                                                            @if ($product)
                                                                                @php $shownColors = []; @endphp
                                                                                @foreach ($product->productVariant as $variant)
                                                                                    @foreach ($variant->attributes as $attribute)
                                                                                        @if ($attribute->attribute_catalogue_id == 1 && !in_array($attribute->name, $shownColors))
                                                                                            <img src="{{ $attribute->image }}"
                                                                                                alt="{{ $attribute->name }}"
                                                                                                width="14"
                                                                                                height="14"
                                                                                                class="rounded-circle border border-2 border-info object-fit-cover me-1">
                                                                                            @php $shownColors[] = $attribute->name; @endphp
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endforeach
                                                                            @else
                                                                                @foreach ($productVariant->attributes as $attribute)
                                                                                    @if ($attribute->attribute_catalogue_id == 1)
                                                                                        <img src="{{ $attribute->image }}"
                                                                                            alt="{{ $attribute->name }}"
                                                                                            width="14" height="14"
                                                                                            class="rounded-circle border border-2 border-info object-fit-cover me-1">
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <h6 class="fw-medium overflow-hidden mb-0" style="height: 39px">
                                                            <a href="{{ route('product.detail', ['slug' => $product ? $product->slug : $productVariant->product->slug]) }}"
                                                                class="text-break w-100 text-muted">{{ $item->name }}</a>
                                                            <h4 class="fs-4 fw-bold mb-1 product-variant-id d-none">
                                                                {{ $productVariant ? $productVariant->id : '' }}
                                                            </h4>
                                                        </h6>
                                                        <div class="d-flex justify-content-start mb-2 ">
                                                            <span
                                                                class="text-danger fz-20 fw-medium me-3 product-variant-price"
                                                                data-price="{{ $price }}">{{ $price }}đ</span>
                                                            @if ($product && $product->del != 0 && $product->del != null)
                                                                <span class="mt-1">
                                                                    <del
                                                                        class="text-secondary fz-14">{{ number_format($product->price, '0', ',', '.') }}đ</del>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        @if ($wishlist->products !== null)
                                                            <div class="box-action">
                                                                <a href="{{ route('cart.index') }}"
                                                                    class="action-cart-item-buy addToCart buyNow"
                                                                    data-id="{{ $product ? $product->id : 0 }}"
                                                                    data-product-variant-id="{{ $variantFirst ? $variantFirst->id : '' }}"
                                                                    data-product-variant-price="{{ $variantFirst ? $variantFirst->price : '' }}"
                                                                    data-attributeId="{{ $variantFirst ? @json_encode($variantFirst->code) : '' }}">
                                                                    <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                                                    <span>Mua ngay</span>
                                                                </a>
                                                                <a href="" class="action-cart-item-add addToCart"
                                                                    data-id="{{ $product ? $product->id : 0 }}"
                                                                    data-product-variant-id="{{ $variantFirst ? $variantFirst->id : '' }}"
                                                                    data-product-variant-price="{{ $variantFirst ? $variantFirst->price : '' }}"
                                                                    data-attributeId="{{ $variantFirst ? @json_encode($variantFirst->code) : '' }}">
                                                                    <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                                                    <span>thêm giỏ hàng</span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <div class="head-card d-flex p-1">
                                                            <span class="fz-14 ">Mã sản phẩm</span>
                                                            <span
                                                                class="ms-auto text-dark fw-500 fz-14">{{ $item->sku }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="order-null p-3">
                                        <div class="img-null text-center">
                                            <img src="/libaries/upload/images/order-null.png" alt=""
                                                class="" width="300" height="200">
                                        </div>
                                        <div class="flex flex-col text-center align-items-center">
                                            <h5 class="mb-2 fw-semibold">Bạn chưa có yêu thích nào!
                                            </h5>
                                            <p>Hãy khác phá để có những sản phẩm ưng ý với bạn!</p>
                                            <a href="{{ route('shop.index') }}"
                                                class="btn btn-info text-white rounded-pill mt-3 pz-3">Khám phá ngay</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end ">
                            {{ $wishlists->onEachSide(3)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
