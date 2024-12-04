@extends('fontend.home.layout')
@section('page_title')
    Giỏ hàng
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
                        <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                    </ol>
                </nav>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- content -->
                <div class="main-cart row flex-wrap text-muted pt-3 mx-0 mb-5">
                    @if ($countCart != 0)
                        <!-- có sản phẩm  -->
                        <div class="col-lg-8 col-md-12 col-sm-12 mb-md-4 mb-sm-3 ps-0 rounded-1">
                            <div class="card-header bg-light shadow-sm border-0 mb-3">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0 p-3">Giỏ hàng</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive bg-white shadow-sm p-2">
                                <table class="table align-middle table-hover h-100 cart">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="cart_id_check[]" type="checkbox"
                                                        id="check-all" value="">
                                                </div>
                                            </th>
                                            <th>Sản phẩm</th>
                                            <th class="text-end">Đơn giá</th>
                                            <th class="text-center">Số Lượng</th>
                                            <th class="text-end">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts->cartItems as $key => $cartItem)
                                            <tr class="cart-item" data-destroy-id="{{ $cartItem->id }}">
                                                <td scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input checkbox-item " type="checkbox"
                                                            name="checkbox-item[]" value="{{ $cartItem->id }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="card-body">
                                                        <div class="row gy-3">
                                                            <div class="col-sm-auto">
                                                                <div class="bg-light rounded p-1">
                                                                    @if ($cartItem->productVariants)
                                                                        <img src="{{ explode(',', $cartItem->productVariants->album)[0] }}"
                                                                            alt="image-product" width="90"
                                                                            height="90"
                                                                            class="d-block object-fit-cover rounded-2 text-break">
                                                                    @elseif ($cartItem->products)
                                                                        <img src="{{ $cartItem->products->image }}"
                                                                            alt="image-product" width="90"
                                                                            height="90"
                                                                            class="d-block object-fit-cover rounded-2">
                                                                    @else
                                                                        <img src="/libaries/upload/libaries/images/img-notfound.png"
                                                                            alt="Product Image" width="90"
                                                                            height="90"
                                                                            class="d-block object-fit-cover rounded-2">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm text-start" style="width: 250px;">
                                                                <p class="fz-16 text-break lh-sm fw-500 mb-2 overflow-hidden"
                                                                    style="max-height: 40px">
                                                                    <a href="#" class="text-muted">
                                                                        @if ($cartItem->productVariants)
                                                                            {{ $cartItem->productVariants->name }}
                                                                        @else
                                                                            {{ $cartItem->products->name }}
                                                                        @endif
                                                                    </a>
                                                                </p>
                                                                <ul class="list-inline text-muted fz-14 mb-1">
                                                                    @if (isset($attributesByCartItem[$cartItem->id]))
                                                                        @foreach ($attributesByCartItem[$cartItem->id] as $attribute)
                                                                            <li class="list-inline-item">
                                                                                {{ $attribute->name }}
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>

                                                                <a href="javascript:void(0)"
                                                                    class="d-block text-danger fz-14 destroyCart"
                                                                    data-id="{{ $cartItem->products->id ?? '' }}"
                                                                    data-variant-id="{{ $cartItem->productVariants->id ?? '' }}"
                                                                    data-destroy-id="{{ $cartItem->id }}">
                                                                    <i
                                                                        class="fa-solid fa-trash text-danger align-bottom me-1 mb-1"></i>
                                                                    <span class="mt-1 align-middle"> xóa</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <span class="product-price fw-medium text-muted"
                                                        data-price="{{ $cartItem->price }}">
                                                        {{ number_format($cartItem->price, 0, ',', '.') }}đ
                                                    </span>
                                                </td>

                                                <td class="text-center">
                                                    <div class="input-group componant-quantity justify-content-end shadow-sm flex-sm-wrap flex-xs-wrap flex-grow"
                                                        style="max-width: 130px; margin: 0 auto;">
                                                        <button class="quantity-minus updateCart w-md-100 rounded-3"
                                                            type="button" data-id="{{ $cartItem->id }}">
                                                            <i class='bx bx-minus fw-medium'></i>
                                                        </button>
                                                        @php
                                                            $maxQuantity = 0;
                                                            if ($cartItem->productVariants) {
                                                                $maxQuantity = $cartItem->productVariants->quantity;
                                                            } elseif ($cartItem->products) {
                                                                $maxQuantity = $cartItem->products->instock
                                                                    ? $cartItem->products->instock
                                                                    : 10;
                                                            }
                                                        @endphp
                                                        <input type="text" name="quantity-input"
                                                            class="form-control border-0 fz-20 text-center fw-600"
                                                            value="{{ $cartItem->quantity }}" min="1"
                                                            max="{{ $maxQuantity }}" style="max-width: 60px;"
                                                            data-quantity-cart="{{ $cartItem->quantity }}" readonly>
                                                        @if ($cartItem->productVariants)
                                                            <input type="hidden" name="product_variant_id"
                                                                class="product-variant-id"
                                                                value="{{ $cartItem->productVariants->id }}">
                                                            <input type="hidden" name="product_id" class="product-id"
                                                                value="">
                                                        @elseif ($cartItem->products)
                                                            <input type="hidden" name="product_variant_id"
                                                                class="product-variant-id" value="">
                                                            <input type="hidden" name="product_id" class="product-id"
                                                                value="{{ $cartItem->products->id }}">
                                                        @endif
                                                        <button class="quantity-plus updateCart w-md-100" type="button"
                                                            data-id="{{ $cartItem->id }}">
                                                            <i class='bx bx-plus'></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <span
                                                        class="fw-medium product-total-price">{{ number_format($cartItem->price * $cartItem->quantity, 0, ',', '.') }}đ</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="footer-cart d-flex justify-content-between align-items-center py-3">
                                    <a href="{{ route('shop.index') }}" class="back-to-product fz-14 text-muted ms-3">
                                        <i class="fa-solid fa-chevron-left fz-3 me-2"></i>
                                        <span>Xem sản phẩm</span>
                                    </a>
                                    @if ($countCart != 0)
                                        <a href="javascript:void(0)"
                                            class="back-to-product btn btn-outline-danger fz-14 rounded-1 clearCart"
                                            data-bs-toggle="modal" data-bs-target="#clearCartModal"
                                            data-cart-id="{{ $cartItem->cart_id }}">
                                            <i class="fa-solid fa-trash-alt fz-3 me-2"></i>
                                            <span>Xóa giỏ hàng</span>
                                        </a>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="clearCartModal" tabindex="-1"
                                        aria-labelledby="clearCartModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="clearCartModalLabel">Xóa toàn bộ sản
                                                        phẩm trong giỏ hàng</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="fz-16">Bạn có chắc chắn muốn xóa hết sản phẩm trong giỏ hàng
                                                        hay không?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="cancelClearCart"
                                                        class="btn btn-light rounded-1"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="button" id="confirmClearCart"
                                                        class="btn btn-danger rounded-1">Xác nhận xóa</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 pe-0 ps-lg-3 ps-md-3 ps-sm-0">
                            <div class="card border-0 rounded-2 shadow-sm">
                                <div class="card-header border-0 py-3">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-0">Đơn hàng</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless align-middle mb-0 order w-100">
                                            <tbody id="order_cart">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- giỏ hàng rỗng  -->
                        <div class="no-product text-center p-3">
                            <a href="#">
                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/image-add-to-cart.png"
                                    alt="" class="img-fluid object-fit-cover " width="200">
                                <div class="mt-1 text-white">
                                    <h6 class=" text-muted text-uppercase mb-2">Bạn chưa có sản phẩm nào!</h6>
                                    <a href="{{ route('shop.index') }}" class="btn btn-success"><i
                                            class="mdi mdi-home me-1"></i>Xem sản phẩm</a>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
                <hr class="border-2 mb-3">
                <!-- product similar  -->
                <div class="product-similar mb-3 text-muted">
                    <div class="title-product mb-4 col-lg-3 col-8">
                        <div class="price-banner">
                            <div
                                class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 d-flex align-items-center">
                                <div class="price-icon">
                                    <i class="fa-solid fa-fire text-white"></i>
                                </div>
                                <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                    Sản phẩm mới
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row flex-wrap">
                        @if (count($productNews) != 0 && !empty($productNews))
                            @foreach ($productNews as $key => $productNew)
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
                                                <a href="#"
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
            </div>
        </article>
    </section>
@endsection
