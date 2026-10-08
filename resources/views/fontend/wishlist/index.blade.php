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
                    <h4 class="fs-4 fw-500 mb-3 text-uppercase">
                        Danh sách yêu thích
                        <hr class=" border-4 border-info mb-2" style="width: 80px;">
                    </h4>
                </div>

                <!-- content detail -->
                <div class="row mb-3 flex-wrap bg-white text-muted mx-0">
                    <div class="col-lg-12 col-md-12 col-12 ">
                        <div class="product-category p-2">
                            <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fs-5 text-uppercase mt-2">Sản phẩm</h5>
                                <p class="filter-sub">
                                <div class="dropdown ms-auto" data-bs-spy="scroll" data-bs-target="#navbar-example3"
                                    data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <span class="text-muted fz-14 fw-medium me-2">Sắp xếp</span>
                                        <i class="fa-solid fa-sort fz-14 text-muted"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end ul-menu p-0 border-0 shadow-lg mb-1">
                                        <li class="li-menu-header p-1">
                                            <a href="?sort=price_high" class="text-decoration-none fz-12 ps-1">
                                                <i class="fa-solid fa-square-caret-down me-2"></i>Giá cao - thấp
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-1">
                                            <a href="?sort=price_low" class="text-decoration-none fz-12 ps-1">
                                                <i class="fa-solid fa-square-caret-up me-2"></i>Giá thấp - cao
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-1">
                                            <a href="?sort=newest" class="text-decoration-none fz-12 ps-1">
                                                <i class="fa-solid fa-clock-rotate-left me-2"></i>Mới nhất
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-1">
                                            <a href="?sort=oldest" class="text-decoration-none fz-12 ps-1">
                                                <i class="fa-solid fa-clock me-2"></i>Cũ nhất
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-1">
                                            <a href="?sort=name_desc" class="text-decoration-none fz-12 ps-1">
                                                <i class="fa-solid fa-sort-alpha-down me-2"></i>Ký tự Z - A
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-1">
                                            <a href="?sort=name_asc" class="text-decoration-none fz-12 ps-1">
                                                <i class="fa-solid fa-sort-alpha-up me-2"></i>Ký tự A - Z
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                                </p>
                            </div>
                            <div class="content-product-cate row flex-wrap">
                                @if ($wishlists->isNotEmpty())
                                    @foreach ($wishlists as $key => $wishlist)
                                        @php
                                            $product = $wishlist->products;
                                            $productVariant = $wishlist->productVariants;
                                            // dd($wishlist[2]);
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
                                            @endphp

                                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                                <div class="card card-product shadow-sm border-0 mb-2 pt-0">
                                                    <div class="position-absolute z-1 w-100">
                                                        <div class="head-card ps-0 d-flex justify-content-between">
                                                            <span
                                                                class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $promotion == '0' ? 'hidden-visibility' : '' }}">
                                                                giảm {{ round($promotion, 1) . '%' }}
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
                                                                        @if ($product)
                                                                            @foreach ($product->productCatalogues as $catalogue)
                                                                                {{ $catalogue->name }}
                                                                            @endforeach
                                                                        @else
                                                                            {{ $productVariant->product->productCatalogues->first()->name ?? 'N/A' }}
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
                                                                                            width="14" height="14"
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
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <h6 class="fw-medium overflow-hidden mb-0" style="height: 39px">
                                                            <a href="#"
                                                                class="text-break w-100 text-muted">{{ $item->name }}</a>
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
                                                        <div class="box-action">
                                                            <a href="{{ route('product.detail', ['slug' => $product ? $product->slug : $productVariant->product->slug]) }}"
                                                                class="action-cart-item-buy">
                                                                <span>Xem chi tiết</span>
                                                            </a>
                                                            <a href="#" class="action-cart-item-add addToCart"
                                                                data-id="{{ $item->id }}">
                                                                <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                                                <span>thêm giỏ hàng</span>
                                                            </a>
                                                        </div>
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
                                    <h3 class="text-center p-5">Bạn chưa có yêu thích nào.</h3>
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
@endsection
