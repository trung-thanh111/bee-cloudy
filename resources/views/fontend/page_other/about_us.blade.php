@extends('fontend.home.layout')
@section('page_title')
Giới thiệu
@endsection
@section('content')
<section>
    <div class="container contact p-0">
        <!-- breadcrumb  -->
        <nav class="pt-3 pb-3" aria-label="breadcrumb">
            <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                <li class="breadcrumb-item "><a href="{{ route('home.index') }}" class="text-decoration-none text-muted">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Về chúng tôi</li>
            </ol>
        </nav>
        <!-- end breadcrumb  -->

        <div class="container">
            <div class="card">
                <img class="img-about shadow col-10 mx-auto mt-3" src="/libaries/templates/bee-cloudy-user/libaries/images/pexels-brandandpalms-768975.jpg" alt="">
                <div class="card-content text-center">
                    <h4 class="p-2 p-3">Giới Thiệu</h4>

                    <p class="p-2 pb-5 px-5 w-75 text-center w-100" style="text-align: center;">
                        Chào mừng bạn đến với BeeCloudy, nơi thời trang không chỉ đơn
                        thuần là quần áo, mà còn là sự thể hiện bản thân và phong cách
                        sống. Tại BeeCloudy, chúng tôi tin rằng mỗi người đều có một câu
                        chuyện riêng và trang phục mà bạn chọn là một phần quan trọng trong
                        việc kể câu chuyện đó. Chúng tôi cam kết cung cấp những sản phẩm thời
                        trang tinh tế, sáng tạo, và hiện đại, giúp bạn tỏa sáng trong bất kỳ hoàn
                        cảnh nào.
                    </p>

                    <div class="row p-3">
                        <div class="col-12 col-lg-6 col-md-6 d-flex justify-content-center align-items-center ">
                            <p class="text-start ">
                                <strong>Sứ mệnh của chúng tôi</strong> là mang đến cho bạn trải nghiệm mua sắm trực
                                tuyến tuyệt vời nhất.
                                Với các bộ sưu tập phong phú, từ những trang phục công sở thanh lịch cho đến
                                những bộ đồ dạo phố năng động, chúng tôi luôn cập nhật xu hướng mới nhất để đáp
                                ứng nhu cầu của mọi khách hàng. Đội ngũ thiết kế của chúng tôi làm việc không ngừng
                                nghỉ để tạo ra những sản phẩm không chỉ đẹp mắt mà còn thoải mái và dễ dàng phối đồ.
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6">
                            <img class="rounded-2" src="/libaries/templates/bee-cloudy-user/libaries/images/pexels-godisable-jacob-226636-1154861.jpg"
                                style="max-width: 100%" alt="">
                        </div>
                    </div>


                    <div class="row p-3 ">
                        <div class="col-12 col-lg-6 col-md-6 d-flex justify-content-center align-items-center ">
                            <img class="rounded-2" src="/libaries/templates/bee-cloudy-user/libaries/images/pexels-solliefoto-298863.jpg"
                                style="max-width: 100%" alt="">

                        </div>
                        <div class="col-12 col-lg-6 col-md-6">
                            <p class="text-start">
                                <strong>TẠI SAO BẠN NÊN CHỌN BEE Cloudy?</strong>
                                <br>
                                <br>
                                - <strong>Chất lượng hàng đầu:</strong> Chúng tôi hiểu rằng chất lượng sản phẩm là
                                yếu tố quyết định.
                                Mỗi sản phẩm đều được làm từ chất liệu tốt nhất, đảm bảo sự bền bỉ và thoải mái khi
                                mặc.
                                <br>
                                <br>
                                - <strong>Thiết kế độc quyền:</strong> Chúng tôi tự hào mang đến những thiết kế độc
                                quyền, không chỉ
                                theo kịp xu hướng mà còn mang đến sự khác biệt, giúp bạn tự tin hơn khi thể hiện cá
                                tính của mình.
                                <br>
                                <br>
                                - <strong>Mẫu mã đa dạng:</strong> Với nhiều lựa chọn từ phong cách cổ điển đến hiện
                                đại, từ trang phục
                                dạo phố đến trang phục dự tiệc, chúng tôi có mọi thứ bạn cần để làm mới tủ quần áo
                                của mình.
                                <br>
                                <br>
                                - <strong>Giá cả hợp lý:</strong> Chúng tôi cam kết cung cấp sản phẩm chất lượng cao
                                với mức giá hợp
                                lý, giúp bạn dễ dàng chọn lựa mà không phải lo lắng về ngân sách.
                                <br>
                                <br>
                                - <strong>Dịch vụ khách hàng tận tâm:</strong> Đội ngũ chăm sóc khách hàng của chúng
                                tôi luôn sẵn sàng
                                hỗ trợ bạn với mọi câu hỏi và yêu cầu, đảm bảo rằng trải nghiệm mua sắm của bạn là
                                tốt nhất có thể.
                            </p>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col-12">
                            <p class="text-start">
                                <strong>BeeCloudy</strong> không chỉ là một cửa hàng trực tuyến, mà còn là một cộng đồng dành cho những
                                người yêu thích thời trang. Chúng tôi thường xuyên cập nhật các bài viết blog, chia sẻ
                                mẹo phối đồ và xu hướng thời trang mới nhất để giúp bạn trở thành phiên bản tốt nhất của
                                chính mình.
                                <br>
                                <br>
                                Hãy gia nhập cộng đồng BeeCloudy và cùng chúng tôi khám phá thế giới thời trang đa sắc
                                màu. Chúng tôi rất hân hạnh được đồng hành cùng bạn trên hành trình tìm kiếm phong cách
                                riêng của mình!
                            </p>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col-12 col-lg-8 col-md-8 mx-auto">
                            <img class="rounded-2" src="/libaries/templates/bee-cloudy-user/libaries/images/pexels-nietjuh-934070.jpg" alt="" style="max-width: 100%;">
                        </div>
                    </div>


                </div>

            </div>


        </div>

</section>
@endsection