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
                        <li class="breadcrumb-item "><a href="#" class="text-decoration-none text-muted">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <!-- content -->
                <div class="main-cart row flex-wrap text-muted pt-3 mx-0 mb-5">

                    <div class="col-lg-8 col-md-12 col-sm-12 mb-md-4 mb-sm-3 ps-0 rounded-1">
                        <div class="card-header bg-light shadow-sm border-0 mb-3">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0 p-3">Thanh toán</h5>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive bg-white shadow-sm">
                            <form action="#">
                                <div class="step-arrow-nav mb-3">
                                    <ul class="nav nav-tabs nav-justified custom-nav ps-0 " role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button
                                                class="text-uppercase nav-link fz-14 px-2 py-3 rounded-0 text-bg-light active show"
                                                data-bs-toggle="tab" data-bs-target="#info">
                                                <i
                                                    class="fa-solid fa-user fs-16 p-2 bg-secondary-subtle text-secondary rounded-circle align-middle me-2"></i>
                                                Thông tin
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="text-uppercase nav-link fz-14 px-2 py-3 rounded-0 text-bg-light"
                                                data-bs-toggle="tab" data-bs-target="#payment_method">
                                                <i
                                                    class="fa-solid fa-building-columns fs-16 p-2 bg-secondary-subtle text-secondary rounded-circle align-middle me-2"></i>
                                                phương thức
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="text-uppercase nav-link fz-14 px-2 py-3 rounded-0 text-bg-light"
                                                data-bs-toggle="tab" data-bs-target="#done">
                                                <i
                                                    class="fa-solid fa-circle-check fs-16 p-2 my-0 bg-secondary-subtle text-secondary rounded-circle align-middle me-2"></i>
                                                Hoàn tất
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content p-3">
                                    <div class="tab-pane fade active show" id="info">
                                        <div>
                                            <h5 class="mb-1">Thông tin thanh toán</h5>
                                            <p class="text-muted mb-4 fz-14">Vui lòng điền đẩy đủ thông tin bên dưới</p>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-firstName" class="form-label">Họ
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            id="billinginfo-firstName" placeholder="Nhập họ của bạn"
                                                            value="">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-lastName" class="form-label">Tên</label>
                                                        <input type="text" class="form-control" id="billinginfo-lastName"
                                                            placeholder="Nhập tên của bạn" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-email" class="form-label">Email <span
                                                                class="text-muted">(*)</span></label>
                                                        <input type="email" class="form-control" id="billinginfo-email"
                                                            placeholder="Nhập email">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="billinginfo-phone" class="form-label">Số điện
                                                            thoại</label>
                                                        <input type="text" class="form-control" id="billinginfo-phone"
                                                            placeholder="Nhập số điện thoại">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="billinginfo-address" class="form-label">Địa chỉ</label>
                                                <textarea class="form-control" id="billinginfo-address" placeholder="Nhập địa chỉ" rows="3"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tỉnh/Thành Phố</label>
                                                        <select name="" id="" class="form-control">
                                                            <option value="0">[ Chọn Tỉnh/Thành phố ]</option>
                                                            <option value="0">Long An</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Quận/Huyện</label>
                                                        <select name="" id="" class="form-control">
                                                            <option value="0">[ Chọn Quận/Huyện ]</option>
                                                            <option value="0">Đức Huệ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Phường/Xã</label>
                                                        <select name="" id="" class="form-control">
                                                            <option value="0">[ Chọn Phường/Xã ]</option>
                                                            <option value="0">Mỹ Thanh tây</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hstack mt-3">
                                                <div class="p-2 ms-auto ms-3">
                                                    <button type="button"
                                                        class=" pt-1 btn text-bg-secondary next-tab rounded-1 right nexttab rounded-1 btnPrevious"
                                                        data-nexttab="pills-bill-address-tab">
                                                        <span class="fz-14">Quay lại</span>
                                                    </button>
                                                </div>
                                                <div class="p-2">
                                                    <button type="button"
                                                        class=" pt-1 btn btn-info text-white next-tab rounded-1 right nexttab rounded-1 btnNext"
                                                        data-nexttab="pills-bill-address-tab">
                                                        <span class="fz-14">Tiếp tục thanh toán</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    {{-- <div class="tab-pane fade" id="address">
                                        <div>
                                            <h5 class="mb-1">Thông tin vận chuyển</h5>
                                            <p class="text-muted mb-4 fz-14">Điền và tick vào các thông tin bên dưới</p>
                                        </div>

                                        <div class="mt-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-14 mb-0">Địa chỉ của bạn</h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-success rounded-1 mb-3"
                                                        data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                                        + Thêm mới
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row gy-3">
                                                <div class="col-lg-4 col-sm-6">
                                                    <div
                                                        class="form-check card-radio rounded-bottom-0 border-bottom-0 mb-0 ">
                                                        <input id="shippingAddress01" name="shippingAddress"
                                                            type="radio" class="form-check-input">
                                                        <label class="form-check-label fz-16 " for="shippingAddress01">
                                                            <span
                                                                class="mb-4 fw-semibold fz-14 d-block text-muted text-uppercase ">Địa
                                                                chỉ 1</span>
                                                            <span class="fz-16 mb-2 d-block">Thanh Trung</span>
                                                            <span class="text-muted text-wrap mb-1 d-block text-break">Quận
                                                                12, TP.HCM</span>
                                                            <span class="text-muted d-block mb-3">(+84) 468456453</span>
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap fz-12 p-2 py-1 bg-light rounded-bottom border mt-n1">
                                                        <div>
                                                            <a href="#" class="d-block text-body p-1 px-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#addAddressModal"><i
                                                                    class="fa-solid fa-pen text-muted align-bottom me-1 mb-1"></i>
                                                                Sửa</a>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="d-block text-body p-1 px-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#removeItemModal"><i
                                                                    class="fa-solid fa-trash text-muted align-bottom me-1 mb-1"></i>
                                                                Xóa</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6">
                                                    <div
                                                        class="form-check card-radio  rounded-bottom-0 border-bottom-0 mb-0 ">
                                                        <input id="shippingAddress02" name="shippingAddress"
                                                            type="radio" class="form-check-input">
                                                        <label class="form-check-label fz-16 " for="shippingAddress02">
                                                            <span
                                                                class="mb-4 fw-semibold fz-14 d-block text-muted text-uppercase ">Địa
                                                                chỉ 2</span>
                                                            <span class="fz-16 mb-2 d-block">Thanh Trung</span>
                                                            <span class="text-muted text-wrap mb-1 d-block text-break">Quận
                                                                12, TP.HCM</span>
                                                            <span class="text-muted d-block mb-3">(+84) 468456453</span>
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap fz-12 p-2 py-1 bg-light rounded-bottom border mt-n1">
                                                        <div>
                                                            <a href="#" class="d-block text-body p-1 px-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#addAddressModal"><i
                                                                    class="fa-solid fa-pen text-muted align-bottom me-1 mb-1"></i>
                                                                Sửa</a>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="d-block text-body p-1 px-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#removeItemModal"><i
                                                                    class="fa-solid fa-trash text-muted align-bottom me-1 mb-1"></i>
                                                                Xóa</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="mt-4">
                                                <h5 class="fs-14 mb-3">Phương thức vận chuyển</h5>
                                                <div class="row g-4">
                                                    <div class="col-lg-6">
                                                        <div class="form-check card-radio rounded-2 py-2">
                                                            <input id="shippingMethod01" name="shippingMethod"
                                                                type="radio" class="form-check-input" checked="">
                                                            <label class="form-check-label w-100" for="shippingMethod01">
                                                                <span
                                                                    class="fz-18 float-end mt-2 text-wrap d-block fw-semibold pe-3">Miễn
                                                                    phí</span>
                                                                <span class="fz-14 mb-1 text-wrap d-block">Thông thường
                                                                </span>
                                                                <span class="text-muted fw-normal text-wrap d-block">Nhận
                                                                    hàng từ 3 - 5 ngày</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-check card-radio rounded-2 py-2">
                                                            <input id="shippingMethod01" name="shippingMethod"
                                                                type="radio" class="form-check-input" checked="">
                                                            <label class="form-check-label w-100" for="shippingMethod01">
                                                                <span
                                                                    class="fz-18 float-end mt-2 text-wrap d-block fw-semibold pe-3">25.000đ</span>
                                                                <span class="fz-14 mb-1 text-wrap d-block">Giao
                                                                    nhanh</span>
                                                                <span class="text-muted fw-normal text-wrap d-block">Nhận
                                                                    hàng trong 1 ngày</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hstack mt-3">
                                            <div class="p-2 ms-auto ms-3">
                                                <button type="button"
                                                    class=" ms-auto btn text-bg-secondary next-tab rounded-1 right ms-auto nexttab rounded-1 btnPrevious"
                                                    data-nexttab="pills-bill-address-tab">
                                                    Quay lại
                                                </button>
                                            </div>
                                            <div class="p-2">
                                                <button type="button"
                                                    class="btn btn-info text-white next-tab rounded-1 right ms-auto nexttab rounded-1 btnNext"
                                                    data-nexttab="pills-bill-address-tab">
                                                    Tiếp tục thanh toán
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab pane --> --}}

                                    <div class="tab-pane fade" id="payment_method">
                                        <div>
                                            <h5 class="mb-1">Phương thức thanh toán</h5>
                                            <p class="text-muted mb-4 fz-14">Chọn phương thức thanh toán để tiếp tục quá
                                                trình
                                            </p>
                                        </div>

                                        <div class="row g-4">
                                            <div class="col-lg-4 col-sm-6">
                                                <div data-bs-toggle="collapse"
                                                    data-bs-target="#paymentmethodCollapse.show" aria-expanded="true"
                                                    aria-controls="paymentmethodCollapse">
                                                    <div class="form-check card-radio rounded-2 pb-1">
                                                        <input id="paymentMethod01" name="paymentMethod" type="radio"
                                                            class="form-check-input mt-4" checked="">
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
                                                                <span class="fs-14 text-wrap">Vnpay</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse"
                                                    aria-expanded="false" aria-controls="paymentmethodCollapse"
                                                    class="collapsed">
                                                    <div class="form-check card-radio rounded-2 pb-1">
                                                        <input id="paymentMethod02" name="paymentMethod" type="radio"
                                                            class="form-check-input mt-4" checked="">
                                                        <label
                                                            class="form-check-label d-flex justify-content-start align-items-center"
                                                            for="paymentMethod02">
                                                            <div>
                                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/credit_card.png"
                                                                    alt="" width="60" height="60"
                                                                    class="img-fuild object-fit-contain">
                                                            </div>
                                                            <div>
                                                                <span class="fs-16 text-muted me-2"><i
                                                                        class="ri-bank-card-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Thẻ tín dụng/ Ghi
                                                                    nợ</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div data-bs-toggle="collapse"
                                                    data-bs-target="#paymentmethodCollapse.show" aria-expanded="true"
                                                    aria-controls="paymentmethodCollapse">
                                                    <div class="form-check card-radio rounded-2 pb-1">
                                                        <input id="paymentMethod03" name="paymentMethod" type="radio"
                                                            class="form-check-input mt-4" checked="">
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
                                                                <span class="fs-14 text-wrap">Thanh toán tiền mặt</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="paymentmethodCollapse">
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

                                        </div>
                                        <div class="hstack mt-3">
                                            <div class="p-2 ms-auto ms-3">
                                                <button type="button"
                                                    class=" pt-1 btn text-bg-secondary next-tab rounded-1 right nexttab rounded-1 btnPrevious"
                                                    data-nexttab="pills-bill-address-tab">
                                                    <span class="fz-14">Quay lại</span>
                                                </button>
                                            </div>
                                            <div class="p-2">
                                                <button type="button"
                                                    class=" pt-1 btn btn-info text-white next-tab rounded-1 right nexttab rounded-1 btnNext"
                                                    data-nexttab="pills-bill-address-tab">
                                                    <span class="fz-14">Tiếp tục thanh toán</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane fade" id="done">
                                        <div class="text-center py-5">

                                            <div class="mb-4">
                                                <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                                                    colors="primary:#0ab39c,secondary:#405189"
                                                    style="width:120px;height:120px"></lord-icon>
                                            </div>
                                            <h5 class="fz-16">Cảm ơn! Bạn đã thanh toán đơn hàng thành công.</h5>
                                            <p class="text-muted fz-14">Chứng tôi sẽ thông báo về đơn hàng của bạn</p>
                                            <h3 class="fw-semibold fz-16">Mã đơn hàng: <a href="#"
                                                    class="text-decoration-underline text-muted">VZ2451</a></h3>
                                            <a href="#" class="btn btn-success rounded-1 fz-14 mt-2">Trang chủ</a>
                                        </div>

                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </form>
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
                                            @if (!is_null($carts) && !empty($carts))
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($carts->cartItems as $cartItem)
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
                                                            <h5 class="fz-14 text-break">
                                                                <a href="#" class="text-body">
                                                                    @if ($cartItem->productVariants)
                                                                        {{ $cartItem->productVariants->name }}
                                                                    @else
                                                                        {{ $cartItem->products->name }}
                                                                    @endif
                                                                </a>
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

                                            <tr>
                                                <td colspan="3">
                                                    <div class="bg-light-subtle border-success-subtle p-0"></div>
                                                    <div class="text-start">
                                                        <h6 class="mb-2">Bạn có voucher khuyến mãi?</h6>
                                                    </div>
                                                    <div class="hstack gap-2">
                                                        <input class="form-control me-auto" type="text"
                                                            placeholder="Nhập mã voucher" name="discount">
                                                        <button type="button"
                                                            class="btn btn-success fw-500 w-25 rounded-1">Áp
                                                            mã</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="height: 50px;">
                                                <td class="fz-16" colspan="2">Thành tiền:</td>
                                                <td class="fw-semibold text-end">
                                                    {{-- {{ number_format($total, 0, ',', '.') }}đ --}}
                                                </td>
                                            </tr>
                                            <tr style="height: 50px;">
                                                <td class="fz-16" colspan="2">Giảm giá:
                                                </td>
                                                <td class="fw-semibold text-end">0</td>
                                            </tr>
                                            <tr style="height: 60px;">
                                                <td class="fz-16" colspan="2">Phí vận chuyển:</td>
                                                <td class="fw-semibold text-end">25.000đ</td>
                                            </tr>

                                            <tr class="" style="height: 50px;">
                                                <th colspan="2">Tổng tiền:</th>
                                                <td class="text-end">
                                                    <span class="fw-semibold" id="cart-total-price">
                                                        {{-- {{ number_format($total + 25000, '0', ',', '.') . 'đ' }} --}}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="" style="height: 50px;">
                                                <td colspan="3">
                                                    <a href="{{ route('order.checkout') }}"
                                                        class="btn fw-semibold btn-success w-100 text-uppercase fz-14">Tiến
                                                        hành thanh toán</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border-2">
                <!-- product similar  -->
                <div class="product-similar mb-3 text-muted">
                    <div class="title-product mt-4 mb-3">
                        <h5 class="fs-4 fw-500 mb-3 text-uppercase">
                            sản phẩm mới
                            <hr class=" border-4 border-info mb-2" style="width: 160px;">
                        </h5>
                    </div>
                    <div class="row flex-wrap">
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="card card-product shadow-sm border-0">
                                <div class="head-card d-flex p-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-0">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="card card-product shadow-sm border-0">
                                <div class="head-card d-flex p-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-0">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="card card-product shadow-sm border-0">
                                <div class="head-card d-flex p-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-0">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="card card-product shadow-sm border-0">
                                <div class="head-card d-flex p-2">
                                    <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                    <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                        data-bs-title="Thêm vào yêu thích">
                                        <i class="fa-regular fa-bookmark fz-16"></i>
                                    </span>
                                </div>
                                <div class="image-main-product position-relative">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg"
                                        alt="product image" width="100%" height="250" class="img-fluid">
                                    <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                        <div class="hstack gap-3">
                                            <div class="p-2">
                                                <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                    nam</span>
                                            </div>
                                            <div class="p-2 ms-auto">
                                                <div class="product-image-color">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png"
                                                        alt="image color product" width="14" height="14"
                                                        class="rounded-circle img-fluid me-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="fw-medium">
                                        <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                            Vải Pique
                                            Ngắn Tay
                                            mát mẻ, thoải mái</a>
                                    </h6>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                        <span class="mt-1">
                                            <del class="text-secondary fz-14 ">559.000đ</del>
                                        </span>
                                    </div>
                                    <div class="box-action">
                                        <a href="#" class="action-cart-item-buy">
                                            <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                            <span>Mua ngay</span>
                                        </a>
                                        <a href="#" class="action-cart-item-add">
                                            <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                            <span>thêm giỏ hàng</span>

                                        </a>
                                    </div>
                                    <div class="head-card d-flex p-0">
                                        <span class="fz-14 ">
                                            <div class="rating">
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </span>
                                        <span class="ms-auto fz-14">25</span>
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
        <!-- <div class=" live-chat ms-lg-16">
                        <a href="zalo">
                            <img class="rounded-circle " src="public/image/zalo.png" alt="" width="50">
                        </a>
                    </div> -->
    </div>
@endsection
