@extends('fontend.home.layout')
@section('page_title')
Voucher
@endsection
@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Khuyến Mãi Đặc Biệt</h1>

    @php
    $voucherTypes = [
        'all' => ['title' => 'Vouchers Chung', 'icon' => 'gift'],
        'specific_products' => ['title' => 'Vouchers Sản Phẩm Cụ Thể', 'icon' => 'tag'],
        'freeship' => ['title' => 'Vouchers Miễn Phí Vận Chuyển', 'icon' => 'truck']
    ];
    @endphp

    @foreach($voucherTypes as $type => $typeInfo)
        <h2 class="mb-4">{{ $typeInfo['title'] }}</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
            @foreach($promotions as $promotion)
                @if($promotion->apply_for == $type)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 promotion-card">
                            <div class="card-header bg-primary bg-opacity-10 d-flex align-items-center">
                                <i class="fas fa-{{ $typeInfo['icon'] }} fa-2x text-primary me-3"></i>
                                <h5 class="card-title mb-0">{{ $promotion->name }}</h5>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    @if($promotion->usage_limit > 0)
                                        <span class="badge bg-primary">Còn {{ $promotion->usage_limit }} lượt</span>
                                    @else
                                        <span class="badge bg-danger">Đã hết voucher</span>
                                    @endif
                                </div>
                                <p class="card-text flex-grow-1">
                                    @if($promotion->discount_type == 'percentage')
                                        Giảm {{ $promotion->discount_value }}% 
                                    @else
                                        Giảm {{ number_format($promotion->discount_value) }}đ
                                    @endif
                                    cho đơn hàng từ {{ number_format($promotion->minimum_amount) }}đ
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">Hết hạn: {{ $promotion->end_date->format('d/m/Y') }}</small>
                                    <form action="{{ route('promotion.receive', $promotion->id) }}" method="POST">
                                        @csrf
                                        @if($promotion->usage_limit > 0)
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Nhận voucher</button>
                                        @else
                                            <button type="button" class="btn btn-outline-secondary btn-sm" disabled>Đã hết voucher</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .promotion-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .promotion-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .btn-outline-primary:hover,
    .btn-outline-success:hover,
    .btn-outline-info:hover {
        transform: scale(1.05);
    }
    .card-header {
        background-size: cover;
        background-position: center;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // You can add any JavaScript functionality here if needed
});
</script>
@endpush