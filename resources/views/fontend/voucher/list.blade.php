@extends('fontend.home.layout')
@section('page_title')
    Voucher
@endsection
@section('content')
    <div class="container">
        <h1>Danh sách Voucher khả dụng</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
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
                @foreach ($promotions as $promotion)
                    @if ($promotion->usage_limit > 0)
                        <tr>
                            <td>{{ $promotion->name }}</td>
                            <td>{{ $promotion->code }}</td>
                            <td>{{ $promotion->start_date }}</td>
                            <td>{{ $promotion->end_date }}</td>
                            <td>{{ $promotion->discount_value }}</td>
                            <td class="usage-limit">{{ $promotion->usage_limit }}</td>
                            <td>
                                <form action="{{ route('promotion.receive', $promotion->id) }}" method="POST"
                                    class="promotion-form">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Nhận Promotion</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
