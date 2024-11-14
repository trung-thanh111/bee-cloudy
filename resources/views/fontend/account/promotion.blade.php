@extends('fontend.home.layout')
@section('page_title')
    Thông tin cá nhân
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
                        <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="profile-main">
                    <div class="header-profile mb-3">
                        <div class="text-muted d-flex justify-content-between align-items ">
                            <div class="row ps-lg-3 pe-lg-3 p-lg-5 p-md-5 p-sm-4 p-xs-3">
                                <div class="col-lg-4 col-md-4">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif"
                                        alt="image user acount" class="rounded-circle " width="90px" height="90px">
                                </div>
                                <div class="col-lg-8 col-md-8 align-items-center">
                                    <div class="news-profile  mt-2">
                                        <h6 class="fw-bold  fz-18">Thanh trung</h6>
                                        <p class="fz-13">Ngày tham gia: 27/45/3455</p>
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
                            @include('fontend.account.components.aside')
                            @if ($userVouchers != null)
                            dd()
                                <div class="container my-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <img src="/api/placeholder/150/150" alt="Voucher Code"
                                                            class="me-3">
                                                        <div>
                                                            <h5 class="card-title mb-0">Voucher Name</h5>
                                                            <p class="card-text text-success font-weight-bold">-20%</p>
                                                        </div>
                                                    </div>
                                                    <div class="border-top my-3">
                                                        <p class="card-text">Minimum Value: $10</p>
                                                        <p class="card-text">Valid from: 01/01/2023 to 31/12/2023</p>
                                                        <p class="card-text">Apply for: All Products</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="badge badge-secondary p-2">ABCD1234</span>
                                                        <button class="btn btn-primary">Apply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8 flex-grow-1">
                                    <div class="card">
                                        <div class="card-header border-0">
                                            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Voucher của tôi</h6>
                                        </div>
                                        <div class="card-body">
                                            @forelse($userVouchers as $userVoucher)
                                                <div class="voucher-item mb-3 p-3 border rounded shadow-sm">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <h5 class="fz-16 fw-bold text-primary mb-2">
                                                                {{ optional($userVoucher->promotion)->name ?? '' }}
                                                            </h5>
                                                            <p class="fz-14 mb-1">Mã: <strong
                                                                    class="text-danger">{{ $userVoucher->code }}</strong>
                                                            </p>
                                                            <p class="fz-14 mb-1">Giảm giá:
                                                                <span
                                                                    class="fw-bold">{{ optional($userVoucher->promotion)->discount ?? '' }}</span>
                                                            </p>
                                                            {{-- <p class="fz-14 mb-1">Ngày bắt đầu:
                                                                {{ optional($userVoucher->promotion->start_date)->format('d-m-Y') ?? 'Không có' }}
                                                            </p>
                                                            <p class="fz-14 mb-1">Hạn sử dụng:
                                                                {{ optional($userVoucher->promotion->end_date)->format('d-m-Y') ?? 'Không có' }}
                                                            </p> --}}
                                                        </div>
                                                        <div class="col-md-3 text-end">
                                                            <span
                                                                class="badge {{ $userVoucher->is_used ? 'bg-secondary' : 'bg-success' }} p-2 mb-2 d-block">
                                                                {{ $userVoucher->is_used ? 'Đã sử dụng' : 'Chưa sử dụng' }}
                                                            </span>
                                                            <a href="{{ route('account.promotion.show', $userVoucher->id) }}"
                                                                class="btn btn-outline-primary btn-sm w-100">Xem Chi
                                                                Tiết</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal for voucher details -->
                                                {{--                                                 
                                                <div class="modal fade" id="voucherModal{{ $userVoucher->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="voucherModalLabel{{ $userVoucher->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="voucherModalLabel{{ $userVoucher->id }}">Chi tiết
                                                                    Voucher</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="fz-16 fw-bold text-primary mb-3">
                                                                    {{ optional($userVoucher->promotion)->name ?? '' }}
                                                                </h5>
                                                                <p class="fz-14 mb-2">Mã: <strong
                                                                        class="text-danger">{{ $userVoucher->code }}</strong>
                                                                </p>
                                                                <p class="fz-14 mb-2">Giảm giá: <span
                                                                        class="fw-bold">{{ optional($userVoucher->promotion)->discount ?? '' }}</span>
                                                                </p>
                                                                <p class="fz-14 mb-2">Ngày bắt đầu:
                                                                    {{ optional($userVoucher->promotion->start_date)->format('d-m-Y') ?? 'Không có' }}
                                                                </p>
                                                                <p class="fz-14 mb-2">Hạn sử dụng:
                                                                    {{ optional($userVoucher->promotion->end_date)->format('d-m-Y') ?? 'Không có' }}
                                                                </p>
                                                                <p class="fz-14 mb-2">Trạng thái: <span
                                                                        class="badge {{ $userVoucher->is_used ? 'bg-secondary' : 'bg-success' }}">{{ $userVoucher->is_used ? 'Đã sử dụng' : 'Chưa sử dụng' }}</span>
                                                                </p>
                                                                <p class="fz-14 mb-0">Điều kiện áp dụng:
                                                                    {{ optional($userVoucher->promotion)->terms_and_conditions ?? 'Không có' }}
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            @empty
                                                <div class="alert alert-info" role="alert">
                                                    <p class="text-center fz-16 mb-0">Bạn chưa có voucher nào.</p>
                                                </div>
                                            @endforelse
                                            <div class="d-flex justify-content-center mt-4">
                                                {{ $userVouchers->links('pagination::bootstrap-4') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
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
                                        <a href="{{ route('account.promotions') }}"
                                            class="btn btn-info text-white rounded-pill mt-3">Khám
                                            phá ngay </a>
                                    </div>
                                </div>
                            @endif
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
