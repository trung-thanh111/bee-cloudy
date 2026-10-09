@extends('fontend.home.layout')
@section('page_title')
Điều khoản
@endsection
@section('content')
<section>
    <div class="container contact p-0" >
        <!-- breadcrumb  -->
        <nav class="pt-3 pb-3" aria-label="breadcrumb">
            <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                <li class="breadcrumb-item "><a href="{{ route('home.index') }}" class="text-decoration-none text-muted">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Điều khoản và điều kiện</li>
            </ol>
        </nav>
        <!-- end breadcrumb  -->
        <div class="card">
            <div class="card-body m-2">
                <h2 class="pb-4 text-center underline-text">Điều Khoản Và Điều Kiện</h2>
                <br>
                <strong class="text-center pt-5">
                    Chào mừng bạn đến với BeeCloudy Khi truy cập và sử dụng trang web này,
                    bạn đồng ý tuân theo các điều khoản và điều kiện sau đây. Vui lòng đọc kỹ để hiểu rõ quyền
                    và nghĩa vụ của mình.
                </strong>

                <h5 class="pt-4">1. Giới thiệu và phạm vi</h5>
                <p>
                    Trang web BeeCloudy cung cấp các sản phẩm giày dép và phụ kiện thời trang.
                    Các điều khoản và điều kiện này áp dụng cho mọi khách hàng sử dụng trang web và dịch vụ của chúng tôi.
                </p>

                <h5 class="">2. Điều khoản sử dụng</h5>
                <p>
                    • Người dùng cam kết cung cấp thông tin cá nhân chính xác và đầy đủ khi đăng ký tài khoản. <br>
                    • Người dùng không được phép thực hiện các hành vi gian lận, hack, hoặc sử dụng thông tin của người khác. <br>
                    • Bất kỳ hành vi vi phạm nào sẽ dẫn đến việc hủy bỏ tài khoản và các biện pháp pháp lý liên quan.

                </p>

                <h5 class="pb-2">3. Chính sách mua hàng</h5>
                <p>
                    <strong>Đặt hàng:</strong> Khách hàng có thể đặt hàng trực tuyến qua trang web.
                    Sau khi hoàn tất đặt hàng, bạn sẽ nhận được email xác nhận đơn hàng. <br>
                </p>
                <p>
                    <strong>Giá cả và thanh toán:</strong> <br>
                </p>
                <p>
                    • Tất cả giá sản phẩm được niêm yết bằng VND và đã bao gồm thuế (nếu có). <br>
                    • Chúng tôi chấp nhận thanh toán qua Momo, thanh toán khi nhận hàng. <br>
                </p>
                <p>
                    <strong>Chính sách đổi trả và hoàn tiền:</strong> <br>
                </p>
                <p>
                    • Khách hàng có quyền đổi trả sản phẩm trong vòng 5 ngày kể từ ngày nhận hàng,
                    với điều kiện sản phẩm còn nguyên vẹn, chưa qua sử dụng và còn tem mác. <br>
                    • Để đổi trả, vui lòng liên hệ bộ phận
                    chăm sóc khách hàng của chúng tôi qua <a href="mailto:beecloudy2024@gmail.com?subject=Hỗ trợ khách hàng đổi trả&body=Chào đội ngũ hỗ trợ, tôi cần giúp đỡ về...">beecloudy2024@gmail.com</a> hoặc <a href="tel:+84379000358">0379000358</a> <br>
                </p>
                <p>
                    <strong>Vận chuyển và giao nhận:</strong> <br>
                </p>
                <p>
                    • Thời gian giao hàng dự kiến là 7 ngày làm việc, tùy thuộc vào địa chỉ nhận hàng. <br>
                    • Phí vận chuyển sẽ được tính tùy vào khu vực giao hàng và tổng giá trị đơn hàng. <br>
                </p>

                <h5 class="">4. Quyền và nghĩa vụ của người dùng</h5>
                <p>
                    • Khách hàng có quyền nhận thông tin chính xác về sản phẩm và dịch vụ. <br>
                    • Khách hàng có trách nhiệm thanh toán đầy đủ và đúng hạn cho đơn hàng của mình. <br>
                </p>

                <h5 class="">5. Quyền và nghĩa vụ của cửa hàng</h5>
                <p>
                    • BeeCloudy cam kết cung cấp sản phẩm chính hãng, đúng
                    mô tả và đảm bảo chất lượng. <br>
                    • Chúng tôi sẽ bảo mật thông tin cá nhân của khách hàng và
                    không chia sẻ cho bên thứ ba mà không có sự đồng ý của bạn. <br>
                </p>
                <h5 class="">6. Chính sách bảo mật</h5>
                <p>
                    Chúng tôi thu thập thông tin cá nhân của khách hàng để xử lý đơn hàng và cung cấp dịch
                    vụ tốt nhất. Mọi thông tin được bảo mật và chỉ sử dụng cho các mục đích được thông báo.
                </p>
                <h5 class="">7. Điều khoản về sở hữu trí tuệ</h5>
                <p>
                    Mọi nội dung, hình ảnh, và thương hiệu trên trang web này thuộc sở hữu của BeeCloudy và
                    được bảo vệ bởi luật sở hữu trí tuệ. Nghiêm cấm sao chép, sử dụng mà không có sự đồng ý
                    bằng văn bản từ chúng tôi.
                </p>
                <h5 class="">8. Miễn trừ trách nhiệm</h5>
                <p>
                    • BeeCloudy không chịu trách nhiệm về sự cố kỹ thuật, lỗi phần mềm,
                    hoặc các vấn đề ngoài tầm kiểm soát ảnh hưởng đến việc truy cập và sử dụng trang web. <br>
                    • Chúng tôi không chịu trách nhiệm cho bất kỳ thiệt hại gián tiếp
                    nào liên quan đến việc sử dụng sản phẩm. <br>
                </p>
                <h5 class="">9. Thay đổi điều khoản</h5>
                <p>
                    Chúng tôi có quyền thay đổi các điều khoản và điều kiện này bất kỳ lúc nào.
                    Các thay đổi sẽ được cập nhật trên trang web,
                    và việc tiếp tục sử dụng trang web của bạn đồng nghĩa với việc chấp nhận các thay đổi đó.
                </p>
                <h5 class="">10. Luật áp dụng và giải quyết tranh chấp</h5>
                <p>
                    Mọi tranh chấp phát sinh từ việc sử dụng trang web và dịch vụ của BeeCloudy sẽ được
                    giải quyết theo pháp luật của Việt Nam.
                    Các bên sẽ nỗ lực giải quyết tranh chấp thông qua thương lượng trước khi đưa ra các cơ quan
                    tài phán có thẩm quyền.
                </p>
            </div>
        </div>
</section>
@endsection