<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">Xin chào,
                                            {{ Auth::check() ? Auth::user()->name : '' }}!</h4>
                                        <p class="text-muted mb-0">Sau đây là những gì đang diễn ra tại cửa hàng của bạn
                                            ngày hôm nay.</p>
                                    </div>
                                    <div class="mt-3 mt-lg-0">
                                        <a href="{{ route('product.create') }}">
                                            <div class="row g-3 mb-0 align-items-center">
                                                <div class="col-auto">
                                                    <button type="button"
                                                        class="btn btn-soft-success material-shadow-none"><i
                                                            class="ri-add-circle-line align-middle me-1"></i>
                                                        Thêm sản phẩm</button>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    Doanh thu</p>
                                            </div>
                                            {{-- <div class="flex-shrink-0">
                                                <h5 class="text-success fs-14 mb-0">
                                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                    +16.24 %
                                                </h5>
                                            </div> --}}
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                    <span class="counter-value"
                                                        data-target="{{ $totalE }}"></span>đ
                                                </h4>
                                                <span class="text-decoration-underline text-primary ">Năm 2024</span>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-success-subtle rounded fs-3">
                                                    <i class="bx bx-dollar-circle text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Đơn
                                                    hàng</p>
                                            </div>
                                            {{-- <div class="flex-shrink-0">
                                                <h5 class="text-danger fs-14 mb-0">
                                                    <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                                    -3.57 %
                                                </h5>
                                            </div> --}}
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                    <span class="counter-value"
                                                        data-target="{{ $countTotalOrder }}"></span>
                                                </h4>
                                                <a href="{{ route('order.index') }}"
                                                    class="text-decoration-underline text-primary">Tất cả đơn hàng</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-info-subtle rounded fs-3">
                                                    <i class="bx bx-shopping-bag text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    Khách hàng mới</p>
                                            </div>
                                            {{-- <div class="flex-shrink-0">
                                                <h5 class="text-success fs-14 mb-0">
                                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                    --
                                                </h5>
                                            </div> --}}
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                        class="counter-value" data-target="{{ $countUserNew }}"></span>
                                                </h4>
                                                <a href="{{ route('user.index') }}"
                                                    class="text-decoration-underline text-primary">Xem chi tiết</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                    <i class="bx bx-user-circle text-warning"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    Chuyển đổi</p>
                                            </div>
                                            {{-- <div class="flex-shrink-0">
                                                <h5 class="text-muted fs-14 mb-0">
                                                    --
                                                </h5>
                                            </div> --}}
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                    <span class="counter-value"
                                                        data-target="{{ $conversionRate > 0 ? $conversionRate : '0' }}"></span>
                                                    %
                                                </h4>
                                                <span class="text-decoration-underline text-primary">Tỉ lệ chuyển
                                                    đổi/tháng</span>
                                            </div>
                                            {{-- <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                    <i class="fa-solid fa-arrow-right-arrow-left text-primary"></i>
                                                </span>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Doanh thu</h4>
                                        <div>
                                            <button type="button"
                                                class="btn btn-soft-primary material-shadow-none btn-sm">
                                                Năm
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-header p-0 border-0 bg-light-subtle">
                                        <div class="row g-0 text-center">
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1"><span class="counter-value"
                                                            data-target="{{ $totalE }}"></span></h5>
                                                    <p class="text-muted mb-0">Doanh thu</p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1"><span class="counter-value"
                                                            data-target="{{ $countTotalOrder }}"></span></h5>
                                                    <p class="text-muted mb-0">Đơn hàng</p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1"><span class="counter-value"
                                                            data-target="{{ $countUserAll }}"></span></h5>
                                                    <p class="text-muted mb-0">Khách hàng</p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                    <h5 class="mb-1 text-success"><span class="counter-value"
                                                            data-target="{{ $conversionRateYear }}"></span> %</h5>
                                                    <p class="text-muted mb-0">Chuyển đổi</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body p-0 pb-2">
                                        <div class="w-100">
                                            <div class="w-100" id="customer_impression_charts"
                                                data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                                                data-colors-minimal='["--vz-light", "--vz-primary", "--vz-info"]'
                                                data-colors-saas='["--vz-success", "--vz-info", "--vz-danger"]'
                                                data-colors-modern='["--vz-warning", "--vz-primary", "--vz-success"]'
                                                data-colors-interactive='["--vz-info", "--vz-primary", "--vz-danger"]'
                                                data-colors-creative='["--vz-warning", "--vz-primary", "--vz-danger"]'
                                                data-colors-corporate='["--vz-light", "--vz-primary", "--vz-secondary"]'
                                                data-colors-galaxy='["--vz-secondary", "--vz-primary", "--vz-primary-rgb, 0.50"]'
                                                data-colors-classic='["--vz-light", "--vz-primary", "--vz-secondary"]'
                                                data-colors-vintage='["--vz-success", "--vz-primary", "--vz-secondary"]'
                                                class="apex-charts" dir="ltr">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Đơn hàng gần đây</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table
                                                class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                <thead class="text-muted table-light">
                                                    <tr>
                                                        <th scope="col" width="130">Mã đơn hàng</th>
                                                        <th scope="col">Khách hàng</th>
                                                        <th scope="col" class="text-end">Sản phẩm</th>
                                                        <th scope="col" class="text-end">Thành tiền</th>
                                                        <th scope="col" class="text-end">Phương thức</th>
                                                        <th scope="col" class="text-end">Thời gian</th>
                                                        <th scope="col" class="text-end">Trạng thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($orderRecents)
                                                        @foreach ($orderRecents as $keyOrderRc => $valueOrderRc)
                                                            @php
                                                                $imagePayment = '';
                                                                if ($valueOrderRc->payment_method == 'cod') {
                                                                    $imagePayment =
                                                                        '<i class="fa-solid fa-money-bill-wave fs-2 text-success"></i>';
                                                                } elseif ($valueOrderRc->payment_method == 'vnpay') {
                                                                    $imagePayment =
                                                                        '<img src="/libaries/upload/images/vnpay-icon.svg" alt="" class="object-fit-contain" width="60" height="30">';
                                                                } elseif ($valueOrderRc->payment_method == 'momo') {
                                                                    $imagePayment =
                                                                        '<img src="/libaries/upload/images/momo-icon.svg" alt="" class="object-fit-contain" width="35" height="30">';
                                                                } elseif ($valueOrderRc->payment_method == 'paypal') {
                                                                    $imagePayment =
                                                                        '<img src="/libaries/upload/images/paypal-icon.jpg" alt="" class="object-fit-contain" width="45" height="40">';
                                                                } else {
                                                                    $imagePayment =
                                                                        '<i class="fa-solid fa-spinner fa-spin-pulse fs-2"></i>';
                                                                }
                                                                //-- //
                                                                $date = date(
                                                                    'd-m-Y',
                                                                    strtotime($valueOrderRc->created_at),
                                                                );
                                                                //-- -//
                                                                $statusMap = [
                                                                    'pending' => ['Chờ xác nhận', 'warning'],
                                                                    'confirmed' => ['Đã xác nhận', 'info'],
                                                                    'shipping' => ['Đang vận chuyển', 'secondary'],
                                                                    'canceled' => ['Đã hủy đơn', 'danger'],
                                                                    'completed' => ['Thành công', 'success'],
                                                                ];
                                                                $statusInfo = $statusMap[$valueOrderRc->status] ?? [
                                                                    'Không xác định',
                                                                    'dark',
                                                                ];
                                                                $statusBadge =
                                                                    '<span class="badge bg-' .
                                                                    $statusInfo[1] .
                                                                    '-subtle text-' .
                                                                    $statusInfo[1] .
                                                                    ' text-uppercase p-2">' .
                                                                    $statusInfo[0] .
                                                                    '</span>';
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('order.detail', ['id' => $valueOrderRc->id]) }}"
                                                                        class="fw-medium link-primary">#{{ $valueOrderRc->code }}</a>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-2">
                                                                            <img src="{{ $valueOrderRc->user->image != null ? $valueOrderRc->user->image : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif' }}"
                                                                                alt=""
                                                                                class="avatar-xs rounded-circle material-shadow" />
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            {{ $valueOrderRc->user->name }}</div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-end">{{ $valueOrderRc->total_items }}
                                                                </td>
                                                                <td class="text-end">
                                                                    <span
                                                                        class="text-success">{{ number_format($valueOrderRc->total_amount, '0', '.', ',') }}đ</span>
                                                                </td>
                                                                <td class="text-end">{!! $valueOrderRc->status !== 'canceled' ? $imagePayment : '---' !!}</td>
                                                                <td class="text-end">
                                                                    <span>{{ $date }}</span>
                                                                </td>
                                                                <td class="text-end">{!! $statusBadge !!}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div class="container-fluid mt-3">
                                                {{ $orderRecents->onEachSide(3)->links('pagination::bootstrap-5') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Sản phẩm bán chạy</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table
                                                class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                <tbody>
                                                    @if ($productSalers)
                                                        @foreach ($productSalers as $keyPSaler => $valPSaler)
                                                            @php
                                                                $price =
                                                                    $valPSaler->del != 0
                                                                        ? $valPSaler->del
                                                                        : $valPSaler->price;
                                                                //--// lấy số lượng sản phẩm tất cả phiên bản
                                                                $totalQuantity = 0;
                                                                foreach($valPSaler->productVariant as $variantQ){
                                                                    $totalQuantity += (int)$variantQ->quantity;
                                                                }
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div
                                                                            class="avatar-sm bg-light rounded p-1 me-2">
                                                                            <img src="{{ $valPSaler->image ? $valPSaler->image : '/libaries/templates/bee-cloudy-admin/assets/images/image-notfound.png' }}"
                                                                                alt=""
                                                                                class="img-fluid d-block rounded-2" />
                                                                        </div>
                                                                        <div>
                                                                            <h5 class="fs-14 my-1"
                                                                                style="max-width: 400px;">
                                                                                <span
                                                                                    class="d-inline-block text-truncate"
                                                                                    style="max-width: 500px;">
                                                                                    {{ $valPSaler->name }}
                                                                                </span>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="fs-14 my-1 fw-normal">
                                                                        {!! number_format($price, '0', ',', '.') !!}đ</h5>
                                                                    <span class="text-muted">Giá</span>
                                                                </td>
                                                                <td>
                                                                    <h5 class="fs-14 my-1 fw-normal">
                                                                        {{ $valPSaler->sold_count }}</h5>
                                                                    <span class="text-muted">Đã bán</span>
                                                                </td>
                                                                <td>
                                                                    <h5 class="fs-14 my-1 fw-normal">

                                                                        {{ $valPSaler->productVariant ? $totalQuantity : '<span class="badge bg-danger-subtle text-danger">cháy hàng</span>' }}
                                                                    </h5>
                                                                    <span class="text-muted">Kho hàng</span>
                                                                </td>
                                                                <td>
                                                                    <h5 class="fs-14 my-1 fw-bold">
                                                                        {{ number_format($price * $valPSaler->sold_count, '0', ',', '.') . 'đ' }}
                                                                    </h5>
                                                                    <span class="text-muted">Tổng bán</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div class="container-fluid mt-3">
                                                {{ $productSalers->onEachSide(3)->links('pagination::bootstrap-5') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto layout-rightside-col">
                    <div class="overlay"></div>
                    <div class="layout-rightside">
                        <div class="card h-100 rounded-0">
                            <div class="card-body p-0">
                                <div class="p-3">
                                    <h6 class="text-muted mb-0 text-uppercase fw-semibold">Recent Activity</h6>
                                </div>
                                <div data-simplebar style="max-height: 410px;" class="p-3 pt-0">
                                    <div class="acitivity-timeline acitivity-main">
                                        <div class="acitivity-item d-flex">
                                            <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                <div
                                                    class="avatar-title bg-success-subtle text-success rounded-circle material-shadow">
                                                    <i class="ri-shopping-cart-2-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Purchase by James Price</h6>
                                                <p class="text-muted mb-1">Product noise evolve smartwatch </p>
                                                <small class="mb-0 text-muted">02:14 PM Today</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                <div
                                                    class="avatar-title bg-danger-subtle text-danger rounded-circle material-shadow">
                                                    <i class="ri-stack-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Added new <span class="fw-semibold">style
                                                        collection</span></h6>
                                                <p class="text-muted mb-1">By Nesta Technologies</p>
                                                <div class="d-inline-flex gap-2 border border-dashed p-2 mb-2">
                                                    <a href="apps-ecommerce-product-details.html"
                                                        class="bg-light rounded p-1">
                                                        <img src="/libaries/templates/bee-cloudy-admin/assets/images/products/img-8.png"
                                                            alt="" class="img-fluid d-block" />
                                                    </a>
                                                    <a href="apps-ecommerce-product-details.html"
                                                        class="bg-light rounded p-1">
                                                        <img src="/libaries/templates/bee-cloudy-admin/assets/images/products/img-2.png"
                                                            alt="" class="img-fluid d-block" />
                                                    </a>
                                                    <a href="apps-ecommerce-product-details.html"
                                                        class="bg-light rounded p-1">
                                                        <img src="/libaries/templates/bee-cloudy-admin/assets/images/products/img-10.png"
                                                            alt="" class="img-fluid d-block" />
                                                    </a>
                                                </div>
                                                <p class="mb-0 text-muted"><small>9:47 PM Yesterday</small></p>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/libaries/templates/bee-cloudy-admin/assets/images/users/avatar-2.jpg"
                                                    alt=""
                                                    class="avatar-xs rounded-circle acitivity-avatar material-shadow">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Natasha Carey have liked the products
                                                </h6>
                                                <p class="text-muted mb-1">Allow users to like products in your
                                                    WooCommerce store.</p>
                                                <small class="mb-0 text-muted">25 Dec, 2021</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div
                                                        class="avatar-title rounded-circle bg-secondary material-shadow">
                                                        <i class="mdi mdi-sale fs-14"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Today offers by <a
                                                        href="apps-ecommerce-seller-details.html"
                                                        class="link-secondary">Digitech Galaxy</a></h6>
                                                <p class="text-muted mb-2">Offer is valid on orders of Rs.500 Or
                                                    above for selected products only.</p>
                                                <small class="mb-0 text-muted">12 Dec, 2021</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div
                                                        class="avatar-title rounded-circle bg-danger-subtle text-danger material-shadow">
                                                        <i class="ri-bookmark-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Favorite Product</h6>
                                                <p class="text-muted mb-2">Esther James have Favorite product.
                                                </p>
                                                <small class="mb-0 text-muted">25 Nov, 2021</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div
                                                        class="avatar-title rounded-circle bg-secondary material-shadow">
                                                        <i class="mdi mdi-sale fs-14"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Flash sale starting <span
                                                        class="text-primary">Tomorrow.</span></h6>
                                                <p class="text-muted mb-0">Flash sale by <a href="javascript:void(0);"
                                                        class="link-secondary fw-medium">Zoetic Fashion</a></p>
                                                <small class="mb-0 text-muted">22 Oct, 2021</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item py-3 d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div
                                                        class="avatar-title rounded-circle bg-info-subtle text-info material-shadow">
                                                        <i class="ri-line-chart-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Monthly sales report</h6>
                                                <p class="text-muted mb-2"><span class="text-danger">2 days
                                                        left</span> notification to submit the monthly sales
                                                    report. <a href="javascript:void(0);"
                                                        class="link-warning text-decoration-underline">Reports
                                                        Builder</a></p>
                                                <small class="mb-0 text-muted">15 Oct</small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="/libaries/templates/bee-cloudy-admin/assets/images/users/avatar-3.jpg"
                                                    alt=""
                                                    class="avatar-xs rounded-circle acitivity-avatar material-shadow" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 lh-base">Frank Hook Commented</h6>
                                                <p class="text-muted mb-2 fst-italic">" A product that has
                                                    reviews is more likable to be sold than a product. "</p>
                                                <small class="mb-0 text-muted">26 Aug, 2021</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3 mt-2">
                                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">Top 10 Categories
                                    </h6>

                                    <ol class="ps-3 text-muted">
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Mobile & Accessories <span
                                                    class="float-end">(10,294)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Desktop <span
                                                    class="float-end">(6,256)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Electronics <span
                                                    class="float-end">(3,479)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Home & Furniture <span
                                                    class="float-end">(2,275)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Grocery <span
                                                    class="float-end">(1,950)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Fashion <span
                                                    class="float-end">(1,582)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Appliances <span
                                                    class="float-end">(1,037)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Beauty, Toys & More <span
                                                    class="float-end">(924)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Food & Drinks <span
                                                    class="float-end">(701)</span></a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="text-muted">Toys & Games <span
                                                    class="float-end">(239)</span></a>
                                        </li>
                                    </ol>
                                    <div class="mt-3 text-center">
                                        <a href="javascript:void(0);"
                                            class="text-muted text-decoration-underline">View all Categories</a>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">Products Reviews</h6>
                                    <!-- Swiper -->
                                    <div class="swiper vertical-swiper" style="height: 250px;">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="card border border-dashed shadow-none">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 avatar-sm">
                                                                <div
                                                                    class="avatar-title bg-light rounded material-shadow">
                                                                    <img src="/libaries/templates/bee-cloudy-admin/assets/images/companies/img-1.png"
                                                                        alt="" height="30">
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <div>
                                                                    <p
                                                                        class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                        " Great product and looks great, lots of
                                                                        features. "</p>
                                                                    <div class="fs-11 align-middle text-warning">
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mb-0 text-muted">
                                                                    - by <cite title="Source Title">Force
                                                                        Medicines</cite>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="card border border-dashed shadow-none">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0">
                                                                <img src="/libaries/templates/bee-cloudy-admin/assets/images/users/avatar-3.jpg"
                                                                    alt=""
                                                                    class="avatar-sm rounded material-shadow">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <div>
                                                                    <p
                                                                        class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                        " Amazing template, very easy to
                                                                        understand and manipulate. "</p>
                                                                    <div class="fs-11 align-middle text-warning">
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-half-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mb-0 text-muted">
                                                                    - by <cite title="Source Title">Henry
                                                                        Baird</cite>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="card border border-dashed shadow-none">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 avatar-sm">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="/libaries/templates/bee-cloudy-admin/assets/images/companies/img-8.png"
                                                                        alt="" height="30">
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <div>
                                                                    <p
                                                                        class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                        "Very beautiful product and Very helpful
                                                                        customer service."</p>
                                                                    <div class="fs-11 align-middle text-warning">
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-line"></i>
                                                                        <i class="ri-star-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mb-0 text-muted">
                                                                    - by <cite title="Source Title">Zoetic
                                                                        Fashion</cite>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="card border border-dashed shadow-none">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0">
                                                                <img src="/libaries/templates/bee-cloudy-admin/assets/images/users/avatar-2.jpg"
                                                                    alt=""
                                                                    class="avatar-sm rounded material-shadow">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <div>
                                                                    <p
                                                                        class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                        " The product is very beautiful. I like
                                                                        it. "</p>
                                                                    <div class="fs-11 align-middle text-warning">
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-fill"></i>
                                                                        <i class="ri-star-half-fill"></i>
                                                                        <i class="ri-star-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mb-0 text-muted">
                                                                    - by <cite title="Source Title">Nancy
                                                                        Martino</cite>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3">
                                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">Customer Reviews</h6>
                                    <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="fs-16 align-middle text-warning">
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-fill"></i>
                                                    <i class="ri-star-half-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h6 class="mb-0">4.5 out of 5</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-muted">Total <span class="fw-medium">5.50k</span>
                                            reviews</div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">5 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 50.16%" aria-valuenow="50.16"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">2758</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">4 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 29.32%" aria-valuenow="29.32"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">1063</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">3 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 18.12%" aria-valuenow="18.12"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">997</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">2 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 4.98%" aria-valuenow="4.98"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">227</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0">1 star</h6>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-1">
                                                    <div class="progress animated-progress progress-sm">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 7.42%" aria-valuenow="7.42"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="p-1">
                                                    <h6 class="mb-0 text-muted">408</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card sidebar-alert bg-light border-0 text-center mx-4 mb-0 mt-3">
                                    <div class="card-body">
                                        <img src="/libaries/templates/bee-cloudy-admin/assets/images/giftbox.png"
                                            alt="">
                                        <div class="mt-4">
                                            <h5>Invite New Seller</h5>
                                            <p class="text-muted lh-base">Refer a new seller to us and earn $100
                                                per refer.</p>
                                            <button type="button" class="btn btn-primary btn-label rounded-pill"><i
                                                    class="ri-mail-fill label-icon align-middle rounded-pill fs-16 me-2"></i>
                                                Invite Now</button>
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
</div>
<script>
    let orderGraph = @json(array_values($orderGraph));
    let moneyGraph = @json(array_values($moneyGraph));
</script>
