@extends('fontend.home.layout')
@section('page_title')
    Đơn hàng
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="#" class="text-decoration-none text-muted">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="profile-main">
                    @include('fontend.account.components.header-profile')
                    <div class="body-profile">
                        <div class="row">
                            @include('fontend.account.components.aside')
                            <div class="col-lg-9 col-md-8 flex-grow-1">
                                <div class="article-profile">
                                    <div class="card border-0 bg-white">
                                        <div
                                            class="card-header d-flex justify-content-between justify-items-center border-0">
                                            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Đơn hàng</h6>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row justify-content-end">
                                            <div class="col-md-6">
                                                <form action="{{ route('account.order') }}" method="GET">
                                                    <div
                                                        class="d-flex shadow-sm rounded-pill py-1 my-3 overflow-hidden bg-white">
                                                        <input type="text" name="keyword"
                                                            class="form-control border-0 py-2 ps-3 pe-0"
                                                            placeholder="Tìm theo tên đơn, mã đơn hoặc tên sản phẩm"
                                                            value="{{ request('keyword') ?: old('keyword') }}"
                                                            style="box-shadow: none;">
                                                        <button type="submit" class="btn px-4 border-0">
                                                            <i class="fas fa-search fz-18 text-muted"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card border-0 mb-5">
                                        <div class="card-body p-0">
                                            <div class="bg-white shadow-sm">
                                                <div class="step-arrow-nav">
                                                    <ul class="nav nav-tabs nav-justified custom-nav ps-0 "
                                                        role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button"
                                                                class=" fw-medium nav-link fz-14 px-2 py-3 rounded-0 text-bg-light active show"
                                                                data-bs-toggle="tab" data-bs-target="#all_order">
                                                                Tất cả
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button"
                                                                class=" nav-link fz-14 fw-medium px-2 py-3 rounded-0 text-bg-light"
                                                                data-bs-toggle="tab" data-bs-target="#pending">
                                                                Đang xử lý
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button"
                                                                class=" nav-link fz-14 fw-medium px-2 py-3 rounded-0 text-bg-light"
                                                                data-bs-toggle="tab" data-bs-target="#shipping">

                                                                Đang vận chuyển
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button"
                                                                class=" nav-link fz-14 fw-medium px-2 py-3 rounded-0 text-bg-light"
                                                                data-bs-toggle="tab" data-bs-target="#completed">

                                                                Thành công
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button"
                                                                class=" nav-link fz-14 fw-medium px-2 py-3 rounded-0 text-bg-light"
                                                                data-bs-toggle="tab" data-bs-target="#canceled">
                                                                Đã hủy
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- end tab content -->
                                                <div class="tab-content p-3 overflow-y-auto" style="max-height: 1000px" >
                                                    {{-- tab all  --}}
                                                    <div class="tab-pane fade active show" id="all_order">
                                                        <div class="order">
                                                            @if (count($order_all) > 0)
                                                                @foreach ($order_all as $keyvOrder => $valvOrder)
                                                                    @php
                                                                        $statusMap = [
                                                                            'pending' => ['Chờ xác nhận', 'secondary'],
                                                                            'confirmed' => ['Đã xác nhận', 'primary'],
                                                                            'shipping' => [
                                                                                'Đang vận chuyển',
                                                                                'warning',
                                                                            ],
                                                                            'canceled' => ['Đã hủy đơn', 'danger'],
                                                                            'completed' => ['Thành công', 'success'],
                                                                        ];
                                                                        $statusInfo = $statusMap[
                                                                            $valvOrder->status
                                                                        ] ?? ['Không xác định', 'dark'];
                                                                        $statusBadge =
                                                                            '<span class="badge rounded-pill bg-' .
                                                                            $statusInfo[1] .
                                                                            '-subtle text-' .
                                                                            $statusInfo[1] .
                                                                            ' p-2">' .
                                                                            $statusInfo[0] .
                                                                            '</span>';
                                                                        // -- //
                                                                        $statusPayment = '';
                                                                        if ($valvOrder->payment == 'unpaid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-warning text-white d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fa-solid fa-circle-info"></i>
                                                                            Chưa trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrder->payment == 'paid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button
                                                                            class="btn btn-success text-white d-flex align-items-center  gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fas fa-check-circle"></i>
                                                                            Đã trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrder->payment == 'failed') {
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
                                                                    <div
                                                                        class="order-item bg-white shadow-sm rounded mb-3">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center bg-white p-3 border-bottom">
                                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                                <i
                                                                                    class="fa-solid fa-receipt fs-6 text-muted me-2"></i>
                                                                                Mã đơn hàng: #{{ $valvOrder->code }}
                                                                                <div
                                                                                    class="ms-4 me-2 d-flex align-items-center">
                                                                                    {!! $statusBadge !!}
                                                                                </div>
                                                                            </h6>
                                                                            <div class="dropdown ms-auto ">
                                                                                <a class=" dropdown-toggle" href="#"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <i
                                                                                        class="fa-solid fa-ellipsis-vertical fz-14 text-muted"></i>
                                                                                </a>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-end border-0 ul-menu p-0 mb-1">
                                                                                    <li
                                                                                        class="p-1 li-menu-header bg-light shadow-sm">
                                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrder->id]) }}"
                                                                                            class="text-decoration-none text-muted fz-14 ps-1">
                                                                                            <i
                                                                                                class="fa-solid fa-eye me-2"></i>
                                                                                            Xem chi tiết
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrder->id]) }}"
                                                                            class="product_inorder_item text-muted">
                                                                            @if ($valvOrder->orderItems)
                                                                                {{-- @dd($valvOrder->orderItems) --}}
                                                                                @foreach ($valvOrder->orderItems as $orderItem)
                                                                                    <div
                                                                                        class="d-flex align-items-start bg-white p-3 border-bottom">
                                                                                        @if ($orderItem->products)
                                                                                            <img src="{{ $orderItem->products->image ? $orderItem->products->image : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @elseif($orderItem->productVariants)
                                                                                            <img src="{{ $orderItem->productVariants->album ? explode(',', $orderItem->productVariants->album)[0] : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @endif
                                                                                        <div class="flex-grow-1 px-3 name_vieworder"
                                                                                            style="max-width: 80%">
                                                                                            @if ($orderItem->products)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->products->name }}
                                                                                                </p>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->productVariants->name }}
                                                                                                </p>
                                                                                                <ul class="list-inline text-muted fz-12 my-1">
                                                                                                    @if (isset($attributesByOderItem[$orderItem->id]))
                                                                                                        @foreach ($attributesByOderItem[$orderItem->id] as $attribute)
                                                                                                            <li class="list-inline-item">
                                                                                                                {{ $attribute->name }}
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                </ul>
                                                                                            @endif
                                                                                            <p class="mb-0">
                                                                                                x{{ $orderItem->final_quantity }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="text-end">
                                                                                            @if ($orderItem->products)
                                                                                                <span class="text-secondary fz-14 text-danger">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <span
                                                                                                    class="text-danger fz-14">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                            <!-- Footer đơn hàng -->
                                                                            <div
                                                                                class="bg-light d-flex flex-column flex-lg-row justify-content-between align-items-center px-3 py-2 ">
                                                                                <div class="d-flex mb-sm-2">
                                                                                    <span class="me-2">
                                                                                        <i class="bi bi-coin"></i>
                                                                                        Tổng tiền:
                                                                                    </span>
                                                                                    <span
                                                                                        class="text-danger text-end fw-medium mb-0 me-4">{{ number_format($valvOrder->total_amount, '0', ',', '.') }}đ</span>
                                                                                    <span>{!! $statusPayment !!}</span>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <hr class="border-3 pb-3 border-dark">
                                                                @endforeach
                                                            @else
                                                                <div class="order-null p-3">
                                                                    <div class="img-null text-center">
                                                                        <img src="/libaries/upload/images/order-null.png"
                                                                            alt="" class="" width="300"
                                                                            height="200">
                                                                    </div>
                                                                    <div
                                                                        class="flex flex-col text-center align-items-center">
                                                                        <h6 class="mb-2  fw-semibold">Bạn chưa có đơn hàng
                                                                            nào!
                                                                        </h6>
                                                                        <p class="text-center mb-2">
                                                                            Hãy khám phá sản phẩm cùng chúng tôi tại của
                                                                            hàng!
                                                                        </p>
                                                                        <a href="{{ route('shop.index') }}"
                                                                            class="btn btn-danger rounded-pill mt-3">Khám
                                                                            phá ngay </a>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                        <div class="container-fluid">
                                                            {{ $order_all->onEachSide(3)->links('pagination::bootstrap-5') }}
                                                        </div>
                                                    </div>
                                                    {{-- penđing  --}}
                                                    <div class="tab-pane fade" id="pending">
                                                        <div class="order">
                                                            @if (count($order_pending) > 0 || count($order_confirmed) > 0)
                                                                @foreach ($order_pending as $keyvOrderPend => $valvOrderPend)
                                                                    @php
                                                                        $statusMap = [
                                                                            'pending' => ['Chờ xác nhận', 'secondary'],
                                                                            'confirmed' => ['Đã xác nhận', 'primary'],
                                                                            'shipping' => [
                                                                                'Đang vận chuyển',
                                                                                'warning',
                                                                            ],
                                                                            'canceled' => ['Đã hủy đơn', 'danger'],
                                                                            'completed' => ['Thành công', 'success'],
                                                                        ];
                                                                        $statusInfo = $statusMap[
                                                                            $valvOrderPend->status
                                                                        ] ?? ['Không xác định', 'dark'];
                                                                        $statusBadge =
                                                                            '<span class="badge rounded-pill bg-' .
                                                                            $statusInfo[1] .
                                                                            '-subtle text-' .
                                                                            $statusInfo[1] .
                                                                            ' p-2">' .
                                                                            $statusInfo[0] .
                                                                            '</span>';
                                                                        // -- //
                                                                        $statusPayment = '';
                                                                        if ($valvOrderPend->payment == 'unpaid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-warning text-white d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fa-solid fa-circle-info"></i>
                                                                            Chưa trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrderPend->payment == 'paid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button
                                                                            class="btn btn-success text-white d-flex align-items-center  gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fas fa-check-circle"></i>
                                                                            Đã trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrderPend->payment == 'failed') {
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
                                                                    <div
                                                                        class="order-item bg-white shadow-sm rounded mb-3">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center bg-white p-3 border-bottom">
                                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                                <i
                                                                                    class="fa-solid fa-receipt fs-6 text-muted me-2"></i>
                                                                                Mã đơn hàng: #{{ $valvOrderPend->code }}
                                                                                <div
                                                                                    class="ms-4 me-2 d-flex align-items-center">
                                                                                    {!! $statusBadge !!}
                                                                                </div>
                                                                            </h6>
                                                                            <div class="dropdown ms-auto ">
                                                                                <a class=" dropdown-toggle" href="#"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <i
                                                                                        class="fa-solid fa-ellipsis-vertical fz-14 text-muted"></i>
                                                                                </a>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-end border-0 ul-menu p-0 mb-1">
                                                                                    <li
                                                                                        class="p-1 li-menu-header bg-light shadow-sm">
                                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderPend->id]) }}"
                                                                                            class="text-decoration-none text-muted fz-14 ps-1">
                                                                                            <i
                                                                                                class="fa-solid fa-eye me-2"></i>
                                                                                            Xem chi tiết
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderPend->id]) }}"
                                                                            class="product_inorder_item text-muted">
                                                                            @if ($valvOrderPend->orderItems)
                                                                                {{-- @dd($valvOrderPend->orderItems) --}}
                                                                                @foreach ($valvOrderPend->orderItems as $orderItem)
                                                                                    <div
                                                                                        class="d-flex align-items-start bg-white p-3 border-bottom">
                                                                                        @if ($orderItem->products)
                                                                                            <img src="{{ $orderItem->products->image ? $orderItem->products->image : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @elseif($orderItem->productVariants)
                                                                                            <img src="{{ $orderItem->productVariants->album ? explode(',', $orderItem->productVariants->album)[0] : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @endif
                                                                                        <div class="flex-grow-1 px-3 name_vieworder"
                                                                                            style="max-width: 80%">
                                                                                            @if ($orderItem->products)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->products->name }}
                                                                                                </p>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->productVariants->name }}
                                                                                                </p>
                                                                                            @endif
                                                                                            <p class="mb-0">
                                                                                                x{{ $orderItem->final_quantity }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="text-end">
                                                                                            @if ($orderItem->products)
                                                                                                <span class="text-secondary fz-14 text-danger">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <span
                                                                                                    class="text-danger fz-14">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                            <!-- Footer đơn hàng -->
                                                                            <div
                                                                                class="bg-light d-flex justify-content-between align-items-center px-3 py-2">
                                                                                <div class="d-flex">
                                                                                    <span class="me-2">
                                                                                        <i class="bi bi-coin"></i>
                                                                                        Tổng tiền:
                                                                                    </span>
                                                                                    <span class="text-danger fw-medium mb-0 me-4">{{ number_format($valvOrderPend->total_amount, '0', ',', '.') }}đ</span>
                                                                                    <span>{!! $statusPayment !!}</span> 
                                                                                </div>
                                                                                <div
                                                                                    class="d-flex justify-content-end gap-2 {{ $valvOrderPend->status != 'completed' ? 'd-none' : '' }}">
                                                                                    <a href="#"
                                                                                        class="btn btn-outline-success btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i
                                                                                            class="bi bi-arrow-repeat me-1"></i>
                                                                                        Mua lại
                                                                                    </a>
                                                                                    <a href="#"
                                                                                        class="btn btn-success text-white btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i class="bi bi-star me-1"></i>
                                                                                        Đánh giá
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <hr class="border-3 pb-3 border-dark">
                                                                @endforeach
                                                                @foreach ($order_confirmed as $keyvOrderConF => $valvOrderConF)
                                                                    @php
                                                                        $statusMap = [
                                                                            'pending' => ['Chờ xác nhận', 'secondary'],
                                                                            'confirmed' => ['Đã xác nhận', 'primary'],
                                                                            'shipping' => [
                                                                                'Đang vận chuyển',
                                                                                'warning',
                                                                            ],
                                                                            'canceled' => ['Đã hủy đơn', 'danger'],
                                                                            'completed' => ['Thành công', 'success'],
                                                                        ];
                                                                        $statusInfo = $statusMap[
                                                                            $valvOrderConF->status
                                                                        ] ?? ['Không xác định', 'dark'];
                                                                        $statusBadge =
                                                                            '<span class="badge rounded-pill bg-' .
                                                                            $statusInfo[1] .
                                                                            '-subtle text-' .
                                                                            $statusInfo[1] .
                                                                            ' p-2">' .
                                                                            $statusInfo[0] .
                                                                            '</span>';
                                                                        // -- //
                                                                        $statusPayment = '';
                                                                        if ($valvOrderConF->payment == 'unpaid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-warning text-white d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fa-solid fa-circle-info"></i>
                                                                            Chưa trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrderConF->payment == 'paid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button
                                                                            class="btn btn-success text-white d-flex align-items-center  gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fas fa-check-circle"></i>
                                                                            Đã trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrderConF->payment == 'failed') {
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
                                                                    <div
                                                                        class="order-item bg-white shadow-sm rounded mb-3">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center bg-white p-3 border-bottom">
                                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                                <i
                                                                                    class="fa-solid fa-receipt fs-6 text-muted me-2"></i>
                                                                                Mã đơn hàng: #{{ $valvOrderConF->code }}
                                                                                <div
                                                                                    class="ms-4 me-2 d-flex align-items-center">
                                                                                    {!! $statusBadge !!}
                                                                                </div>
                                                                            </h6>
                                                                            <div class="dropdown ms-auto ">
                                                                                <a class=" dropdown-toggle" href="#"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <i
                                                                                        class="fa-solid fa-ellipsis-vertical fz-14 text-muted"></i>
                                                                                </a>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-end border-0 ul-menu p-0 mb-1">
                                                                                    <li
                                                                                        class="p-1 li-menu-header bg-light shadow-sm">
                                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderConF->id]) }}"
                                                                                            class="text-decoration-none text-muted fz-14 ps-1">
                                                                                            <i
                                                                                                class="fa-solid fa-eye me-2"></i>
                                                                                            Xem chi tiết
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderConF->id]) }}"
                                                                            class="product_inorder_item text-muted">
                                                                            @if ($valvOrderConF->orderItems)
                                                                                {{-- @dd($valvOrderConF->orderItems) --}}
                                                                                @foreach ($valvOrderConF->orderItems as $orderItem)
                                                                                    <div
                                                                                        class="d-flex align-items-start bg-white p-3 border-bottom">
                                                                                        @if ($orderItem->products)
                                                                                            <img src="{{ $orderItem->products->image ? $orderItem->products->image : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @elseif($orderItem->productVariants)
                                                                                            <img src="{{ $orderItem->productVariants->album ? explode(',', $orderItem->productVariants->album)[0] : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @endif
                                                                                        <div class="flex-grow-1 px-3 name_vieworder"
                                                                                            style="max-width: 80%">
                                                                                            @if ($orderItem->products)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->products->name }}
                                                                                                </p>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->productVariants->name }}
                                                                                                </p>
                                                                                            @endif
                                                                                            <p class="mb-0">
                                                                                                x{{ $orderItem->final_quantity }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="text-end">
                                                                                            @if ($orderItem->products)
                                                                                                {{-- <span  class="text-secondary fz-14 text-danger">{{ number_format($orderItem->products->price, '0', ',', '.') }}đ</span> --}}
                                                                                                <span class="text-secondary fz-14 text-danger">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <span
                                                                                                    class="text-danger fz-14">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                            <!-- Footer đơn hàng -->
                                                                            <div
                                                                                class="bg-light d-flex justify-content-between align-items-center px-3 py-2">
                                                                                <div class="d-flex">
                                                                                    <span class="me-2">
                                                                                        <i class="bi bi-coin"></i>
                                                                                        Tổng tiền:
                                                                                    </span>
                                                                                    <span
                                                                                        class="text-danger fw-medium mb-0 me-4">{{ number_format($valvOrderConF->total_amount, '0', ',', '.') }}đ</span>
                                                                                    <span>{!! $statusPayment !!}</span>
                                                                                </div>
                                                                                <div
                                                                                    class="d-flex justify-content-end gap-2 {{ $valvOrderConF->status != 'completed' ? 'd-none' : '' }}">
                                                                                    <a href="#"
                                                                                        class="btn btn-outline-success btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i
                                                                                            class="bi bi-arrow-repeat me-1"></i>
                                                                                        Mua lại
                                                                                    </a>
                                                                                    <a href="#"
                                                                                        class="btn btn-success text-white btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i class="bi bi-star me-1"></i>
                                                                                        Đánh giá
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <hr class="border-3 pb-3 border-dark">
                                                                @endforeach
                                                            @else
                                                                <div class="order-null p-3">
                                                                    <div class="img-null text-center">
                                                                        <img src="/libaries/upload/images/order-null.png"
                                                                            alt="" class="" width="300"
                                                                            height="200">
                                                                    </div>
                                                                    <div
                                                                        class="flex flex-col text-center align-items-center">
                                                                        <h6 class="mb-2  fw-semibold">Bạn chưa có đơn hàng
                                                                            nào!
                                                                        </h6>
                                                                        <p class="text-center mb-2">
                                                                            Hãy khám phá sản phẩm cùng chúng tôi tại của
                                                                            hàng!
                                                                        </p>
                                                                        <a href="{{ route('shop.index') }}"
                                                                            class="btn btn-danger rounded-pill mt-3">Khám
                                                                            phá ngay </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="container-fluid">
                                                            {{ $order_pending->onEachSide(3)->links('pagination::bootstrap-5') }}
                                                        </div>
                                                    </div>
                                                    {{-- shipping  --}}
                                                    <div class="tab-pane fade" id="shipping">
                                                        <div class="order">
                                                            @if (count($order_shipping) > 0)
                                                                @foreach ($order_shipping as $keyvOrderShip => $valvOrderShip)
                                                                    @php
                                                                        $statusMap = [
                                                                            'pending' => ['Chờ xác nhận', 'secondary'],
                                                                            'confirmed' => ['Đã xác nhận', 'primary'],
                                                                            'shipping' => [
                                                                                'Đang vận chuyển',
                                                                                'warning',
                                                                            ],
                                                                            'canceled' => ['Đã hủy đơn', 'danger'],
                                                                            'completed' => ['Thành công', 'success'],
                                                                        ];
                                                                        $statusInfo = $statusMap[
                                                                            $valvOrderShip->status
                                                                        ] ?? ['Không xác định', 'dark'];
                                                                        $statusBadge =
                                                                            '<span class="badge rounded-pill bg-' .
                                                                            $statusInfo[1] .
                                                                            '-subtle text-' .
                                                                            $statusInfo[1] .
                                                                            ' p-2">' .
                                                                            $statusInfo[0] .
                                                                            '</span>';
                                                                        // -- //
                                                                        $statusPayment = '';
                                                                        if ($valvOrderShip->payment == 'unpaid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-warning text-white d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fa-solid fa-circle-info"></i>
                                                                            Chưa trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrderShip->payment == 'paid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button
                                                                            class="btn btn-success text-white d-flex align-items-center  gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fas fa-check-circle"></i>
                                                                            Đã trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrderShip->payment == 'failed') {
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
                                                                    <div
                                                                        class="order-item bg-white shadow-sm rounded mb-3">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center bg-white p-3 border-bottom">
                                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                                <i
                                                                                    class="fa-solid fa-receipt fs-6 text-muted me-2"></i>
                                                                                Mã đơn hàng: #{{ $valvOrderShip->code }}
                                                                                <div
                                                                                    class="ms-4 me-2 d-flex align-items-center">
                                                                                    {!! $statusBadge !!}
                                                                                </div>
                                                                            </h6>
                                                                            <div class="dropdown ms-auto ">
                                                                                <a class=" dropdown-toggle" href="#"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <i
                                                                                        class="fa-solid fa-ellipsis-vertical fz-14 text-muted"></i>
                                                                                </a>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-end border-0 ul-menu p-0 mb-1">
                                                                                    <li
                                                                                        class="p-1 li-menu-header bg-light shadow-sm">
                                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderShip->id]) }}"
                                                                                            class="text-decoration-none text-muted fz-14 ps-1">
                                                                                            <i
                                                                                                class="fa-solid fa-eye me-2"></i>
                                                                                            Xem chi tiết
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderShip->id]) }}"
                                                                            class="product_inorder_item text-muted">
                                                                            @if ($valvOrderShip->orderItems)
                                                                                {{-- @dd($valvOrderShip->orderItems) --}}
                                                                                @foreach ($valvOrderShip->orderItems as $orderItem)
                                                                                    <div
                                                                                        class="d-flex align-items-start bg-white p-3 border-bottom">
                                                                                        @if ($orderItem->products)
                                                                                            <img src="{{ $orderItem->products->image ? $orderItem->products->image : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @elseif($orderItem->productVariants)
                                                                                            <img src="{{ $orderItem->productVariants->album ? explode(',', $orderItem->productVariants->album)[0] : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @endif
                                                                                        <div class="flex-grow-1 px-3 name_vieworder"
                                                                                            style="max-width: 80%">
                                                                                            @if ($orderItem->products)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->products->name }}
                                                                                                </p>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->productVariants->name }}
                                                                                                </p>
                                                                                            @endif
                                                                                            <p class="mb-0">
                                                                                                x{{ $orderItem->final_quantity }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="text-end">
                                                                                            @if ($orderItem->products)
                                                                                                {{-- <span  class="text-secondary fz-14 text-danger">{{ number_format($orderItem->products->price, '0', ',', '.') }}đ</span> --}}
                                                                                                <span class="text-secondary fz-14 text-danger">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <span
                                                                                                    class="text-danger fz-14">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                            <!-- Footer đơn hàng -->
                                                                            <div
                                                                                class="bg-light d-flex justify-content-between align-items-center px-3 py-2">
                                                                                <div class="d-flex">
                                                                                    <span class="me-2">
                                                                                        <i class="bi bi-coin"></i>
                                                                                        Tổng tiền:
                                                                                    </span>
                                                                                    <span class="text-danger fw-medium mb-0 me-4">{{ number_format($valvOrderShip->total_amount, '0', ',', '.') }}đ</span>
                                                                                    <span>{!! $statusPayment !!}</span> 
                                                                                </div>
                                                                                <div
                                                                                    class="d-flex justify-content-end gap-2 {{ $valvOrderShip->status != 'completed' ? 'd-none' : '' }}">
                                                                                    <a href="#"
                                                                                        class="btn btn-outline-success btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i
                                                                                            class="bi bi-arrow-repeat me-1"></i>
                                                                                        Mua lại
                                                                                    </a>
                                                                                    <a href="#"
                                                                                        class="btn btn-success text-white btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i class="bi bi-star me-1"></i>
                                                                                        Đánh giá
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <hr class="border-3 pb-3 border-dark">
                                                                @endforeach
                                                            @else
                                                                <div class="order-null p-3">
                                                                    <div class="img-null text-center">
                                                                        <img src="/libaries/upload/images/order-null.png"
                                                                            alt="" class="" width="300"
                                                                            height="200">
                                                                    </div>
                                                                    <div
                                                                        class="flex flex-col text-center align-items-center">
                                                                        <h6 class="mb-2  fw-semibold">Bạn chưa có đơn hàng
                                                                            nào!
                                                                        </h6>
                                                                        <p class="text-center mb-2">
                                                                            Hãy khám phá sản phẩm cùng chúng tôi tại của
                                                                            hàng!
                                                                        </p>
                                                                        <a href="{{ route('shop.index') }}"
                                                                            class="btn btn-danger rounded-pill mt-3">Khám
                                                                            phá ngay </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="container-fluid">
                                                            {{ $order_shipping->onEachSide(3)->links('pagination::bootstrap-5') }}
                                                        </div>
                                                    </div>
                                                    {{-- completed  --}}
                                                    <div class="tab-pane fade" id="completed">
                                                        <div class="order">
                                                            @if (count($order_completed) > 0)
                                                                @foreach ($order_completed as $keyvOrderComp => $valvOrderComp)
                                                                    @php
                                                                        $statusMap = [
                                                                            'pending' => ['Chờ xác nhận', 'secondary'],
                                                                            'confirmed' => ['Đã xác nhận', 'primary'],
                                                                            'shipping' => [
                                                                                'Đang vận chuyển',
                                                                                'warning',
                                                                            ],
                                                                            'canceled' => ['Đã hủy đơn', 'danger'],
                                                                            'completed' => ['Thành công', 'success'],
                                                                        ];
                                                                        $statusInfo = $statusMap[
                                                                            $valvOrderComp->status
                                                                        ] ?? ['Không xác định', 'dark'];
                                                                        $statusBadge =
                                                                            '<span class="badge rounded-pill bg-' .
                                                                            $statusInfo[1] .
                                                                            '-subtle text-' .
                                                                            $statusInfo[1] .
                                                                            ' p-2">' .
                                                                            $statusInfo[0] .
                                                                            '</span>';
                                                                        // -- //
                                                                        $statusPayment = '';
                                                                        if ($valvOrderComp->payment == 'unpaid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-warning text-white d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fa-solid fa-circle-info"></i>
                                                                            Chưa trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrderComp->payment == 'paid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button
                                                                            class="btn btn-success text-white d-flex align-items-center  gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fas fa-check-circle"></i>
                                                                            Đã trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrderComp->payment == 'failed') {
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
                                                                    <div
                                                                        class="order-item bg-white shadow-sm rounded mb-3">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center bg-white p-3 border-bottom">
                                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                                <i
                                                                                    class="fa-solid fa-receipt fs-6 text-muted me-2"></i>
                                                                                Mã đơn hàng: #{{ $valvOrderComp->code }}
                                                                                <div
                                                                                    class="ms-4 me-2 d-flex align-items-center">
                                                                                    {!! $statusBadge !!}
                                                                                </div>
                                                                            </h6>
                                                                            <div class="dropdown ms-auto ">
                                                                                <a class=" dropdown-toggle" href="#"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <i
                                                                                        class="fa-solid fa-ellipsis-vertical fz-14 text-muted"></i>
                                                                                </a>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-end border-0 ul-menu p-0 mb-1">
                                                                                    <li
                                                                                        class="p-1 li-menu-header bg-light shadow-sm">
                                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderComp->id]) }}"
                                                                                            class="text-decoration-none text-muted fz-14 ps-1">
                                                                                            <i
                                                                                                class="fa-solid fa-eye me-2"></i>
                                                                                            Xem chi tiết
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderComp->id]) }}"
                                                                            class="product_inorder_item text-muted">
                                                                            @if ($valvOrderComp->orderItems)
                                                                                {{-- @dd($valvOrderComp->orderItems) --}}
                                                                                @foreach ($valvOrderComp->orderItems as $orderItem)
                                                                                    <div
                                                                                        class="d-flex align-items-start bg-white p-3 border-bottom">
                                                                                        @if ($orderItem->products)
                                                                                            <img src="{{ $orderItem->products->image ? $orderItem->products->image : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @elseif($orderItem->productVariants)
                                                                                            <img src="{{ $orderItem->productVariants->album ? explode(',', $orderItem->productVariants->album)[0] : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @endif
                                                                                        <div class="flex-grow-1 px-3 name_vieworder"
                                                                                            style="max-width: 80%">
                                                                                            @if ($orderItem->products)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->products->name }}
                                                                                                </p>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->productVariants->name }}
                                                                                                </p>
                                                                                            @endif
                                                                                            <p class="mb-0">
                                                                                                x{{ $orderItem->final_quantity }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="text-end">
                                                                                            @if ($orderItem->products)
                                                                                                {{-- <span  class="text-secondary fz-14 text-danger">{{ number_format($orderItem->products->price, '0', ',', '.') }}đ</span> --}}
                                                                                                <span class="text-secondary fz-14 text-danger">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <span
                                                                                                    class="text-danger fz-14">{{ number_format($orderItem->final_price, '0', ',', '.') }}đ</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                            <!-- Footer đơn hàng -->
                                                                            <div
                                                                                class="bg-light d-flex justify-content-between align-items-center px-3 py-2">
                                                                                <div class="d-flex">
                                                                                    <span class="me-2">
                                                                                        <i class="bi bi-coin"></i>
                                                                                        Tổng tiền:
                                                                                    </span>
                                                                                    <span class="text-danger fw-medium mb-0 me-4">{{ number_format($valvOrderComp->total_amount, '0', ',', '.') }}đ</span>
                                                                                    <span>{!! $statusPayment !!}</span>
                                                                                </div>
                                                                                <div
                                                                                    class="d-flex justify-content-end gap-2 {{ $valvOrderComp->status != 'completed' ? 'd-none' : '' }}">
                                                                                    <a href="#"
                                                                                        class="btn btn-outline-success btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i
                                                                                            class="bi bi-arrow-repeat me-1"></i>
                                                                                        Mua lại
                                                                                    </a>
                                                                                    <a href="#"
                                                                                        class="btn btn-success text-white btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i class="bi bi-star me-1"></i>
                                                                                        Đánh giá
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <hr class="border-3 pb-3 border-dark">
                                                                @endforeach
                                                            @else
                                                                <div class="order-null p-3">
                                                                    <div class="img-null text-center">
                                                                        <img src="/libaries/upload/images/order-null.png"
                                                                            alt="" class="" width="300"
                                                                            height="200">
                                                                    </div>
                                                                    <div
                                                                        class="flex flex-col text-center align-items-center">
                                                                        <h6 class="mb-2  fw-semibold">Bạn chưa có đơn hàng
                                                                            nào!
                                                                        </h6>
                                                                        <p class="text-center mb-2">
                                                                            Hãy khám phá sản phẩm cùng chúng tôi tại của
                                                                            hàng!
                                                                        </p>
                                                                        <a href="{{ route('shop.index') }}"
                                                                            class="btn btn-danger rounded-pill mt-3">Khám
                                                                            phá ngay </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="container-fluid">
                                                            {{ $order_completed->onEachSide(3)->links('pagination::bootstrap-5') }}
                                                        </div>

                                                    </div>
                                                    {{-- canceled  --}}
                                                    <div class="tab-pane fade" id="canceled">
                                                        <div class="order">
                                                            @if (count($order_canceled) > 0)
                                                                @foreach ($order_canceled as $keyvOrderCancel => $valvOrderCancel)
                                                                    @php
                                                                        $statusMap = [
                                                                            'pending' => ['Chờ xác nhận', 'secondary'],
                                                                            'confirmed' => ['Đã xác nhận', 'primary'],
                                                                            'shipping' => [
                                                                                'Đang vận chuyển',
                                                                                'warning',
                                                                            ],
                                                                            'canceled' => ['Đã hủy đơn', 'danger'],
                                                                            'completed' => ['Thành công', 'success'],
                                                                        ];
                                                                        $statusInfo = $statusMap[
                                                                            $valvOrderCancel->status
                                                                        ] ?? ['Không xác định', 'dark'];
                                                                        $statusBadge =
                                                                            '<span class="badge rounded-pill bg-' .
                                                                            $statusInfo[1] .
                                                                            '-subtle text-' .
                                                                            $statusInfo[1] .
                                                                            ' p-2">' .
                                                                            $statusInfo[0] .
                                                                            '</span>';
                                                                        // -- //
                                                                        $statusPayment = '';
                                                                        if ($valvOrderCancel->payment == 'unpaid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-warning text-white d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fa-solid fa-circle-info"></i>
                                                                            Chưa trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif ($valvOrderCancel->payment == 'paid') {
                                                                            $statusPayment = '
                                                                    <div class="d-flex justify-content-end">
                                                                        <button
                                                                            class="btn btn-success text-white d-flex align-items-center  gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                                                            <i class="fas fa-check-circle"></i>
                                                                            Đã trả
                                                                        </button>
                                                                    </div>';
                                                                        } elseif (
                                                                            $valvOrderCancel->payment == 'failed'
                                                                        ) {
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
                                                                    <div
                                                                        class="order-item bg-white shadow-sm rounded mb-3">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center bg-white p-3 border-bottom">
                                                                            <h6 class="mb-0 d-flex align-items-center">
                                                                                <i
                                                                                    class="fa-solid fa-receipt fs-6 text-muted me-2"></i>
                                                                                Mã đơn hàng: #{{ $valvOrderCancel->code }}
                                                                                <div
                                                                                    class="ms-4 me-2 d-flex align-items-center">
                                                                                    {!! $statusBadge !!}
                                                                                </div>
                                                                            </h6>
                                                                            <div class="dropdown ms-auto ">
                                                                                <a class=" dropdown-toggle" href="#"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <i
                                                                                        class="fa-solid fa-ellipsis-vertical fz-14 text-muted"></i>
                                                                                </a>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-end border-0 ul-menu p-0 mb-1">
                                                                                    <li
                                                                                        class="p-1 li-menu-header bg-light shadow-sm">
                                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderCancel->id]) }}"
                                                                                            class="text-decoration-none text-muted fz-14 ps-1">
                                                                                            <i
                                                                                                class="fa-solid fa-eye me-2"></i>
                                                                                            Xem chi tiết
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <a href="{{ route('account.order.detail', ['id' => $valvOrderCancel->id]) }}"
                                                                            class="product_inorder_item text-muted">
                                                                            @if ($valvOrderCancel->orderItems)
                                                                                {{-- @dd($valvOrderCancel->orderItems) --}}
                                                                                @foreach ($valvOrderCancel->orderItems as $orderItem)
                                                                                    <div
                                                                                        class="d-flex align-items-start bg-white p-3 border-bottom">
                                                                                        @if ($orderItem->products)
                                                                                            <img src="{{ $orderItem->products->image ? $orderItem->products->image : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @elseif($orderItem->productVariants)
                                                                                            <img src="{{ $orderItem->productVariants->album ? explode(',', $orderItem->productVariants->album)[0] : '/libaries/upload/images/img-notfound.png' }}"
                                                                                                alt=""
                                                                                                width="90"
                                                                                                height="80"
                                                                                                class="object-fit-contain rounded-3 bg-light">
                                                                                        @endif
                                                                                        <div class="flex-grow-1 px-3 name_vieworder"
                                                                                            style="max-width: 80%">
                                                                                            @if ($orderItem->products)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->products->name }}
                                                                                                </p>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <p
                                                                                                    class="mb-1 fw-medium text-truncate">
                                                                                                    {{ $orderItem->productVariants->name }}
                                                                                                </p>
                                                                                            @endif
                                                                                            <p class="mb-0">
                                                                                                x{{ $orderItem->final_quantity }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="text-end align-middle">
                                                                                            @if ($orderItem->products)
                                                                                                <del
                                                                                                    class="text-secondary fz-14 text-danger">{{ number_format($orderItem->products->price, '0', ',', '.') }}đ</del>
                                                                                            @elseif($orderItem->productVariants)
                                                                                                <span
                                                                                                    class="text-danger fz-14">{{ number_format($orderItem->productVariants->price, '0', ',', '.') }}đ</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                            <!-- Footer đơn hàng -->
                                                                            <div
                                                                                class="bg-light d-flex justify-content-between align-items-center px-3 py-2">
                                                                                <div class="d-flex">
                                                                                    <span class="me-2">
                                                                                        <i class="bi bi-coin"></i>
                                                                                        Tổng tiền:
                                                                                    </span>
                                                                                    <span class="text-danger fw-medium mb-0 me-4">{{ number_format($valvOrderCancel->total_amount, '0', ',', '.') }}đ</span>
                                                                                    <span>{!! $statusPayment !!}</span>
                                                                                </div>
                                                                                <div
                                                                                    class="d-flex justify-content-end gap-2 {{ $valvOrderCancel->status != 'completed' ? 'd-none' : '' }}">
                                                                                    <a href=""
                                                                                        class="btn btn-outline-success btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i
                                                                                            class="bi bi-arrow-repeat me-1"></i>
                                                                                        Mua lại
                                                                                    </a>
                                                                                    <a href="#"
                                                                                        class="btn btn-success text-white btn-sm px-3"
                                                                                        style="min-width: 120px;">
                                                                                        <i class="bi bi-star me-1"></i>
                                                                                        Đánh giá
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <hr class="border-3 pb-3 border-dark">
                                                                @endforeach
                                                            @else
                                                                <div class="order-null p-3">
                                                                    <div class="img-null text-center">
                                                                        <img src="/libaries/upload/images/order-null.png"
                                                                            alt="" class="" width="300"
                                                                            height="200">
                                                                    </div>
                                                                    <div
                                                                        class="flex flex-col text-center align-items-center">
                                                                        <h6 class="mb-2  fw-semibold">Bạn chưa có đơn hàng
                                                                            nào!
                                                                        </h6>
                                                                        <p class="text-center mb-2">
                                                                            Hãy khám phá sản phẩm cùng chúng tôi tại của
                                                                            hàng!
                                                                        </p>
                                                                        <a href="{{ route('shop.index') }}"
                                                                            class="btn btn-danger rounded-pill mt-3">Khám
                                                                            phá ngay </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="container-fluid">
                                                            {{ $order_canceled->onEachSide(3)->links('pagination::bootstrap-5') }}
                                                        </div>
                                                    </div>
                                                    <!-- end tab pane -->
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
        </article>
    </section>
@endsection
