<section>
        <div class="container-fuild z-0 pt-5" style="background-color: #c3c3c3">
            <div class="container">
                <div class="row flex-grow">
                    <div class="col-lg-3 col-md-8 col-sm-6">
                        <h6 class="text-uppercase fw-bold fz-16">Cửa hàng</h6>
                        <ul class="p-0">
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="{{ route('home.about_us') }}"
                                    class="text-decoration-none text-dark fz-15 fw-normal">Về chúng tôi</a>
                            </li>
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="{{ route('shop.index') }}"
                                    class="text-decoration-none text-dark fz-15 fw-normal">Sản phẩm</a>
                            </li>
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="{{ route('cart.index') }}"
                                    class="text-decoration-none text-dark fz-15 fw-normal">Giỏ hàng</a>
                            </li>
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="{{ route('wishlist.index') }}"
                                    class="text-decoration-none text-dark fz-15 fw-normal">Yêu thích</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <h6 class="text-uppercase fw-bold fz-16">Chính sách cửa hàng</h6>
                        <ul class="p-0">
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="{{ route('home.return_and_warranty_policy') }}"
                                    class="text-decoration-none text-dark fz-15 fw-normal">Chính sách đổi trả, bảo
                                    hành</a>
                            </li>
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="{{ route('home.terms_and_conditions') }}"
                                    class="text-decoration-none text-dark fz-15 fw-normal">Điều khoản &
                                    Điều kiện</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <h6 class="text-uppercase fw-bold fz-16">Chăm sóc khách hàng</h6>
                        <ul class="p-0">
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="{{ route('home.contact') }}"
                                    class="text-decoration-none text-dark fz-15 fw-normal">Liên hệ</a>
                            </li>
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="{{ route('home.faq') }}"
                                    class="text-decoration-none text-dark fz-15 fw-normal">Câu hỏi thường
                                    gặp</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <h6 class="text-uppercase fw-bold fz-16">Theo dõi chúng tôi</h6>
                        <ul class="p-0 d-flex justify-content-around align-items-center w-75">
                            <li class="list-unstyled menu-footer-item pt-2 ps-0 pb-2">
                                <a href="#" class="text-decoration-none text-dark fz-20 fw-normal">
                                    <i class="fa-brands fa-facebook" data-bs-toggle="tooltip"
                                        data-bs-title="Mạng xã hội Facebook"></i>
                                </a>
                            </li>
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="#" class="text-decoration-none text-dark fz-20 fw-normal">
                                    <i class="fa-brands fa-square-instagram" data-bs-toggle="tooltip"
                                        data-bs-title="Mạng xã hội Instagram"></i>
                                </a>
                            </li>
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="#" class="text-decoration-none text-dark fz-20 fw-normal">
                                    <i class="fa-brands fa-youtube" data-bs-toggle="tooltip"
                                        data-bs-title="Nền tảng Youtube"></i>
                                </a>
                            </li>
                            <li class="list-unstyled menu-footer-item pt-2 pb-2">
                                <a href="#" class="text-decoration-none text-dark fz-20 fw-normal">
                                    <i class="fa-brands fa-square-twitter" data-bs-toggle="tooltip"
                                        data-bs-title="Mạng xã hội Twitter"></i>
                                </a>
                            </li>
                        </ul>
                        <h6 class="text-uppercase fw-bold fz-16">Khuyến mãi</h6>
                        <span class="text-dark fz-14">
                            Đăng ký để nhận giảm giá tới 20% cho đơn hàng.
                        </span>
                        <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="Đăng ký ngay"
                                aria-describedby="button-addon2">
                            <button class="btn btn-success px-3" type="button" id="button-addon2">Gửi</button>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-9 col-md-6 col-sm-6">
                        <span class="text-decoration-none text-dark fz-15 fw-normal">@2023 - 2024 phát triển toàn
                            diện</span>
                        <ul class="d-flex justify-content-start  align-items-center p-0">
                            <li class="list-unstyled menu-footer-item pt-2 pb-2 me-2">
                                <a href="{{ route('home.security_center') }}"
                                    class="text-decoration-underline text-dark fz-15 fw-medium ">Trung tâm
                                    bảo
                                    mật</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <h6 class="text-uppercase fw-bold fz-16">Phương thức thanh toán</h6>
                        <ul class="p-0 d-flex justify-content-sm-around align-items-center w-75">
                            <li class="list-unstyled menu-footer-item pt-2 ps-0 pb-2">
                                <a href="#" class="text-decoration-none text-dark fz-20 fw-normal">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/pay.svg"
                                        alt="" class="w-100" data-bs-toggle="tooltip"
                                        data-bs-title="Các phuong thức thanh toán">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <tfoot>
        <div class="container-fuild text-bg-dark">
            <div class="container text-lg-center p-2">
                <span class="p-2 fz-14">Bản quyền thuộc © thewinner 2024 - 2025</span>
            </div>
        </div>
    </tfoot>
</section>
