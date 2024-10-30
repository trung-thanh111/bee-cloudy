@extends('fontend.home.layout')
@section('page_title')
    Đánh Giá Sản Phẩm
@endsection
@section('content')
    <div class="container" id="app">
        <div class="container-acount">
            <div class="parent">
                <span style=" font-size: 30px ;">Thông tin đơn hàng </span>
                <p class="text-people">Xin chào,
                    <a style="color: #ca670f;" href="">Vy Phan!</a>
                </p>
                <div class="recent-oder">
                    <table class="table-ord table-bordered">
                        <thead class="table-cart">
                            <tr>
                                <td>Mã đơn hàng</td>
                                <td>Ngày đặt</td>
                                <td>Trạng thái thanh toán</td>
                                <td>Trạng thái giao hàng </td>
                                <td>Đánh giá sản phẩm </td>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td colspan="5">Không có đơn hàng nào </td>
                            </tr> --}}
                            <tr>
                                <td>MDH2383 </td>
                                <td>22/22/2222 </td>
                                <td>
                                    <a> Đã thanh toán</a>
                                </td>
                                <td>
                                    <a>Đang chuẩn bị hàng</a>
                                </td>
                                <td>
                                    <a href="/producreview" class="danh_gia">Đánh giá </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
