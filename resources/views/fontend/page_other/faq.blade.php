@extends('fontend.home.layout')
@section('page_title')
Câu hỏi thường gặp
@endsection
@section('content')
<section >
    <div class="container contact p-0">
        <!-- breadcrumb  -->
        <nav class="pt-3 pb-3" aria-label="breadcrumb">
            <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                <li class="breadcrumb-item "><a href="{{ route('home.index') }}" class="text-decoration-none text-muted">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Câu hỏi thường gặp</li>
            </ol>
        </nav>
        <!-- end breadcrumb  -->
        <div class="card">
            <div class="card-body m-2">
                <h2 class="pb-4 text-center underline-text">Các Câu Hỏi Thường Gặp</h2>

                <!-- San pham -->

                <h4 class="pb-2 pt-4" style="color: #626262;">Sản phẩm</h4>
                <strong>
                    Giày của chúng tôi được sản xuất ở đâu?
                </strong>
                <p>
                    Giày của chúng tôi được sản xuất tại các nhà máy chất lượng cao trên toàn thế giới,
                    đảm bảo tiêu chuẩn chất lượng và tuân thủ các quy định quốc tế về lao động.
                </p>
                <strong>
                    Giày có kích cỡ chuẩn không?
                </strong>
                <p>
                    Giày của chúng tôi tuân theo kích cỡ chuẩn quốc tế.
                    Tuy nhiên, bạn nên tham khảo bảng kích cỡ để chọn lựa phù hợp nhất với chân của mình.
                </p>

                <!-- Khuyen mai -->

                <h4 class="pb-2" style="color: #626262;">Giảm giá & Khuyến mãi</h4>
                <strong>
                    Làm thế nào để nhận thông báo về các chương trình khuyến mãi?
                </strong>
                <p>
                    Bạn có thể đăng ký
                    nhận bản tin của chúng tôi để nhận thông tin về các
                    chương trình khuyến mãi và ưu đãi đặc biệt.
                </p>
                <strong>
                    Có chương trình giảm giá cho lần mua hàng đầu tiên không?
                </strong>
                <p>
                    Chúng tôi thường có các chương trình ưu đãi cho khách hàng mới.
                    Hãy kiểm tra trang khuyến mãi để biết thêm chi tiết.
                </p>
                <strong>
                    Khuyến mãi có áp dụng cho tất cả các sản phẩm không?
                </strong>
                <p>
                    Các chương trình khuyến mãi thường có điều kiện áp dụng riêng.
                    Một số sản phẩm đặc biệt có thể không nằm trong chương trình giảm giá.
                </p>

                <!-- Dat hang -->
                <h4 class="pb-2" style="color: #626262;">Đặt hàng</h4>
                <strong>
                    Có thể hủy hoặc thay đổi đơn hàng sau khi đặt không?
                </strong>
                <p>
                    Bạn có thể hủy hoặc thay đổi đơn hàng nếu nó chưa được xử lý.
                    Vui lòng liên hệ với dịch vụ khách hàng càng sớm càng tốt.
                </p>
                <strong>
                    Tôi có thể theo dõi tình trạng đơn hàng của mình không?
                </strong>
                <p>
                    Bạn có thể theo dõi tình trạng đơn
                    hàng thông qua tài khoản của mình trên trang web
                    hoặc thông qua email xác nhận đơn hàng.
                </p>
                <strong>
                    Phương thức thanh toán nào được chấp nhận?
                </strong>
                <p>
                    Chúng tôi chấp nhận các phương thức thanh
                    toán phổ biến như thẻ tín dụng, chuyển khoản ngân hàng và ví điện tử.
                </p>
            </div>
        </div>
</section>
@endsection