@extends('fontend.home.layout')
@section('page_title')
Bảo mật
@endsection
@section('content')
<section>
    <div class="container contact p-0">
        <!-- breadcrumb  -->
        <nav class="pt-3 pb-3" aria-label="breadcrumb">
            <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                <li class="breadcrumb-item "><a href="{{ route('home.index') }}" class="text-decoration-none text-muted">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Trung tâm bảo mật</li>
            </ol>
        </nav>
        <!-- end breadcrumb  -->
        <div class="card">
            <div class="card-body m-2">
                <h2 class="pb-4 text-center underline-text">Chính sách bảo mật thông tin cá nhân</h2>
                <br>
                <strong class="text-center pt-5">
                    Chào mừng bạn đến với BeeCloudy Khi truy cập và sử dụng trang web này,
                    bạn đồng ý tuân theo các điều khoản và điều kiện sau đây. Vui lòng đọc kỹ để hiểu rõ quyền
                    và nghĩa vụ của mình.
                </strong>

                <h5 class="pt-4">1. Mục đích thu thập</h5>
                <p>BeeCloudy thu thập thông tin cá nhân chỉ cần thiết nhằm phục vụ cho các mục đích:</p>
                <p class="mb-0">
                    <span class="fw-bold">• Đơn Hàng</span>: để xử lý các vấn đề liên quan đến đơn đặt hàng của bạn; <br>
                    <span class="fw-bold">• Duy Trì Tài Khoản</span>: để tạo và duy trình tài khoản của bạn với chúng tôi, bao gồm cả các chương trình khách hàng thân thiết hoặc các chương trình thưởng đi kèm với tài khoản của bạn; <br>
                    <span class="fw-bold">• Dịch Vụ Chăm Sóc Khách Hàng</span>: bao gồm các phản hồi cho các yêu cầu, khiếu nại và phản hồi của bạn; <br>
                    <span class="fw-bold">• Cá Nhân Hóa</span>: Chúng tôi có thể tổ hợp dữ liệu được thu thập để có một cái nhìn hoàn chỉnh hơn về một người tiêu dùng và từ đó cho phép chúng tôi phục vụ tốt hơn với sự cá nhân hóa mạnh hơn ở các khía cạnh, bao gồm nhưng không giới hạn:
                <p class="p-0 mb-0 ms-3">• Để cải thiện và cá nhân hóa trải nghiệm của bạn trên trang mua sắm thương mại điện tử BeeCloudy
                    <br> • Để cải thiện các tiện ích, dịch vụ, điều chỉnh chúng phù hợp với các nhu cầu được cá thể hóa và đi đến những ý tưởng dịch vụ mới
                    <br> • Để phục vụ bạn với những giới thiệu, quảng cáo được điều chỉnh phù hợp với sự quan tâm của bạn.
                </p>
                <span class="fw-bold">• An Ninh</span>: cho các mục đích ngăn ngừa các hoạt động phá hủy tài khoản người dùng của khách hàng hoặc các hoạt động giả mạo khách hàng.
                <br><span class="fw-bold">• Theo yêu cầu của pháp luật</span>: tùy quy định của pháp luật vào từng thời điểm, chúng tôi có thể thu thập, lưu trữ và cung cấp theo yêu cầu của cơ quan nhà nước có thẩm quyền.
                </p>

                <h5 class="">2. Phạm vi thu thập</h5>
                <p>BeeCloudy thu thập thông tin khách hàng khi:</p>
                <p>
                    <span class="fw-bold">• Khách hàng giao dịch trực tiếp với chúng tôi</span>
                <p class="ms-3"> Thông tin cá nhân của các bạn cung cấp chủ yếu trên trang mua sắm điện tử của chúng tôi BeeCloudy. Thông tin bao gồm: Họ tên, ngày sinh, địa chỉ, số điện thoại, email, tên đăng nhập và mật khẩu (Tài khoản đăng nhập), câu hỏi/ câu trả lời bảo mật, chi tiết thanh toán, chi tiết thanh toán bằng thẻ hoặc chi tiết tài khoản ngân hàng.
                    <br>
                    Chi tiết đơn đặt hàng của bạn được chúng tôi lưu giữ nhưng vì lý do bảo mật nên chúng tôi không công khai trực tiếp được. Tuy nhiên, bạn có thể tiếp cận thông tin bằng cách đăng nhập tài khoản trên trang web. Tại đây, bạn sẽ thấy chi tiết đơn đặt hàng của mình, những sản phẩm đã nhận và những sản phẩm đã gửi và chi tiết email, ngân hàng và bản tin mà bạn đặt theo dõi dài hạn.
                </p>

                <p><span class="fw-bold">• Khách hàng tương tác với chúng tôi</span></p>
                <p class="ms-3"> Chúng tôi sử dụng cookies và công nghệ dấu khác để thu thập một số thông tin khi bạn tương tác với trang mua sắm.
                    <br>
                    Chúng tôi dùng cookie để tiện cho bạn vào trang web (ví dụ: ghi nhớ tên truy cập khi bạn muốn vào thay đổi lại giỏ mua hàng mà không cần phải nhập lại địa chỉ email của mình) và không đòi hỏi bất kỳ thông tin nào về bạn (ví dụ: mục tiêu quảng cáo).Trình duyệt của bạn có thể được thiết lập không sử dụng cookie nhưng điều này sẽ hạn chế quyền sử dụng của bạn trên trang web. Xin vui lòng chấp nhận cam kết của chúng tôi là cookie không bao gồm bất cứ chi tiết cá nhân riêng tư nào và an toàn với virus.
                </p>

                <span class="fw-bold">• Các nguồn hợp pháp khác</span>
                </p>

                <h5 class="pb-2">3. Thời gian lưu trữ</h5>
                <p>
                    • Thông tin khách hàng được lưu trữ cho đến khi nhận được yêu cầu huỷ bỏ của khách hàng, hoặc khách hàng tự đăng nhập để huỷ bỏ. <br>
                    • Mọi thông tin của khách hàng đều được lưu trữ trên máy chủ của BeeCloudy <br>
                </p>
                <h5 class="">4. Thông tin Khách hàng đối với bên thứ ba</h5>
                <p>BeeCloudy cam kết không cung cấp thông tin khách hàng với bất kì bên thứ ba nào, trừ những trường hợp sau:</p>
                <p>
                    • Các đối tác là bên cung cấp dịch vụ cho chúng tôi liên quan đến thực hiện đơn hàng và chỉ giới hạn trong phạm vi thông tin cần thiết cũng như áp dụng các quy định đảm bảo an ninh, bảo mật các thông tin cá nhân. <br>
                    • Chúng tôi có thể sử dụng dịch vụ từ một nhà cung cấp dịch vụ là bên thứ ba để thực hiện một số hoạt động liên quan đến trang mua sắm điện tử BeeCloudy và khi đó bên thứ ba này có thể truy cập hoặc xử lý các thông tin cá nhân trong quá trình cung cấp các dịch vụ đó. Chúng tôi yêu cầu các bên thứ ba này tuân thủ mọi luật lệ về bảo vệ thông tin cá nhân liên quan và các yêu cầu về an ninh liên quan đến thông tin cá nhân.
                    <br> • Các chương trình có tính liên kết, đồng thực hiện, thuê ngoài cho các mục đích được nêu tại Mục 1 và luôn áp dụng các yêu cầu bảo mật thông tin cá nhân.
                    <br> • Yêu cầu pháp lý: Chúng tôi có thể tiết lộ các thông tin cá nhân nếu điều đó do luật pháp yêu cầu và việc tiết lộ như vậy là cần thiết một cách hợp lý để tuân thủ các quy trình pháp lý.
                    <br> • Chuyển giao kinh doanh (nếu có): trong trường hợp sáp nhập, hợp nhất toàn bộ hoặc một phần với công ty khác, người mua sẽ có quyền truy cập thông tin được chúng tôi lưu trữ, duy trì trong đó bao gồm cả thông tin cá nhân.
                </p>

                <h5 class="">5. Cách thức bảo mật thông tin khách hàng</h5>
                <p>
                    BeeCloudy luôn nỗ lực để giữ an toàn thông tin cá nhân của khách hàng, chúng tôi đã và đang thực hiện nhiều biện pháp an toàn, bao gồm:
                </p>

                <p>
                    <span class="fw-bold">• Bảo đảm an toàn trong môi trường vận hành: </span>
                    chúng tôi lưu trữ thông tin cá nhân khách hàng trong môi trường vận hành an toàn và chỉ có nhân viên, đại diện và nhà cung cấp dịch vụ có thể truy cập trên cơ sở cần phải biết. Chúng tôi tuân theo các tiêu chuẩn ngành, pháp luật trong việc bảo mật thông tin cá nhân khách hàng.<br>
                    <span class="fw-bold">• Trách nhiệm: </span>
                    Trong trường hợp máy chủ lưu trữ thông tin bị hacker tấn công dẫn đến mất mát dữ liệu cá nhân khách hàng, chúng tôi sẽ có trách nhiệm thông báo vụ việc cho cơ quan chức năng để điều tra xử lý kịp thời và thông báo cho khách hàng được biết.
                    <br><span class="fw-bold">• Các thông tin thanh toán: </span>
                    được bảo mật theo tiêu chuẩn ngành.
                </p>
                <h5 class="">6. Quyền lợi của khách hàng đối với thông tin cá nhân</h5>
                <p>
                    • Khách hàng có quyền cung cấp thông tin cá nhân cho chúng tôi và có thể thay đổi quyết định đó vào bất cứ lúc nào.<br>
                    • Khách hàng có quyền tự kiểm tra, cập nhật, điều chỉnh thông tin cá nhân của mình bằng cách đăng nhập vào tài khoản và chỉnh sửa thông tin cá nhân hoặc yêu cầu chúng tôi thực hiện việc này.
                </p>
                <h5 class="">7. Yêu cầu xóa bỏ thông tin cá nhân</h5>
                <p>
                    • Khách hàng có quyền yêu cầu xóa bỏ hoàn toàn các thông tin cá nhân lưu trữ trên hệ thống của chúng tôi bất cứ khi nào.<br>
                    • Khách hàng gửi thư điện tử về địa chỉ <span class="fw-bold">beecloudy2024@gmail.com</span> để yêu cầu xóa bỏ thông tin cá nhân hoàn toàn khỏi hệ thống.
                </p>
                <h5 class="">8. Thông tin liên hệ</h5>
                <p>
                    Nếu bạn có câu hỏi hoặc bất kỳ thắc mắc nào về chính sách này hoặc thực tế việc thu thập, quản lý thông tin cá nhân của chúng tôi, xin vui lòng liên hệ với chúng tôi bằng cách:
                </p>
                <p class="mb-0">
                <p class="p-0 ms-3">
                    • Gọi điện thoại đến: <span class="fw-bold">0379000358</span>
                    <br> • Gửi thư điện tử đến địa chỉ email: <span class="fw-bold">beecloudy2024@gmail.com</span>
                </p>

                <p>
                    Trên đây là những chính sách bảo mật và điều khoản dịch vụ về thông tin khách hàng của BeeCloudy, quý khách hàng có thể yên tâm sử dụng các dịch vụ, sản phẩm tại BeeCloudy mà không cần lo lắng về khả năng bị ăn cắp thông tin, lộ thông tin hay các rủi ro khác khi mua hàng tại website <a href="https://beecloud.shop/">beecloud.shop</a>
                </p>

            </div>
        </div>
</section>
@endsection