@extends('fontend.home.layout')
@section('page_title')
Chính sách
@endsection
@section('content')
<section>
    <div class="container contact p-0">
        <!-- breadcrumb  -->
        <nav class="pt-3 pb-3" aria-label="breadcrumb">
            <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                <li class="breadcrumb-item "><a href="{{ route('home.index') }}" class="text-decoration-none text-muted">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Chính sách đổi trả và bảo hành</li>
            </ol>
        </nav>
        <!-- end breadcrumb  -->
        <div class="card" >
            <div class="card-body m-2">
                <h2 class="pb-4 text-center underline-text">Chính sách đổi trả bảo hành sản phẩm</h2>

                <!-- San pham -->

                <h4 class="pb-2 pt-4" style="color: #626262;">Nội dung chính sách đổi trả, bảo hành</h4>
                <strong>
                    Chính sách đổi trả trong 15 ngày tại nhà:
                </strong>
                <p>
                    Đổi mới sản phẩm trong 15 ngày.<br>
                    Hoàn 100% giá trị sản phẩm.
                </p>
                <strong>
                    Chính sách bảo hành 6 tháng sản phẩm:
                </strong>
                <p>
                    Sản phẩm được bảo hành trong 6 tháng.
                </p>

                <!-- Điều kiện -->

                <h4 class="pb-2" style="color: #626262;">Điều kiện đổi trả, bảo hành</h4>
                <strong>
                    Điều kiện để được đổi trả, bảo hành
                </strong>
                <p>
                    Sản phẩm chưa qua sử dụng, còn nguyên 100% tình trạng ban đầu: còn nguyên nhãn mác, chưa giặt, chưa sửa chữa, không có mùi lạ trên sản phẩm...<br>
                    Đổi trả miễn phí đối với các lỗi về sản phẩm. <br>
                    Đổi khác mã sản phẩm: tính theo giá trị tại thời điểm mua hàng. <br>
                    Hoàn trả toàn bộ hàng khuyến mãi (nếu có). Nếu mất hàng khuyến mãi sẽ thu phí theo mức giá đã được công bố. <br>
                    Sản phẩm do lỗi sản xuất: mọi chi phí vận chuyển do shop chi trả. <br>
                    Sản phẩm bị lỗi: lỗi khóa, xù lông...
                </p>
            </div>
        </div>
</section>
@endsection