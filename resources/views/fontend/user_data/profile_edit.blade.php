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
                                    <img style="border: 5px solid white"
                                        src="{{ $user->image ? Storage::url($user->image) : asset('storage/default/avatar-default.jpg') }}"
                                        alt="image user acount" class="rounded-circle" width="90px" height="90px">
                                </div>
                                <div class="col-lg-8 col-md-8 align-items-center d-flex">
                                    <div class="news-profile  mt-2">
                                        <h6 class="fw-bold  fz-18">{{ Auth::user()->name }}</h6>
                                        <p class="fz-13">Ngày tham gia:
                                            <strong>{{ Auth::user()->created_at->format('d/m/Y') }}</strong>
                                        </p>
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
                                            <a href="#" class="text-decoration-none fz-12 ps-1 text-danger">
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
                                <div class="card border-0 card-height-100 ">
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
                                                                class="fa-solid fa-circle-user fz-16 me-2"></i> Thông tin cá
                                                            nhân</span>
                                                        <i class="fa-solid fa-chevron-down fz-12 d-none"></i>
                                                        <i class="fa-solid fa-chevron-right fw-bolder fz-12"></i>
                                                    </a>
                                                </div>
                                                <div class="sub-menu-lv2 d-none">
                                                    <ul class="sub-menu-ul flex-column text-muted ps-0">
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a href="{{ route('profile.edit') }}" class="nav-link p-2">
                                                                <i class='bx bx-circle fz-8 me-2'></i>
                                                                <span>Cập nhật</span>
                                                            </a>
                                                        </li>
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a href="{{ route('profile.change-view') }}"
                                                                class="nav-link p-2">
                                                                <i class='bx bx-circle fz-8 me-2'></i>
                                                                <span>Đổi mật khẩu</span>
                                                            </a>
                                                        </li>
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a class="nav-link fw-400 d-flex justify-content-between align-items-center p-2"
                                                                href="#" role="button">
                                                                <div>
                                                                    <i class='bx bx-circle fz-8 me-2'></i>
                                                                    <span>Địa chỉ</span>
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
                                                                            <a href="#" class="nav-link p-2">Danh
                                                                                sách</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="sub-menu-lv3 d-none">
                                                                <div class="sub-sub-menu">
                                                                    <ul class="flex-column sub-sub-menu-ul ps-15">
                                                                        <li class="sub-sub-menu-li">
                                                                            <a href="#" class="nav-link p-2">Thêm
                                                                                mới</a>
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
                                                                class='bx bxs-package fz-18 me-2'></i> Đơn hàng</span>
                                                        <i class="fa-solid fa-chevron-down fz-12 d-none"></i>
                                                        <i class="fa-solid fa-chevron-right fw-bolder fz-12"></i>
                                                    </a>
                                                </div>
                                                <div class="sub-menu-lv2 d-none">
                                                    <ul class="sub-menu-ul flex-column text-muted ps-0">
                                                        <li class="sub-menu-li list-unstyled ps-4">
                                                            <a href="#" class="nav-link p-2">
                                                                <i class='bx bx-circle fz-8 me-2'></i>
                                                                <span>Starter</span>
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
                                    <div class="card border-0 mb-3">
                                        <div class="card-header border-0">
                                            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Cập nhật thông tin
                                            </h6>
                                        </div><!-- end cardheader -->
                                    </div>
                                    <div class="card border-0 ">
                                        <div class="card-body fz-16">
                                            <div class="flex-grow">
                                                <h6 class="card-title mb-0 flex-grow-1 fz-16 pt-2 pb-1">Thông tin
                                                </h6>
                                                <p class="fz-14">Hãy chắc rằng thông tin bạn đang nhập là chính xác!
                                                </p>
                                            </div>
                                            <div class="mt-5">
                                                <form action="{{ route('profile.update') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Họ và tên</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" placeholder="Họ và tên"
                                                                            value="{{ old('name', $user->name) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Ngày sinh</label>
                                                                        <input type="date" class="form-control"
                                                                            name="birthday" placeholder="Ngày sinh"
                                                                            value="{{ old('birthday', $user->birthday) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Email</label>
                                                                        <input type="email" class="form-control"
                                                                            name="email" placeholder="Email"
                                                                            value="{{ old('email', $user->email) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Số điện thoại</label>
                                                                        <input type="text" class="form-control"
                                                                            name="phone" placeholder="Số điện thoại"
                                                                            value="{{ old('phone', $user->phone) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                                                            <img src="{{ $user->image ? Storage::url($user->image) : asset('storage/default/avatar-default.jpg') }}"
                                                                alt="Avatar" alt="User Image"
                                                                class="rounded-circle mb-3" width="100"
                                                                height="100">
                                                            <input type="file" name="image"
                                                                class="form-control mb-1">
                                                            <p class="fz-12">Chấp nhận định dạng JPG, PNG, Webp</p>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Giới thiệu</label>
                                                                <textarea name="description" class="form-control" rows="3">{{ old('description', $user->description) }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="text-end mb-3">
                                                            <button type="button"
                                                                class="cancel btn btn-outline-secondary rounded-1 px-4 me-2">Hủy</button>
                                                            <button type="submit"
                                                                class="accept btn btn-success rounded-1 px-4">Xác
                                                                nhận</button>
                                                        </div>
                                                    </div>
                                                </form>

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
