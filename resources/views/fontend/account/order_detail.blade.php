@extends('fontend.home.layout')
@section('page_title')
    Chi tiết đơn hàng
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="{{ route('account.order') }}"
                                class="text-decoration-none text-muted">Đơn hàng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="profile-main">
                    <div class="header-profile mb-3">
                        <div class="text-muted d-flex justify-content-between align-items ">
                            <div class="row ps-lg-3 pe-lg-3 p-lg-5 p-md-5 p-sm-4 p-xs-3">
                                @php
                                    $user = Auth::user();

                                @endphp
                                <div class="col-lg-4 col-md-4">
                                    <img src="{{ $user->image ?? '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif' }}"
                                        alt="image user acount" class="rounded-circle " width="90" height="90">
                                </div>
                                <div class="col-lg-8 col-md-8 align-items-center">
                                    <div class="news-profile  mt-2">
                                        <h6 class="fw-bold  fz-18">{{ $user->name }}</h6>
                                        <p class="mb-0 fz-14">Thứ hạng thành viên: <strong></strong></p>
                                        <p class="fz-13">Ngày tham gia: {{ date('d-m-Y', strtotime($user->created_at)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 text-end align-items-start position-relative">
                                <a class="gear-profile text-muted" href="#">
                                    <i class="fa-solid fa-gear fz-20 p-3" data-bs-toggle="tooltip"
                                        data-bs-title="Cài đặt"></i>
                                </a>
                                <div class="dropdown-icon-profile rounded-2">
                                    <ul class="ul-menu w-100 p-0 dropdown-content mb-1">
                                        <li class="li-menu-header p-1">
                                            <a href="#" class="text-decoration-none fz-12 ps-1">
                                                <i class="fa-solid fa-pen me-2"></i>Cập nhật
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-1">
                                            <a href="{{ route('auth.login') }}"
                                                class="text-decoration-none fz-12 ps-1 text-danger">
                                                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Đăng xuất
                                            </a>
                                        </li>
                                        <hr>
                                        <li class="li-menu-header p-1">
                                            <a href="#" class="text-decoration-none fz-12 ps-1 text-muted">
                                                <i class="fa-solid fa-circle-info me-2"></i>Hỗ trợ
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body-profile">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 flex-grow-1 mb-3">
                                <div class="card border-0 card-height-100 ">
                                    <div class="card-header align-items-center d-flex">
                                        <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Thông tin </h6>
                                    </div>
                                    <div class="card-body p-0 mt-3">
                                        <ul class="p-0">
                                            <li class="list-unstyled fz-16">
                                                <div class="nav-item-main" role="button">
                                                    <a class="nav-link fw-400 d-flex justify-content-between align-items-center"
                                                        href="#" role="button">
                                                        <span class="fz-16 fw-400">
                                                            <i class="fa-solid fa-circle-user fz-16 me-2"></i>
                                                            Thông tin cá nhân
                                                        </span>
                                                        <i class="fa-solid fa-chevron-down fz-12 d-none"></i>
                                                        <i class="fa-solid fa-chevron-right fw-bolder fz-12"></i>
                                                    </a>
                                                </div>
                                                <div class="sub-menu-lv2 d-none">
                                                    <ul class="sub-menu-ul flex-column text-muted ps-0">
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a href="#" class="nav-link p-2">
                                                                <i class='bx bx-circle fz-8 me-2'></i>
                                                                <span>Cập nhật</span>
                                                            </a>
                                                        </li>
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a href="#" class="nav-link p-2">
                                                                <i class='bx bx-circle fz-8 me-2'></i>
                                                                <span>Đổi mật khẩu</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-unstyled fz-16">
                                                <div class="nav-item-main">
                                                    <a class="nav-link fw-400 d-flex justify-content-between align-items-center"
                                                        href="{{ route('account.order') }}">
                                                        <span class="fz-16 fw-400"> <i
                                                                class='bx bxs-package fz-18 me-2'></i>
                                                            Đơn hàng</span>
                                                        <i class="fa-solid fa-chevron-down fz-12 d-none"></i>
                                                        <i class="fa-solid fa-chevron-right fw-bolder fz-12"></i>
                                                    </a>
                                                </div>
                                                <div class="sub-menu-lv2 d-none">
                                                    <ul class="sub-menu-ul flex-column text-muted ps-0">
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a href="{{ route('account.order') }}" type="submit"
                                                                class="nav-link p-2">
                                                                <i class='bx bx-circle fz-8 me-2'></i>
                                                                <span>Theo dõi đơn hàng</span>
                                                            </a>
                                                        </li>
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a class="nav-link fw-400 d-flex justify-content-between align-items-center p-2"
                                                                href="#" role="button">
                                                                <div>
                                                                    <i class='bx bx-circle fz-8 me-2'></i>
                                                                    <span>Starter</span>
                                                                </div>
                                                                <i
                                                                    class="fa-solid fa-chevron-down lv3 fw-bolder fz-12 pe-12 d-none"></i>
                                                                <i
                                                                    class="fa-solid fa-chevron-right lv3 fw-bolder fz-12 pe-12"></i>
                                                            </a>
                                                            <div class="sub-menu-lv3 d-none">
                                                                <div class="sub-sub-menu">
                                                                    <ul class="flex-column sub-sub-menu-ul ps-15">
                                                                        <li class="sub-sub-menu-li">
                                                                            <a href="#" class="nav-link p-2">Simple
                                                                                Page</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="sub-menu-lv3 d-none">
                                                                <div class="sub-sub-menu">
                                                                    <ul class="flex-column sub-sub-menu-ul ps-15">
                                                                        <li class="sub-sub-menu-li">
                                                                            <a href="#" class="nav-link p-2">Simple
                                                                                Page</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-unstyled fz-16">
                                                <div class="nav-item-main">
                                                    <a class="nav-link fw-400 d-flex justify-content-between align-items-center"
                                                        href="#" role="button">
                                                        <span class="fz-16 fw-400"> <i
                                                                class='fa-solid fa-bell fz-18 me-2'></i> Thông
                                                            báo</span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="list-unstyled fz-16">
                                                <div class="nav-item-main">
                                                    <a class="nav-link fw-400 d-flex justify-content-between align-items-center"
                                                        href="#" role="button">
                                                        <span class="fz-16 fw-400"> <i
                                                                class="fa-solid fa-ticket fz-18 me-2"></i>
                                                            Voucher</span>
                                                    </a>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    <!-- end cardbody -->
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 flex-grow-1">
                                <div class="article-profile">
                                    <div class="card border-0 bg-white">
                                        <div
                                            class="card-header d-flex justify-content-between justify-items-center border-0">
                                            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Đơn hàng chi tiết</h6>
                                        </div>
                                    </div>
                                    <div class="card border-0 rounded-2 mt-3 p-3">
                                        @if ($order->status == 'pending')
                                            <div
                                                class="d-flex align-items-center justify-content-between bg-light shadow-sm mb-4 p-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-circle-info text-secondary fs-3 me-3"></i>
                                                    <div>
                                                        <h6 class="mb-1 fz-18">Đơn hàng của bạn chưa được xác nhận!</h6>
                                                        <p class="mb-0 small">Vui lòng đợi nhà bán xác nhận đơn hàng của
                                                            bạn.</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="text-secondary">Chờ xác nhận</span>
                                                </div>
                                            </div>
                                        @elseif($order->status == 'confirmed')
                                            <div
                                                class="d-flex align-items-center justify-content-between bg-light shadow-sm mb-4 p-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-circle-check fs-3 me-3 text-primary"></i>
                                                    <div>
                                                        <h6 class="mb-1 fz-18">Đơn hàng của bạn đã được xác nhận!</h6>
                                                        <p class="mb-0 small">Nhà bán hàng đang chuẩn bị hàng giao đến bạn.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="text-primary">Đã xác nhận</span>
                                                </div>
                                            </div>
                                        @elseif($order->status == 'shipping')
                                            <div
                                                class="d-flex align-items-center justify-content-between bg-light shadow-sm mb-4 p-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-truck-fast fs-3 me-3 text-warning"></i>
                                                    <div>
                                                        <h6 class="mb-1 fz-18">Đơn hàng của bạn đang vận chuyển!</h6>
                                                        <p class="mb-0 small">Vui lòng chú ý thời gian để nhận hàng.</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button
                                                        class="btn btn-success py-2 px-4 rounded-2 fz-13 fw-medium dropdown-toggle updateStatus"
                                                        type="button" data-bs-toggle="dropdown" data-status="completed">
                                                        Đã nhận được hàng
                                                    </button>
                                                    <input type="hidden" name="order_id" class="orderId"
                                                        value="{{ $order->id }}">
                                                </div>
                                            </div>
                                        @elseif($order->status == 'canceled')
                                            <div
                                                class="d-flex align-items-center justify-content-between bg-light shadow-sm mb-4 p-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-circle-xmark fs-3 me-3 text-danger"></i>
                                                    <div>
                                                        <h6 class="mb-1 fz-18">Đơn hàng đã bị hủy!</h6>
                                                        <p class="mb-0 small">Đơn hàng của bạn đã bị hủy từ bạn hoặc người
                                                            bán.</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="text-danger">Đã hủy</span>
                                                </div>
                                            </div>
                                        @elseif($order->status == 'completed')
                                            <div
                                                class="d-flex align-items-center justify-content-between bg-light shadow-sm mb-4 p-2">
                                                <div class="d-flex align-items-center">
                                                    <img src="/libaries/upload/images/poper-icon.png" alt=""
                                                        width="40" class="me-2">
                                                    <div>
                                                        <h6 class="mb-1 fz-18">Đơn hàng đâ giao thành công!</h6>
                                                        <p class="mb-0 small">Hãy để lại đánh giá về sản phẩm của chúng
                                                            tôi.</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="text-success">Thành công</span>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="order-info mb-4">
                                            <div class="row g-4 mb-2">
                                                <div class="col-md-6">
                                                    <div
                                                        class="d-flex align-items-center p-3 bg-light shadow-sm rounded-3">
                                                        <i class=" text-muted fa-solid fa-clipboard h4 mb-0 me-3 "></i>
                                                        <div>
                                                            <div class="text-muted small">Mã đơn hàng</div>
                                                            <div class="fw-medium">#{{ $order->code }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="d-flex align-items-center p-3 bg-light shadow-sm rounded-3">
                                                        <i class=" text-muted far fa-calendar-alt h4 mb-0 me-3 "></i>
                                                        <div>
                                                            <div class="text-muted small">Ngày đặt hàng</div>
                                                            <div class="fw-medium">
                                                                {{ date('H:i:sa d-m-Y', strtotime($order->created_at)) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Địa chỉ nhận hàng -->
                                        <div class="shipping-info mb-4">
                                            <h6 class="fw-bold mb-3 text-muted">
                                                <i class="fa-solid fa-circle-info me-2"></i>
                                                Thông tin nhận hàng
                                            </h6>
                                            <div class="p-3 bg-light shadow-sm rounded-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="mb-1">
                                                            <span class="text-muted">Địa chỉ:</span> <br>
                                                            <span class="fw-medium">{{ $order->address }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="mb-1 d-flex justify-content-between">
                                                            <span class="text-muted">Người nhận:</span>
                                                            <span
                                                                class="fw-medium text-end">{{ $order->full_name }}</span>
                                                        </p>
                                                        <p class="mb-1 d-flex justify-content-between">
                                                            <span class="text-muted">Số điện thoại:</span>
                                                            <span class="fw-medium text-end">{{ $order->phone }}</span>
                                                        </p>
                                                        <p class="mb-1 d-flex justify-content-between">
                                                            <span class="text-muted">Email:</span>
                                                            <span class="fw-medium text-end">{{ $order->email }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sản phẩm -->
                                        <div class=" mb-4">
                                            <h6 class="fw-bold mb-3">
                                                <i class=" text-muted fas fa-box  me-2"></i>
                                                Sản phẩm
                                            </h6>
                                            <div class="p-0">
                                                <div class="row fw-medium fz-16 text-bg-success p-2 m-0">
                                                    <div class="col-6">Sản phẩm</div>
                                                    <div class="col-2 text-end">Số lượng</div>
                                                    <div class="col-2 text-end">Đơn giá</div>
                                                    <div class="col-2 text-end">Thành tiền</div>
                                                </div>
                                                @php $total = 0; @endphp
                                                @if (!is_null($order))
                                                    @foreach ($order->orderItems as $key => $val)
                                                        @php
                                                            $moneyCheckout = $val->final_quantity * $val->final_price;
                                                            $total += $moneyCheckout;
                                                            //--//
                                                            $statusPayment = '';
                                                            if ($order->payment == 'unpaid') {
                                                                $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-warning text-white d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fa-solid fa-circle-info"></i>
                                                                            Chưa trả
                                                                        </button>
                                                                    </div>';
                                                            } elseif ($order->payment == 'paid') {
                                                                $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button
                                                                            class="btn btn-success text-white d-flex align-items-center  gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fas fa-check-circle"></i>
                                                                            Đã trả
                                                                        </button>
                                                                    </div>';
                                                            } elseif ($order->payment == 'failed') {
                                                                $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button
                                                                            class="btn btn-danger text-white d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fas fa-times-circle"></i>
                                                                            Thất bại 
                                                                        </button>
                                                                    </div>';
                                                            }
                                                        @endphp

                                                        <div class="content-detail-product mt-3 shadow-sm">
                                                            <div class="row align-items-center p-2">
                                                                <div class="col-6 d-flex align-items-center">
                                                                    @if ($val->productVariants)
                                                                        <img src="{{ explode(',', $val->productVariants->album)[0] }}"
                                                                            alt="Image" width="90" height="80"
                                                                            class="rounded-2 me-2 bg-light p-2">
                                                                    @elseif ($val->products)
                                                                        <img src="{{ $val->products->image }}"
                                                                            alt="Product Image" width="90"
                                                                            height="80"
                                                                            class="rounded-2 me-2 bg-light">
                                                                    @else
                                                                        <img src="{{ $BASE_URL }}/libaries/upload/libaries/images/img-notfound.png"
                                                                            alt="Product Image" width="90"
                                                                            height="80"
                                                                            class="rounded-2 me-2 bg-light">
                                                                    @endif
                                                                    <div>
                                                                        <a href="#"
                                                                            class="text-break text-muted fw-medium">{{ $val->product_name }}</a>
                                                                        <ul class="list-inline text-muted fz-12 my-1">
                                                                            @if (isset($attributesByOderItem[$val->id]))
                                                                                @foreach ($attributesByOderItem[$val->id] as $attribute)
                                                                                    <li class="list-inline-item">
                                                                                        {{ $attribute->name }}
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2 text-end">{{ $val->final_quantity }}
                                                                </div>
                                                                <div class="col-2 text-end">
                                                                    {{ number_format($val->final_price, '0', ',', '.') }}đ
                                                                </div>
                                                                <div class="col-2 text-end fw-bold">
                                                                    {{ number_format($moneyCheckout, '0', ',', '.') }}đ
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="row p-3 {{ $order->status != 'completed' ? 'd-none' : '' }}">
                                                                <div class="col text-end">
                                                                    <div class="d-flex justify-content-end gap-2 ">
                                                                        <a href="#"
                                                                            class="btn btn-outline-success btn-sm px-3"
                                                                            style="min-width: 120px;">
                                                                            <i class=" fas fa-sync-alt me-2"></i>
                                                                            Mua lại
                                                                        </a>
                                                                        <a href="#"
                                                                            class="btn btn-success text-white btn-sm px-3"
                                                                            style="min-width: 120px;">
                                                                            <i class=" fas fa-star me-2"></i> Đánh giá
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="payment-info">
                                            <h6 class="fw-bold mb-3">
                                                <i class=" text-muted far fa-credit-card  me-2"></i>
                                                Thanh toán
                                            </h6>
                                            <div class="bg-light p-3 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div>
                                                        <span class="text-muted">Phương thức thanh toán</span>
                                                    </div>
                                                    <span class="h6 mb-0 fw-bold">
                                                        @if ($order->status != 'canceled')
                                                            @if ($order->payment_method == 'cod')
                                                                Trả tiền khi nhận hàng
                                                            @elseif($order->payment_method == 'vnpay')
                                                                Thanh toán qua ví VNPay
                                                            @elseif($order->payment_method == 'momo')
                                                                Thanh toán qua ví MoMo
                                                            @elseif($order->payment_method == 'paypal')
                                                                Thanh toán qua ví PayPal
                                                            @else
                                                                Hình thức khác
                                                            @endif
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div>
                                                        <span class="text-muted">Trạng thái thanh toán</span>
                                                    </div>
                                                    <span class="h6 mb-0 fw-bold">
                                                        {!! $order->status !== 'canceled' ? $statusPayment : '---' !!}
                                                    </span>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div>
                                                        <span class="text-muted">Tổng thanh toán</span>
                                                        <br>
                                                        <small class="text-muted">(Đã bao gồm VAT & Giảm giá)</small>
                                                    </div>
                                                    <span
                                                        class="h6 mb-0 fw-bold">{{ number_format($order->total_amount, '0', ',', '.') }}đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    </div>
@endsection
