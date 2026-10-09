@extends('fontend.home.layout')
@section('page_title')
    Tìm kiếm
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
                        <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="">
                    <h4 class=" mt-4 mb-5 w-100">
                        Kết quả tìm kiếm của bạn về " <span
                            class=" fs-4 fw-bold mb-3 text-uppercase text-truncate">{{ $keyword }} </span>"
                        <hr class=" border-4 border-info mb-2" style="width: 140px;">
                    </h4>
                </div>
                <!-- content detail -->
                <div class="row mb-3 flex-wrap bg-white text-muted mx-0">

                    @if ($type === 'product' && $results->isNotEmpty())
                        <div class="col-lg-12 col-md-12 col-12 ">
                            <div class="product-category p-2">
                                <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fs-5 text-uppercase mt-2">Sản phẩm</h5>
                                </div>
                                <div class="content-product-cate row flex-wrap">
                                    @foreach ($results as $key => $product)
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
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
                                            <div class="card card-product shadow-sm border-0 mb-2 py-0">
                                                <div class="position-absolute z-1 w-100">
                                                    <div class="head-card ps-0 d-flex justify-content-between">
                                                        <span
                                                            class="text-bg-danger mt-2 rounded-end ps-2 pe-2 pt-1 fz-10 {{ $product->del == 0 || $product->del == null ? 'hidden-visibility' : '' }}">
                                                            giảm {{ round($promotion, 1) . '%' }}
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
                                                        <img src="{{ $product->image }}" alt="product image" width="100%"
                                                            height="250" class="img-fluid object-fit-cover rounded-top-2"
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
                                                        <span class="text-danger fz-20 fw-medium me-3 product-variant-price"
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
                                </div>
                            </div>

                        </div>
                    @elseif($type === 'post' && $results->isNotEmpty())
                        <div class="col-lg-12 col-md-12 col-12 ">
                            <div class="product-category p-2">
                                <div class="title-product-category d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fs-5 text-uppercase mt-2">Bài viết</h5>
                                </div>
                                <div class="content-product-cate row flex-wrap">
                                    @foreach ($results as $key => $post)
                                        @php
                                            $created_at = $post->created_at;
                                            $now = now();
                                            $dayDiffer = date_diff($created_at, $now)->format('%a ngày trước');

                                            $author = optional($post->users()->first());
                                            $authorName = $author->name ? $author->name : $post->cre;
                                            $imageAuthor =
                                                $author->image ??
                                                '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif';
                                        @endphp

                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="post-item shadow-sm rounded-2 w-100 mb-4">
                                                <a href="{{ route('post.detail', ['slug' => $post->slug]) }}">
                                                    <img src="{{ $post->image }}" alt=""
                                                        class="img-fluid object-fit-cover rounded-top-3" width="100%"
                                                        style="height: 200px !important;">
                                                    <div class="content-card-post text-muted p-2 bg-white rounded-bottom-3">
                                                        <h6 class="fz-18 title-post overflow-hidden mb-2 "
                                                            style="height: 43px;">
                                                            {{ $post->name }}</h6>
                                                        <span class="align-middle fz-12 me-3 fw-medium">
                                                            <img src="{{ $imageAuthor }}" alt="author post" width="30"
                                                                height="30"
                                                                class="rounded-circle mb-1 me-2">{{ $authorName }}
                                                        </span>
                                                        <span class="align-middle fz-12">
                                                            <i class="fa-regular fa-clock fz-12 me-2"></i>
                                                            {{ $dayDiffer }}
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="d-flex justify-content-end pagination pagination-sm">
                        {{ $results->appends(request()->except('page'))->onEachSide(3)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @if ($results->isEmpty())
                    <div class="order-null p-3">
                        <div class="img-null text-center">
                            <img src="/libaries/upload/images/order-null.png" alt="" class=""
                                width="300" height="200">
                        </div>
                        <div class="flex flex-col text-center align-items-center">
                            <h5 class="mb-2  fw-semibold">Tạm thời không có bản ghi phù hợp!
                            </h5>
                            <p class="text-center mb-2">
                                Hãy khám phá những những gì có trong website nhé!
                            </p>
                            @if ($type === 'post')
                                <a href="{{ route('post.page') }}" class="btn btn-info text-white rounded-pill mt-3">Khám
                                    phá ngay </a>
                            @elseif($type === 'product')
                                <a href="{{ route('shop.index') }}"
                                    class="btn btn-info text-white rounded-pill mt-3">Khám
                                    phá ngay </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </article>
    </section>
@endsection
