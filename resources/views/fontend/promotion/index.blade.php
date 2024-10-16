@extends('fontend.home.layout')
@section('page_title')
Voucher
@endsection
@section('content')
<div class="container">
    <h1>Danh sách Voucher khả dụng</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên Voucher</th>
                <th>Mã</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Giá trị chiết khấu</th>
                <th>Số lượng còn lại</th>
                <th>Nhận Voucher</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->name }}</td>
                    <td>{{ $promotion->code }}</td>
                    <td>{{ $promotion->start_date }}</td>
                    <td>{{ $promotion->end_date }}</td>
                    <td>{{ $promotion->discount_value }}</td>
                    <td class="usage-limit">{{ $promotion->usage_limit }}</td>
                    <td>
                        @if($promotion->usage_limit <= 0)
                            <button class="btn btn-danger" disabled>Hết sản phẩm</button>
                        @elseif($user->userVouchers->contains('promotion_id', $promotion->id))
                            <button class="btn btn-primary" disabled>Đã nhận</button>
                        @else
                            <form action="{{ route('promotion.receive', $promotion->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Nhận khuyến mãi</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection