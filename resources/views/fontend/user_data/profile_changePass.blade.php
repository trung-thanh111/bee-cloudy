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
                    @include('fontend.account.components.header-profile')
                    <div class="body-profile">
                        <div class="row">
                            @include('fontend.account.components.aside')
                            <div class="col-lg-9 col-md-8 flex-grow-1">
                                <div class="article-profile mb-5">
                                    <div class="card border-0 mb-3">
                                        <div class="card-header border-0">
                                            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Thay đổi mật khẩu
                                            </h6>
                                        </div><!-- end cardheader -->
                                    </div>
                                    <div class="card border-0 ">
                                        <div class="card-body fz-16">
                                            <div class="flex-grow">
                                                <h6 class="card-title mb-0 flex-grow-1 fz-16 pt-2 pb-1">Thông tin</h6>
                                                <p class="fz-14">Hãy thay đổi mật khẩu thường xuyên giúp tài khoản an
                                                    toàn hơn!</p>
                                            </div>
                                            <div class="mt-3 p-4 rounded-2">
                                                @if (session('error'))
                                                    <p style="color: red;">{{ session('error') }}</p>
                                                @elseif(session('success'))
                                                    <p style="color: green;">{{ session('success') }}</p>
                                                @endif
                                                <form action="{{ route('profile.change-submit') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row bg-white shadow-sm">
                                                        <div
                                                            class="col-lg-5 col-md-5 col-sm-12 bg-main-color p-4 text-muted">
                                                            <div class="title-changepw mb-4">
                                                                <h6 class="fz-16">Gợi ý mật khẩu</h6>
                                                            </div>
                                                            <div
                                                                class="content-changepw d-flex justify-content-start align-items-center mb-2 ">
                                                                <i class="fa-solid fa-circle-check"></i>
                                                                <span class="fz-14">Mật khẩu ít nhất 8 ký tự</span>
                                                            </div>
                                                            <div
                                                                class="content-changepw d-flex justify-content-start align-items-center mb-2 ">
                                                                <i class="fa-solid fa-circle-check"></i>
                                                                <span class="fz-14">Ít nhất 1 ký tự viết Hoa</span>
                                                            </div>
                                                            <div
                                                                class="content-changepw d-flex justify-content-start align-items-center mb-2 ">
                                                                <i class="fa-solid fa-circle-check"></i>
                                                                <span class="fz-14">Mật khẩu bao gồm các ký tự A - Z, số
                                                                    từ 0 - 9 và các ký tự đặc biệt</span>
                                                            </div>
                                                            <div
                                                                class="content-changepw d-flex justify-content-start align-items-center mb-2 ">
                                                                <i class="fa-solid fa-circle-check"></i>
                                                                <span class="fz-14">Không nên đặt bằng tên hoặc ngày sinh
                                                                    những thông tin đơn giản, những thông tin hiển
                                                                    thị,...</span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-7 col-md-7 col-sm-12 flex-grow-1 p-4 text-muted bg-white">
                                                            <div class="text-lg-center text-md-center mb-4">
                                                                <h6 class="fz-18 fw-600">Đổi mật khẩu</h6>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="password-current" class="form-label">Mật khẩu
                                                                    hiện tại</label>
                                                                <div class="input-group flex-nowrap">
                                                                    <input type="password" name="current_password"
                                                                        class="form-control input-group-password"
                                                                        id="password-current"
                                                                        placeholder="Mật khẩu hiện tại"
                                                                        aria-label="current_password"
                                                                        aria-describedby="addon-wrapping" required>
                                                                    <span class="input-group-text icon-eye-password"
                                                                        id="addon-wrapping">
                                                                        <i class="fa-solid fa-eye"></i>
                                                                        <i class="fa-solid fa-eye-slash d-none"></i>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="password-new" class="form-label">Mật khẩu
                                                                    mới</label>
                                                                <div class="input-group flex-nowrap">
                                                                    <input type="password" name="password"
                                                                        class="form-control input-group-password"
                                                                        id="password-new" placeholder="Mật khẩu mới"
                                                                        aria-label="new_password"
                                                                        aria-describedby="addon-wrapping" required>
                                                                    <span class="input-group-text icon-eye-password"
                                                                        id="addon-wrapping">
                                                                        <i class="fa-solid fa-eye"></i>
                                                                        <i class="fa-solid fa-eye-slash d-none"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="password-confirm" class="form-label">Xác nhận
                                                                    mật khẩu</label>
                                                                <div class="input-group flex-nowrap">
                                                                    <input type="password" name="password_confirmation"
                                                                        class="form-control input-group-password"
                                                                        id="password-confirm"
                                                                        placeholder="Xác nhận mật khẩu"
                                                                        aria-label="new_password_confirmation"
                                                                        aria-describedby="addon-wrapping" required>
                                                                    <span class="input-group-text icon-eye-password"
                                                                        id="addon-wrapping">
                                                                        <i class="fa-solid fa-eye"></i>
                                                                        <i class="fa-solid fa-eye-slash d-none"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="my-2">
                                                                <div
                                                                    class="forgot-password d-flex justify-content-end align-items-center fz-14">
                                                                    <span class="me-2">Quên mật khẩu hiện tại! </span>
                                                                    <a href="{{ route('password.confirm_email') }}"
                                                                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Lấy
                                                                        lại mật khẩu</a>
                                                                </div>
                                                            </div>
                                                            <div class="text-end mt-4">
                                                                <button type="button"
                                                                    class="cancel btn btn-outline-secondary rounded-1 px-3 me-2">Hủy</button>
                                                                <button type="submit"
                                                                    class="accept btn btn-success rounded-1 px-3">Xác
                                                                    nhận</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @if (session('error'))
                                                    <div class="alert alert-danger fz-14">{{ session('error') }}</div>
                                                @elseif(session('success'))
                                                    <div class="alert alert-success fz-14">{{ session('success') }}</div>
                                                @endif

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
