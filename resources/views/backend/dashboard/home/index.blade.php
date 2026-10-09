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
                                                <span class="text-decoration-underline text-primary ">Năm {{ \Carbon\Carbon::now()->format('Y') }}
                                                </span>
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
                                                        data-target="{{ round($conversionRateYear > 0 ? $conversionRateYear : '0', 1, PHP_ROUND_HALF_EVEN) }}"></span>
                                                    %
                                                </h4>
                                                <span class="text-decoration-underline text-primary">Tỉ lệ chuyển
                                                    đổi/năm</span>
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
                                                năm
                                            </button>
                                        </div>
                                    </div>

                                    <h6 class="text-center"></h6>
                                    <div class="card-header p-0 border-0 bg-light-subtle">
                                        <div class="row g-0 text-center">
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1"><span class="counter-value"
                                                            data-target="{{ $totalEMonth }}"></span></h5>
                                                    <p class="text-muted mb-0">Doanh thu <span class="fz-12">/Tháng {{ \Carbon\Carbon::now()->format('m') }}</span></p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1"><span class="counter-value"
                                                            data-target="{{ $countTotalOrderMonth }}"></span></h5>
                                                    <p class="text-muted mb-0">Đơn hàng <span class="fz-12">/Tháng {{ \Carbon\Carbon::now()->format('m') }}</span></p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1"><span class="counter-value"
                                                            data-target="{{ $countUserMonth }}"></span></h5>
                                                    <p class="text-muted mb-0">Khách hàng <span class="fz-12">/Tháng {{ \Carbon\Carbon::now()->format('m') }}</span></p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                    <h5 class="mb-1 text-success"><span class="counter-value"
                                                            data-target="{{ round($conversionRate > 0 ? $conversionRate : '0', 1, PHP_ROUND_HALF_EVEN) }}"></span> %</h5>
                                                    <p class="text-muted mb-0">Chuyển đổi <span class="fz-12">/Tháng {{ \Carbon\Carbon::now()->format('m') }}</span></p>
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
                                                {{ $orderRecents->appends(['order_page' => request('order_page')])->onEachSide(3)->links('pagination::bootstrap-5') }}
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
                                                {{ $productSalers->appends(['product_page' => request('product_page')])->onEachSide(3)->links('pagination::bootstrap-5') }}
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
</div>
<script>
    let orderGraph = @json(array_values($orderGraph));
    let moneyGraph = @json(array_values($moneyGraph));
</script>
