@extends('fontend.home.layout')
@section('page_title')
    Liên hệ
@endsection
@section('content')
    <section>
        <div class="container p-0">
            <!-- breadcrumb  -->
            <nav class="pt-3 pb-3" aria-label="breadcrumb">
                <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                    <li class="breadcrumb-item "><a href="{{ route('home.index') }}"
                            class="text-decoration-none text-muted">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                </ol>
            </nav>
            <div class="">
                <div class="card-body  m-2 text-muted">
                    <div class="row shadow-sm bg-white mt-4 mb-2 rounded-2 flex-wrap">
                        <h4 class="mt-4 mx-1 text-center">Gửi tin nhắn</h4>
                        <p class="fz-16 text-center">Bạn cũng có thể liên hệ với chúng tôi thông qua địa chỉ bên dưới!
                        </p>
                        <div class="col-12 col-lg-6 col-md-6 ps-2 rounded-start-3 pb-2">
                            <div class="contact-item z-1 text-center px-2 py-3 position-relative">
                                <div class="position-absolute top-0 start-0 w-100 h-100"></div>
                                <div class="contact-item-content position-relative">
                                    <div class="contact-item-text mt-3 mb-5 opacity-100">
                                        <i class="fa-solid fa-phone fs-2 mb-1" data-bs-toggle="tooltip"
                                            data-bs-title="thời gian làm việc"></i>
                                        <div>
                                            <p class="text-dark mb-0">0900232402</p>
                                        </div>
                                    </div>
                                    <div class="contact-item-text mb-5">
                                        <i class="fa-regular fa-envelope fs-2 mb-1"></i>
                                        <div>
                                            <p class="text-dark mb-0">beecloud2024@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="contact-item-text">
                                        <i class="fa-regular fa-clock fs-2 mb-1"></i>
                                        <div>
                                            <p class="text-dark mb-0">Thứ 2 - Thứ 6</p>
                                            <p class="text-dark mb-0">8h00 - 17h00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 pe-4 pb-2 pt-4 bg-white">
                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group position-relative py-0 w-100">
                                    <label for="content" class="form-label">Nội dung</label>
                                    <textarea class=" textarea-content form-control rounded-2  shadow-sm" id="content" rows="5"
                                        placeholder="Viết cho chúng tôi ngay!" name="message"></textarea>
                                    <button type="submit" class="btn btn-success position-absolute z-3 py-1 px-4"
                                        style="bottom: 40px ; right: 20px;">Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class=" text-center ">
                        <h4 class="pt-3">Vị trí </h4>
                        <p class="fz-16">Bạn cũng có thể liên hệ với chúng tôi thông qua địa chỉ bên dưới!</p>
                        <iframe class="shadow rounded-2"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.462
                        3221806924!2d106.62452997405464!3d10.852397889300988!2m3!1f0!2f0!3f0!3m2!1i1024!2i7
                        68!4f13.1!3m3!1m2!1s0x31752b6c59ba4c97%3A0x535e784068f1558b!2zVHLGsOG7nW5nIENhbyDEkeG6s25nI
                        EZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1725957483659!5m2!1svi!2s"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
    </section>
@endsection
