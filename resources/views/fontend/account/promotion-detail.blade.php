@extends('fontend.home.layout')
@section('page_title')
    Thông tin cá nhân
@endsection
@section('content')
<div class="container-full py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="voucher-card position-relative overflow-hidden">
                <div class="voucher-background"></div>
                <div class="voucher-content p-5">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h1 class="display-4 text-primary mb-3">{{ $userVoucher->promotion->name }}</h1>
                            <div class="voucher-code mb-4">
                                <h2 class="h5 text-muted mb-2">{{ $userVoucher->promotion->code }}</h2>
                            </div>
                            <div class="voucher-dates mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar-check text-primary fs-4 me-2"></i>
                                    <div>
                                        <h3 class="h6 text-muted mb-0">Ngày bắt đầu</h3>
                                        <p class="mb-0 fw-bold">{{ $userVoucher->promotion->start_date }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar-x text-primary fs-4 me-2"></i>
                                    <div>
                                        <h3 class="h6 text-muted mb-0">Ngày kết thúc</h3>
                                        <p class="mb-0 fw-bold">{{ $userVoucher->promotion->end_date }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="voucher-status mb-4">
                                <h3 class="h6 text-muted mb-2">Trạng thái</h3>
                                <span class="badge bg-success rounded-pill px-3 py-2 fs-6">Chưa sử dụng</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="voucher-details bg-light p-4 rounded-lg shadow-sm">
                                <h3 class="h5 text-primary mb-3">Điều kiện áp dụng</h3>
                                <p class="mb-4">Áp dụng cho đơn hàng từ {{ $userVoucher->promotion->minimum_amount }} trở lên</p>
                                <h3 class="h5 text-primary mb-3">Mô tả</h3>
                                <p class="mb-0">{{ $userVoucher->promotion->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="voucher-actions mt-4 p-2 d-flex justify-content-between align-items-center">
                    <a href="{{ route('account.promotions') }}" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-arrow-left me-2"></i>Quay lại
                    </a>
                    
                        <a href="{{ route('cart.index') }}" class="btn btn-primary btn-lg">Sử dụng Voucher</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .voucher-card {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .voucher-content {
        position: relative;
        z-index: 1;
    }
    .voucher-code {
        background-color: rgba(255, 255, 255, 0.9);
        border: 2px dashed #007bff;
        border-radius: 10px;
        padding: 15px;
    }
    .voucher-details {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .btn {
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    @media (max-width: 767.98px) {
        .voucher-card {
            border-radius: 10px;
        }
        .voucher-content {
            padding: 3rem !important;
        }
    }
</style>
@endsection
