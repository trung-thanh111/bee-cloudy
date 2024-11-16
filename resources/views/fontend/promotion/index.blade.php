@extends('fontend.home.layout')
@section('page_title')
    Khuyến mãi
@endsection
@section('content')
    <!-- <div class="container py-5"> -->
    @if (count($promotions) > 0)
        <div class="parallax"
            style="background-image: url('https://images.unsplash.com/photo-1607082349566-187342175e2f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');">
            <div class="container py-5">
                <h1 class="text-center text-white mb-5">Khuyến mãi cửa hàng</h1>

                @php
                    $voucherTypes = [
                        'all' => ['title' => 'Khuyến mãi chung', 'icon' => 'gift', 'color' => 'bg-primary'],
                        'specific_products' => ['title' => 'Khuyến mãi sản phẩm', 'icon' => 'tag', 'color' => 'bg-info'],
                        'freeship' => ['title' => 'Miễn phí vận chuyển', 'icon' => 'truck', 'color' => 'bg-success'],
                    ];
                @endphp

                @foreach ($voucherTypes as $type => $typeInfo)
                    <div class="mb-5">
                        <h2 class="text-start text-white mb-4">
                            <i class="fas fa-{{ $typeInfo['icon'] }} me-2"></i>
                            {{ $typeInfo['title'] }}
                        </h2>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            @foreach ($promotions as $promotion)
                                @if ($promotion->apply_for == $type)
                                    <div class="col">
                                        <div class="card h-100 shadow-sm border-0 promotion-card">
                                            <div class="voucher-item mb-3">
                                                <ul class="ps-0 mb-0">
                                                    <div class="image-voucher-item me-2">
                                                        <img src="{{ $promotion->image != null ? $promotion->image : '/libaries/upload/images/img-notfound.png' }}"
                                                            alt="" width="100%" height=""
                                                            class="img-fluid rounded me-2">
                                                    </div>
                                                    <li class="list-unstyled d-flex justify-content-start text-muted mb-2">
                                                        <div class="title-date-voucher w-100">
                                                            <div class="col">
                                                                <h6 class="fz-16 pb-2 mt-2 text-primary">
                                                                    {{ $promotion->name }}
                                                                </h6>
                                                            </div>
                                                            <div
                                                                class="col d-flex justify-content-between align-items-center  gap-5">
                                                                <p class="fz-12 mb-0">Hạn sử dụng:
                                                                    <strong>{{ $promotion->end_date->format('d/m/Y') }}</strong>
                                                                </p>
                                                                @php
                                                                    $user = Auth::user();
                                                                    $existingVoucher = \App\Models\UserVoucher::where(
                                                                        'user_id',
                                                                        $user->id,
                                                                    )
                                                                        ->where('promotion_id', $promotion->id)
                                                                        ->first();
                                                                @endphp
                                                                <form
                                                                    action="{{ route('promotion.receive', $promotion->id) }}"
                                                                    method="POST"
                                                                    {{ $existingVoucher ? 'style=pointer-events:none;opacity:0.6;' : '' }}>
                                                                    @csrf
                                                                    @if ($existingVoucher)
                                                                        <button type="button"
                                                                            class="btn rounded-2 btn-secondary fz-12 fw-medium text-white text-end"
                                                                            disabled>Đã nhận</button>
                                                                    @else
                                                                        <button type="submit"
                                                                            class="btn rounded-2 btn-info fz-12 fw-medium text-white text-end">Nhận</button>
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
    @else
        <div class="order-null p-3">
            <div class="img-null text-center">
                <img src="/libaries/upload/images/order-null.png" alt="" class="" width="300"
                    height="200">
            </div>
            <div class="flex flex-col text-center align-items-center">
                <h5 class="mb-2  fw-semibold">Tạm thời không có khuyến mãi trên webiste.
                </h5>
                <p class="text-center mb-2">
                    Hãy khám phá những những gì có trong website nhé!
                </p>
                <a href="{{ route('shop.index') }}" class="btn btn-info text-white rounded-pill mt-3">Quay lại sau </a>
            </div>
        </div>
    @endif
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
    <style>
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
            background-image: url("/libaries/templates/bee-cloudy-user/libaries/images/backgroundPromotion.avif") !important;
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
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
        }

        .countdown {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }
    </style>
@endpush
