@extends('fontend.home.layout')
@section('page_title')
Voucher
@endsection
@section('content')
<!-- <div class="container py-5"> -->
<div class="parallax" style="background-image: url('https://images.unsplash.com/photo-1607082349566-187342175e2f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');">
        <div class="container py-5">
            <h1 class="text-center text-white mb-5">Siêu Khuyến Mãi</h1>

            @php
            $voucherTypes = [
                'all' => ['title' => 'Vouchers Chung', 'icon' => 'gift', 'color' => 'bg-primary'],
                'specific_products' => ['title' => 'Vouchers Sản Phẩm', 'icon' => 'tag', 'color' => 'bg-info'],
                'freeship' => ['title' => 'Vouchers Freeship', 'icon' => 'truck', 'color' => 'bg-success']
            ];
            @endphp

            @foreach($voucherTypes as $type => $typeInfo)
                <div class="mb-5">
                    <h2 class="text-center text-white mb-4">
                        <i class="fas fa-{{ $typeInfo['icon'] }} me-2"></i>
                        {{ $typeInfo['title'] }}
                    </h2>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($promotions as $promotion)
                @if($promotion->apply_for == $type)
<div class="col">
                        <div class="card h-100 shadow-sm border-0 promotion-card">
                           
                            <div class="voucher-item mb-3">
                                    <ul class="ps-0 mb-0">
                                        <li class="list-unstyled d-flex justify-content-start text-muted mb-2">
                                            <div class="image-voucher-item me-2">
                                                <img src="{{ asset('public/' . $promotion->image) }}"
                                                    alt="" width="80" class="img-fluid rounded me-2">
                                            </div>
                                            <div class="title-date-voucher">
                                                <div class="col">
                                                    <h6 class="fz-16 pb-2 mt-2 text-primary">{{ $promotion->name }}</h6>
                                                </div>
                                                <div class="col d-flex justify-content-between align-items-center gap-3">
                                                    <p class="fz-12 mb-0">Hạn sử dụng: <strong>{{ $promotion->end_date->format('d/m/Y') }}</strong></p>
                                                    @php
                                                        $user = Auth::user();
                                                        $existingVoucher = \App\Models\UserVoucher::where('user_id', $user->id)
                                                                            ->where('promotion_id', $promotion->id)
                                                                            ->first();
                                                    @endphp
                                                    <form action="{{ route('promotion.receive', $promotion->id) }}" method="POST" {{ $existingVoucher ? 'style=pointer-events:none;opacity:0.6;' : '' }}>
                                                        @csrf
                                                        @if ($existingVoucher)
                                                            <button type="button" class="btn rounded-2 btn-secondary fz-12 fw-medium text-white" disabled>Đã nhận</button>
                                                        @else
                                                            <button type="submit" class="btn rounded-2 btn-info fz-12 fw-medium text-white">Sử dụng</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </div>


                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="voucherModalLabel">Sử dụng Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn đã chọn voucher với mã: <strong id="modalVoucherCode"></strong></p>
                    <p>Vui lòng sử dụng mã này khi thanh toán để nhận ưu đãi.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(45deg, #ff9a9e 0%, #fad0c4 99%, #fad0c4 100%);
        }
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
        }
        .promotion-card {
            transition: all 0.3s ease;
        }
        .promotion-card:hover {
            transform: translateY(-10px);
        }
        .use-btn {
            transition: all 0.3s ease;
        }
        .use-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255,255,255,0.5);
        }
        .countdown {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(5px);
        }
    </style>
@endpush
