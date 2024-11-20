@extends('fontend.home.layout')
@section('page_title')
    Thanh toán
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0 w-100">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="{{ route('cart.index') }}" class="text-decoration-none text-muted">Giỏ hàng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <!-- content -->
                <form action="{{ route('store.order') }}" method="POST">
                    @csrf
                    <div class="main-cart row flex-wrap text-muted pt-3 mx-0 mb-5">
                        <div class="col-lg-8 col-md-12 col-sm-12 mb-md-4 mb-sm-3 ps-0 rounded-1">
                            <div class="card-header bg-light shadow-sm border-0 mb-3">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0 p-3">Thanh toán đơn hàng</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive bg-white shadow-sm">
                                <div class="step-arrow-nav mb-3">
                                    <ul class="nav nav-tabs nav-justified custom-nav ps-0 " role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button"
                                                class="text-uppercase nav-link fz-14 px-2 py-3 rounded-0 text-bg-light active show"
                                                data-bs-toggle="tab" data-bs-target="#info">
                                                <i
                                                    class="fa-solid fa-user fs-16 p-2 bg-secondary-subtle text-secondary rounded-circle align-middle me-2"></i>
                                                Thông tin
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button"
                                                class="text-uppercase nav-link fz-14 px-2 py-3 rounded-0 text-bg-light"
                                                data-bs-toggle="tab" data-bs-target="#payment_method">
                                                <i
                                                    class="fa-solid fa-building-columns fs-16 p-2 bg-secondary-subtle text-secondary rounded-circle align-middle me-2"></i>
                                                phương thức
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end tab content -->
                                <div class="tab-content p-3">
                                    <div class="tab-pane fade active show" id="info">
                                        <div>
                                            <h5 class="mb-1">Thông tin thanh toán</h5>
                                            <p class="text-muted mb-4 fz-14">Vui lòng điền đẩy đủ thông tin bên dưới</p>
                                        </div>
                                        <div>
                                            @php
                                                $user = Auth::user();
                                            @endphp
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-firstName" class="form-label">Họ và tên
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            id="billinginfo-firstName" name="full_name"
                                                            placeholder="Họ và tên"
                                                            value="{{ old('full_name', $user->name) }}">
                                                        @if ($errors->has('full_name'))
                                                            <span
                                                                class="text-danger fz-12 mt-1">{{ $errors->first('full_name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-email" class="form-label">Email <span
                                                                class="text-muted">(*)</span></label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="billinginfo-email" placeholder="Nhập email"
                                                            value="{{ old('email', $user->email) }}">
                                                        @if ($errors->has('email'))
                                                            <span
                                                                class="text-danger fz-12 mt-1">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-phone" class="form-label">Số điện
                                                            thoại</label>
                                                        <input type="text" class="form-control" name="phone"
                                                            id="billinginfo-phone" placeholder="Nhập số điện thoại"
                                                            value="{{ old('phone', $user->phone) }}">
                                                        @if ($errors->has('phone'))
                                                            <span
                                                                class="text-danger fz-12 mt-1">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tỉnh/Thành Phố</label>
                                                        <select name="province_id" id="province"
                                                            class="form-control setUpSelect2">
                                                        </select>
                                                        @if ($errors->has('province'))
                                                            <span
                                                                class="text-danger fz-12 mt-1">{{ $errors->first('province') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Quận/Huyện</label>
                                                        <select name="district_id" id="district"
                                                            class="form-control setUpSelect2">
                                                        </select>
                                                        @if ($errors->has('district'))
                                                            <span
                                                                class="text-danger fz-12 mt-1">{{ $errors->first('district') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Phường/Xã</label>
                                                        <select name="ward_id" id="ward"
                                                            class="form-control setUpSelect2">
                                                        </select>
                                                        @if ($errors->has('ward'))
                                                            <span
                                                                class="text-danger fz-12 mt-1">{{ $errors->first('ward') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <input type="hidden" name="province_name" id="province_name"
                                                    value="">
                                                <input type="hidden" name="district_name" id="district_name"
                                                    value="">
                                                <input type="hidden" name="ward_name" id="ward_name" value="">

                                            </div>
                                            <div class="mb-3">
                                                <label for="billinginfo-address" class="form-label">Địa chỉ cụ thể</label>
                                                <textarea class="form-control" name="address" id="billinginfo-address" placeholder="Đường, số nhà..."
                                                    rows="3">{{ old('address', $user->address) }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="billinginfo-address" class="form-label">Lưu ý </label>
                                                <textarea class="form-control" id="billinginfo-address" name="note" placeholder="Lưu ý về đơn hàng"
                                                    rows="3">{{ old('address', $user->address) }}</textarea>
                                            </div>
                                            <div class="hstack mt-3">
                                                <div class="p-2 ms-auto ms-3">
                                                    <button type="button"
                                                        class=" pt-1 btn text-bg-secondary next-tab rounded-1 right nexttab rounded-1 btnPrevious"
                                                        data-nexttab="pills-bill-address-tab">
                                                        <a href="{{ route('cart.index') }}" class="fz-14 text-white">Quay lại giỏ hàng</a>
                                                    </button>
                                                </div>
                                                <div class="p-2">
                                                    <button type="button"
                                                        class=" pt-1 btn btn-info text-white next-tab rounded-1 right nexttab rounded-1 btnNext">
                                                        <span class="fz-14">Tiếp tục thanh toán</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane fade" id="payment_method">
                                        <div>
                                            <h5 class="mb-1">Phương thức thanh toán</h5>
                                            <p class="text-muted mb-4 fz-14">Chọn phương thức thanh toán để tiếp tục quá
                                                trình
                                            </p>
                                        </div>

                                        <div class="row g-4">
                                            <div class="col-lg-12 col-sm-12">
                                                <div data-bs-toggle="collapse"
                                                    data-bs-target="#paymentmethodCollapse.show" aria-expanded="true"
                                                    aria-controls="paymentmethodCollapse">
                                                    <div class="form-check card-radio rounded-2 pb-1">
                                                        <input id="paymentMethod03" name="payment_method" type="radio"
                                                            class="form-check-input mt-4" checked value="cod">
                                                        <label
                                                            class="form-check-label d-flex justify-content-start align-items-center"
                                                            for="paymentMethod03">
                                                            <div style="height: 60px;">
                                                                <i
                                                                    class="fa-solid fa-hand-holding-dollar text-muted fs-1 mt-2"></i>
                                                            </div>
                                                            <div>
                                                                <span class="fs-16 text-muted me-2"><i
                                                                        class="ri-bank-card-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Thanh toán khi nhận
                                                                    hàng</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <div>
                                                    <div class="form-check card-radio rounded-2 pb-1">
                                                        <input id="paymentMethod01" name="payment_method" type="radio"
                                                            class="form-check-input mt-4" value="vnpay">
                                                        <label
                                                            class="form-check-label d-flex justify-content-start align-items-center"
                                                            for="paymentMethod01">
                                                            <div>
                                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/logo-vnpay9.png"
                                                                    alt="" width="60" height="60"
                                                                    class="img-fuild object-fit-cover">
                                                            </div>
                                                            <div>
                                                                <span class="fs-16 text-muted me-2"><i
                                                                        class="ri-bank-card-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Thanh toán qua ví
                                                                    VnPay</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <div>
                                                    <div class="form-check card-radio rounded-2 pb-1">
                                                        <input id="paymentMethod02" name="payment_method" type="radio"
                                                            class="form-check-input mt-4" value="momo">
                                                        <label
                                                            class="form-check-label d-flex justify-content-start align-items-center"
                                                            for="paymentMethod02">
                                                            <div>
                                                                <img src="/libaries/upload/images/momo-icon.png"
                                                                    alt="" width="60" height="60"
                                                                    class="img-fuild px-1 py-2 object-fit-contain">
                                                            </div>
                                                            <div>
                                                                <span class="fs-16 text-muted me-2"><i
                                                                        class="ri-bank-card-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Thanh toán qua ví MoMo</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-12 col-sm-12">
                                                <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse"
                                                    aria-expanded="false" aria-controls="paymentmethodCollapse"
                                                    class="collapsed">
                                                    <div class="form-check card-radio rounded-2 pb-1">
                                                        <input id="paymentMethod04" name="payment_method" type="radio"
                                                            class="form-check-input mt-4" value="paypal">
                                                        <label
                                                            class="form-check-label d-flex justify-content-start align-items-center"
                                                            for="paymentMethod04">
                                                            <div>
                                                                <img src="/libaries/upload/images/paypal-icon.jpg"
                                                                    alt="" width="60" height="60"
                                                                    class="img-fuild px-1 py-2 object-fit-contain">
                                                            </div>
                                                            <div>
                                                                <span class="fs-16 text-muted me-2"><i
                                                                        class="ri-bank-card-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Thanh toán qua ví
                                                                    Paypal</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        {{-- <div class="collapse" id="paymentmethodCollapse">
                                            <div class="card p-4 border shadow-none mb-0 mt-4">
                                                <div class="row gy-3">
                                                    <div class="col-md-12">
                                                        <label for="cc-name" class="form-label">Tên chủ thẻ</label>
                                                        <input type="text" class="form-control" id="cc-name"
                                                            placeholder="Nhập họ vè tên chủ thẻ">
                                                        <small class="text-warning">Vui lòng nhập đầy đủ họ và
                                                            tên.</small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="cc-number" class="form-label">Số thẻ</label>
                                                        <input type="text" class="form-control" id="cc-number"
                                                            placeholder="xxxx xxxx xxxx xxxx">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="cc-expiration" class="form-label">Ngày hết
                                                            hạn</label>
                                                        <input type="text" class="form-control" id="cc-expiration"
                                                            placeholder="DD/MM/YY">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="cc-cvv" class="form-label">CVV</label>
                                                        <input type="text" class="form-control" id="cc-cvv"
                                                            placeholder="xxx">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-muted mt-2 fst-italic">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-lock text-muted icon-xs">
                                                    <rect x="3" y="11" width="18" height="11" rx="2"
                                                        ry="2"></rect>
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                </svg> Giao dịch sẽ được bảo mật thông tin tuyệt đối
                                            </div>

                                        </div> --}}
                                        <div class="hstack mt-3">
                                            <div class="p-2 ms-auto ms-3">
                                                <button type="button"
                                                    class=" pt-1 btn text-bg-secondary next-tab rounded-1 right nexttab rounded-1 btnPrevious"
                                                    data-nexttab="pills-bill-address-tab">
                                                    <span class="fz-14">Quay lại</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 pe-0 ps-3">
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
                                        <table class="table table-borderless align-middle mb-0">
                                            <tbody>
                                                @if ($order)
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($order as $cartItem)
                                                        <tr class="cart-item">
                                                            <td class="p-0">
                                                                <div class="avatar-md bg-light rounded p-1">
                                                                    @if ($cartItem->productVariants)
                                                                        <img src="{{ explode(',', $cartItem->productVariants->album)[0] }}"
                                                                            alt="" width="60" height="60"
                                                                            class="img-fluid object-fit-cover">
                                                                    @elseif ($cartItem->products)
                                                                        <img src="{{ $cartItem->products->image }}"
                                                                            alt="" width="60" height="60"
                                                                            class="img-fluid object-fit-cover">
                                                                    @else
                                                                        <img src="/libaries/upload/libaries/images/img-notfound.png"
                                                                            alt="Product Image" width="60"
                                                                            height="60"
                                                                            class="img-fluid object-fit-cover rounded-2">
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="fz-14 text-start text-truncate mb-0"
                                                                    style="width: 220px">
                                                                    <a href="#" class="text-body">
                                                                        @if ($cartItem->productVariants)
                                                                            {{ $cartItem->productVariants->name }}
                                                                        @else
                                                                            {{ $cartItem->products->name }}
                                                                        @endif
                                                                    </a>
                                                                    <ul class="list-inline text-muted fz-12 my-1">
                                                                        @if (isset($attributesByCartItem[$cartItem->id]))
                                                                            @foreach ($attributesByCartItem[$cartItem->id] as $attribute)
                                                                                <li class="list-inline-item">
                                                                                    {{ $attribute->name }}
                                                                                </li>
                                                                            @endforeach
                                                                        @endif
                                                                    </ul>
                                                                </h5>
                                                                <p class="text-muted mb-0 fz-14">
                                                                    {{ number_format($cartItem->price, 0, ',', '.') }}đ
                                                                    <strong
                                                                        class="text-info orderQuantity">x{{ $cartItem->quantity }}</strong>
                                                                </p>
                                                            </td>
                                                            <td class="text-end fz-14 fw-medium orderPrice">
                                                                {{ number_format($cartItem->price * $cartItem->quantity, 0, ',', '.') }}đ
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $total += $cartItem->price * $cartItem->quantity;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                                <tr style="height: 10px;">
                                                    <td colspan="3">
                                                        <hr>
                                                    </td>
                                                </tr>
                                                @if (count(session('promotions')) > 0)
                                                    <tr style="height: 37px">
                                                        <td colspan="3">
                                                            <span class="fw-medium">Mã giảm giá đã áp dụng:</span>
                                                        </td>
                                                    </tr>
                                                    @foreach (session('promotions') as $promotion)
                                                        <tr style="height: 37px">
                                                            <td colspan="2" class="">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="fa-solid fa-ticket text-success me-2"></i>
                                                                    <span class="text-success fw-medium text-truncate">
                                                                        {{ $promotion['code'] }}
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <form
                                                                    action="{{ route('cart.removeVoucher', $promotion['code']) }}"
                                                                    method="POST" class="m-0">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-outline-danger btn-sm border-0" data-bs-toggle="tooltip"
                                                                        data-bs-title="Xóa mã giảm giá {{ $promotion['code'] }}">
                                                                        <i class="fa fa-trash me-1"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr style="height: 10px">
                                                        <td colspan="3">
                                                            <hr>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr style="height: 50px;">
                                                    <td class=" text-start fz-16" colspan="2">Thành tiền:</td>
                                                    <td class="fw-semibold text-end" id="cart-price">
                                                        {{ number_format($total, 0, ',', '.') }}đ
                                                    </td>
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <td class=" text-start fz-16" colspan="2">Giảm giá:</td>
                                                    <td class="fw-semibold text-end text-danger" id="discount-amount">
                                                        @if (session()->has('total_discount'))
                                                            -{{ number_format(session('total_discount'), 0, ',', '.') }}đ
                                                        @else
                                                            0đ
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr style="height: 60px;">
                                                    <td class=" text-start fz-16" colspan="2">Phí vận chuyển:</td>
                                                    <td class="fw-semibold text-end" id="shopping_fee">
                                                        @if (session()->has('shipping_fee') && session('shipping_fee') == 0)
                                                            <span class="text-success">Miễn phí</span>
                                                        @else
                                                            25.000đ
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr class="" style="height: 50px;">
                                                    <th colspan="2">Tổng tiền:</th>
                                                    <td class="text-end">
                                                        <span class="fw-semibold" id="cart-total-price">
                                                            @php
                                                                $totalPrice = $total;
                                                                $shippingFee = session()->has('shipping_fee')
                                                                    ? session('shipping_fee')
                                                                    : 25000;
                                                                $totalPriceWithShipping = $totalPrice + $shippingFee;
                                                                // Áp dụng tổng số tiền giảm giá từ tất cả mã đã áp dụng
                                                                $totalDiscount = session()->get('total_discount', 0);
                                                                $totalPriceWithShipping -= $totalDiscount;
                                                            @endphp
                                                            {{ number_format($totalPriceWithShipping, 0, ',', '.') . 'đ' }}
                                                            <input type="hidden" name="total_amount" id="total_amount"
                                                                value="{{ $totalPriceWithShipping }}">
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr class="" style="height: 50px;">
                                                    <td colspan="3">
                                                        <button type="submit" href="{{ route('order.checkout') }}"
                                                            class="btn fw-semibold btn-success w-100 text-uppercase fz-14">Đặt hàng</button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </section>
@endsection
