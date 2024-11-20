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
                            @include('fontend.account.components.aside')
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
                                                                <img src="{{ Auth::user()->image !== null ? Auth::user()->image : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif'}}"
                                                                    alt=""
                                                                    class="user-account object-fit-cover rounded-circle"
                                                                    width="60" height="60">
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>Họ tên</td>
                                                            <th>{{ Auth::user()->name }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <th>{{ Auth::user()->email }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Ngày sinh</td>
                                                            <th>{{ date('d-m-Y', Auth::user()->birth_day) }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Địa chỉ: </td>
                                                            <th>{{ Auth::user()->address }}</th>
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
@endsection
