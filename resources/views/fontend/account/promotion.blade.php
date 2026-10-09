@extends('fontend.home.layout')
@section('page_title')
Khuyến mãi của bạn
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
                    <li class="breadcrumb-item active" aria-current="page">Khuyến mãi của tôi</li>
                </ol>
            </nav>
            <!-- end breadcrumb  -->
            <div class="profile-main">
                @include('fontend.account.components.header-profile')
                <div class="body-profile">
                    <div class="row">
                        @include('fontend.account.components.aside')
                        @if ($userVouchers != null)
                            <div class="col-lg-9 col-md-8 flex-grow-1">
                                <div class="article-profile mb-5">
                                    <div class="card border-0 bg-white">
                                        <div class="card-header d-flex justify-content-between align-items-center border-0">
                                            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Voucher của tôi</h6>

                                        </div>
                                    </div>
                                    <div class="card border-0 rounded-2 mt-3 p-3">
                                        @forelse($userVouchers as $userVoucher)
                                            @if($userVoucher->isUsed === 1)
                                            <div
                                                class="voucher-item mb-3 py-0 text-muted border-0 rounded shadow-sm ">
                                                <div class="row">
                                                    <div class="row g-0">
                                                        <div class="col-auto position-relative">
                                                            <div
                                                                class="h-100 bg-danger rounded-start d-flex align-items-center px-3">
                                                                <i class="fas fa-gift text-white fa-2x"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col ">
                                                            <div class="p-2">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <h5 class="text-muted mb-3">
                                                                            {{ optional($userVoucher->promotion)->name ?? '' }}
                                                                        </h5>
                                                                        <div class="voucher-details">
                                                                            <div class="mb-1">
                                                                                <span class="text-muted fz-14">Mã
                                                                                    voucher:</span>
                                                                                <span
                                                                                    class="text-danger px-2 fw-500 py-2 ms-2">{{ optional($userVoucher->promotion)->code ?? '' }}</span>
                                                                            </div>
                                                                            <div class="mb-1">
                                                                                <span class="text-muted fz-14">Giá trị:</span>
                                                                                <span
                                                                                    class="fw-bold ms-2">{{ number_format(optional($userVoucher->promotion)->discount, '0', ',', '.') . ' đ' ?? '' }}</span>
                                                                            </div>
                                                                            <div class="d-flex flex-wrap gap-4">
                                                                                <div class="mb-1">
                                                                                    <span class="text-muted fz-14">Hạn sử dụng
                                                                                        đến: </span>
                                                                                    <span
                                                                                        class="fw-bold ms-2">{{ date('d-m-Y', strtotime(optional($userVoucher->promotion)->end_date)) ?? 'Chưa xác định' }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                                                        <div class="d-flex justify-content-end gap-2">
                                                                            <button
                                                                                class="btn-promotion btn btn-light btn-sm fw-medium text-info rounded-pill shadow-sm hover-lift me-3 d-flex align-items-center"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#voucherModal{{ $userVoucher->id }}"
                                                                                style="margin-top: 90px">
                                                                                <i class="fas fa-arrow-right me-1"></i>
                                                                                <span class="d-none d-xl-block ">Chi tiết</span>
                                                                            </button>
                                                                            <a href="{{ route('cart.index') }}"
                                                                                class="btn-promotion btn btn-success btn-sm fw-medium text-white rounded-pill shadow-sm hover-lift me-2 d-flex align-items-center"
                                                                                style="margin-top: 90px">
                                                                                <i class="fa-solid fa-check me-1"></i>
                                                                                <span class="d-none d-xl-block ">
                                                                                    Sử dụng
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal for voucher details -->

                                            <div class="modal fade" id="voucherModal{{ $userVoucher->id }}" tabindex="-1"
                                                aria-labelledby="voucherModalLabel{{ $userVoucher->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title"
                                                                id="voucherModalLabel{{ $userVoucher->id }}">
                                                                <i class="fas fa-ticket-alt me-2"></i>Chi tiết Voucher
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <div class="text-center mb-4">
                                                                <span class="badge bg-success p-3 rounded-circle">
                                                                    <i class="fas fa-gift fa-2x"></i>
                                                                </span>
                                                            </div>

                                                            <h5 class="text-muted text-center text-break mb-4">
                                                                {{ optional($userVoucher->promotion)->name ?? '' }}
                                                            </h5>

                                                            <div class="voucher-info">
                                                                <div class="row mb-3 py-2 border-bottom">
                                                                    <div class="col-4 text-muted">Mã voucher</div>
                                                                    <div class="col-8 text-end">
                                                                        <span
                                                                            class="text-danger">{{ optional($userVoucher->promotion)->code ?? '' }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3 py-2 border-bottom">
                                                                    <div class="col-4 text-muted">Khuyến mãi</div>
                                                                    <div class="col-8 text-end fw-bold">
                                                                        {{ number_format(optional($userVoucher->promotion)->discount, '0', ',', '.') . ' đ' ?? '' }}
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3 py-2 border-bottom">
                                                                    <div class="col-4 text-muted">Thời gian</div>
                                                                    <div class="col-8 text-end">
                                                                        {{ date('d-m-Y', strtotime(optional($userVoucher->promotion)->start_date)) ?? 'Chưa xác định' }}
                                                                        <i class="fas fa-arrow-right mx-2"></i>
                                                                        {{ date('d-m-Y', strtotime(optional($userVoucher->promotion)->end_date)) ?? 'Chưa xác định' }}
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3 py-2 border-bottom">
                                                                    <div class="col-4 text-muted">Trạng thái</div>
                                                                    <div class="col-8 text-end">
                                                                        <span
                                                                            class="badge {{ $userVoucher->isUsed === 0 ? 'bg-secondary' : 'bg-success' }}">
                                                                            {{ $userVoucher->isUsed === 0 ? 'Đã sử dụng' : 'Chưa sử dụng' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="mt-4 {{ optional($userVoucher->promotion)->minimum_amount == 0 || optional($userVoucher->promotion)->minimum_amount == null ? 'hidden-visibility' : '' }}">
                                                                    <h6 class="text-muted mb-3">Điều kiện áp dụng:</h6>
                                                                    <p class="small">
                                                                        - Đơn hàng phải có giá trị trên
                                                                        {{ number_format(optional($userVoucher->promotion)->minimum_amount, '0', ',', '.') . ' đ' ?? '' }}
                                                                    </p>
                                                                </div>
                                                                <div class="mt-4 fz-14">
                                                                    <h6 class="text-muted mb-3">Hướng dẫn sử dụng:</h6>
                                                                    <p class="small ">
                                                                        {!! optional($userVoucher->promotion)->description ?? 'Chưa có hướng dẫn cụ thể' !!}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="fas fa-times me-1"></i>Đóng
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @empty
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
                                                    <a href="{{ route('promotion.home_index') }}"
                                                        class="btn btn-info text-white rounded-pill mt-3">Khám
                                                        phá ngay </a>
                                                </div>
                                            </div>
                                        @endforelse
                                        <div class="d-flex justify-content-center mt-4">
                                            {{ $userVouchers->onEachSide(3)->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>
@endsection
