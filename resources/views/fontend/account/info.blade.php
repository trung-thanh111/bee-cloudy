@extends('fontend.home.layout')
@section('page_title')
    Thông tin cá nhân
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="#" class="text-decoration-none text-muted">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="profile-main">
                    <div class="header-profile mb-3">
                        <div class="text-muted d-flex justify-content-between align-items ">
                            <div class="row ps-lg-3 pe-lg-3 p-lg-5 p-md-5 p-sm-4 p-xs-3">
                                <div class="col-lg-4 col-md-4">
                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif" alt="image user acount"
                                        class="rounded-circle " width="90px" height="90px">
                                </div>
                                <div class="col-lg-8 col-md-8 align-items-center">
                                    <div class="news-profile  mt-2">
                                        <h6 class="fw-bold  fz-18">Thanh trung</h6>
                                        <p class="mb-0 fz-14">Thứ hạng thành viên: <strong>Bạc</strong></p>
                                        <p class="fz-13">Ngày tham gia: 27/45/3455</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 text-end align-items-start position-relative">
                                <a class="gear-profile text-muted" href="#">
                                    <i class="fa-solid fa-gear fz-20 p-3" data-bs-toggle="tooltip"
                                        data-bs-title="Cài đặt"></i>
                                </a>
                                <div class="dropdown-icon-profile rounded-2">
                                    <ul class="ul-menu w-100 p-0 dropdown-content mb-1">
                                        <li class="li-menu-header p-1">
                                            <a href="#" class="text-decoration-none fz-12 ps-1">
                                                <i class="fa-solid fa-pen me-2"></i>Cập nhật
                                            </a>
                                        </li>
                                        <li class="li-menu-header p-1">
                                            <a href="{{ route('auth.login') }}" class="text-decoration-none fz-12 ps-1 text-danger">
                                                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Đăng xuất
                                            </a>
                                        </li>
                                        <hr>
                                        <li class="li-menu-header p-1">
                                            <a href="#" class="text-decoration-none fz-12 ps-1 text-muted">
                                                <i class="fa-solid fa-circle-info me-2"></i>Hỗ trợ
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body-profile">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 flex-grow-1 mb-3">
                                <div class="card card-height-100 ">
                                    <div class="card-header align-items-center d-flex">
                                        <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Thông tin </h6>
                                    </div><!-- end card header -->

                                    <!-- cardbody -->
                                    <div class="card-body p-0 mt-3">
                                        <ul class="p-0">
                                            <li class="list-unstyled fz-16">
                                                <div class="nav-item-main">
                                                    <a class="nav-link fw-400 d-flex justify-content-between align-items-center"
                                                        href="#" role="button">
                                                        <span class="fz-16 fw-400"> <i
                                                                class="fa-solid fa-circle-user fz-16 me-2"></i> Thông tin cá nhân</span>
                                                        <i class="fa-solid fa-chevron-down fz-12 d-none"></i>
                                                        <i class="fa-solid fa-chevron-right fw-bolder fz-12"></i>
                                                    </a>
                                                </div>
                                                <div class="sub-menu-lv2 d-none">
                                                    <ul class="sub-menu-ul flex-column text-muted ps-0">
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a href="#" class="nav-link p-2">
                                                                <i class='bx bx-circle fz-8 me-2'></i>
                                                                <span>Cập nhật</span>
                                                            </a>
                                                        </li>
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a href="#" class="nav-link p-2">
                                                                <i class='bx bx-circle fz-8 me-2'></i>
                                                                <span>Đổi mật khẩu</span>
                                                            </a>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-unstyled fz-16">
                                                <div class="nav-item-main">
                                                    <a class="nav-link fw-400 d-flex justify-content-between align-items-center"
                                                        href="{{ route('account.order') }}">
                                                        <span class="fz-16 fw-400"> <i
                                                                class='bx bxs-package fz-18 me-2'></i> Đơn hàng</span>
                                                        <i class="fa-solid fa-chevron-down fz-12 d-none"></i>
                                                        <i class="fa-solid fa-chevron-right fw-bolder fz-12"></i>
                                                    </a>
                                                </div>
                                                <div class="sub-menu-lv2 d-none">
                                                    <ul class="sub-menu-ul flex-column text-muted ps-0">
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a href="{{ route('account.order') }}" type="submit" class="nav-link p-2">
                                                                <i class='bx bx-circle fz-8 me-2'></i>
                                                                <span>Theo dõi đơn hàng</span>
                                                            </a>
                                                        </li>
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a class="nav-link fw-400 d-flex justify-content-between align-items-center p-2"
                                                                href="#" role="button">
                                                                <div>
                                                                    <i class='bx bx-circle fz-8 me-2'></i>
                                                                    <span>Starter</span>
                                                                </div>
                                                                <i
                                                                    class="fa-solid fa-chevron-down lv3 fw-bolder fz-12 pe-12 d-none"></i>
                                                                <i
                                                                    class="fa-solid fa-chevron-right lv3 fw-bolder fz-12 pe-12"></i>
                                                            </a>
                                                            <div class="sub-menu-lv3 d-none">
                                                                <div class="sub-sub-menu">
                                                                    <ul class="flex-column sub-sub-menu-ul ps-15">
                                                                        <li class="sub-sub-menu-li">
                                                                            <a href="#" class="nav-link p-2">Simple
                                                                                Page</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="sub-menu-lv3 d-none">
                                                                <div class="sub-sub-menu">
                                                                    <ul class="flex-column sub-sub-menu-ul ps-15">
                                                                        <li class="sub-sub-menu-li">
                                                                            <a href="#" class="nav-link p-2">Simple
                                                                                Page</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-unstyled fz-16">
                                                <div class="nav-item-main">
                                                    <a class="nav-link fw-400 d-flex justify-content-between align-items-center"
                                                        href="#" role="button">
                                                        <span class="fz-16 fw-400"> <i
                                                                class='fa-solid fa-bell fz-18 me-2'></i> Thông
                                                            báo</span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="list-unstyled fz-16">
                                                <div class="nav-item-main">
                                                    <a class="nav-link fw-400 d-flex justify-content-between align-items-center"
                                                        href="#" role="button">
                                                        <span class="fz-16 fw-400"> <i
                                                                class="fa-solid fa-ticket fz-18 me-2"></i>
                                                            Voucher</span>
                                                    </a>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    <!-- end cardbody -->
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 flex-grow-1">
                                <div class="article-profile">
                                    <div class="card mb-3">
                                        <div class="card-header border-0">
                                            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Thông tin cá nhân
                                            </h6>
                                        </div><!-- end cardheader -->
                                    </div>
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center flex-grow">
                                                <div>
                                                    <h6 class="card-title mb-0 flex-grow-1 fz-16 pt-2 pb-1">Thông tin
                                                    </h6>
                                                    <p class="fz-14">Chứng tôi sẽ liên lạc với bạn thông qua nhưng thông
                                                        tin bên dưới!</p>
                                                </div>
                                                <a href="#"><i class="fa-solid fa-pen fz-18 text-muted pe-3"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Chỉnh sửa thông tin"></i></a>
                                            </div>
                                            <div class="table-reposive mt-5">
                                                <table class="table table-borderless align-middle ps-lg-3">
                                                    <thead>
                                                        <tr class="">
                                                            <td>Hình ảnh</td>
                                                            <th>
                                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif"
                                                                    alt=""
                                                                    class="user-account object-fit-cover rounded-circle"
                                                                    width="60px" height="60px">
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>Họ tên</td>
                                                            <th>phạm thanh trung</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <th>thanhtrungw0wer9wetwetw</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Ngày sinh</td>
                                                            <th>24/54/2492</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <div class="">
        <a href="#" class="text-decoration-none back-to-top text-end position-fixed z-3 d-none"
            style="bottom: 60px; right: 30px;">
            <div class=" border-2 rounded-circle">
                <i class="fa-solid fa-chevron-up fs-5 border-1 border-danger text-bg-secondary rounded-circle p-2"></i>
            </div>
        </a>
        <!-- <div class=" live-chat ms-lg-16">
                                                                    <a href="zalo">
                                                                        <img class="rounded-circle " src="public/image/zalo.png" alt="" width="50">
                                                                    </a>
                                                                </div> -->
    </div>
@endsection
