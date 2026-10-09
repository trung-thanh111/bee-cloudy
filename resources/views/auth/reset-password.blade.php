@extends('fontend.home.layout')
@section('title', 'Đặt lại mật khẩu')

@section('content')
    <section>
        <article>
            <div class="container p-0">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="#" class="text-decoration-none text-muted">Quên mật
                                khấu</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Xác thực email</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="main-content-vertification justify-content-center row w-100 p-0 mt-3 rounded-2">
                    <div class="col-lg-5 col col-md-auto bg-white shadow-sm p-4 text-muted ">
                        <div class="title-vertify-mail text-center">
                            <h6 class="fz-18 text-uppercase">Quên mật khẩu</h6>
                            <p class="fz-16 fw-600 text-info text-decoration-underline">Reset mật khẩu</p>
                        </div>
                        <div class="position-relative mx-4 my-5">
                            <div class="progress process-step1 " role="progressbar" aria-label="Progress" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <button type="button"
                                class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-success rounded-pill"
                                style="width: 2rem; height:2rem;">1</button>
                            <button type="button"
                                class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-success rounded-pill"
                                style="width: 2rem; height:2rem;">2</button>
                            <button type="button"
                                class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-success rounded-pill"
                                style="width: 2rem; height:2rem;">3</button>
                        </div>
                        <div class="text-warning rounded-1 py-2 border-0" role="alert">
                            <span class="fz-16 align-middle fw-normal">Gợi ý mật khẩu*</span>
                            <ul class="text-muted mt-2">
                                <li class="list-unstyled ">
                                    <p class="fz-14 mb-1">Mật khẩu ít nhất 8 ký tự, a-z, 0-9 và các ký tự đặc biệt</p>
                                </li>
                                <li class="list-unstyled ">
                                    <p class="fz-14 mb-1">Mật khẩu không nên có tên, ngày sinh và những thông tin hiển
                                        thị
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @php
                                $stringSessionEmail = implode(',', session('email'));
                                // dd($stringSessionEmail);
                            @endphp

                            <input type="hidden" name="email" value="{{ $stringSessionEmail }}">
                            <div class="mb-3">
                                <label for="password-new" class="form-label">Mật khẩu mới</label>
                                <div class="input-group flex-nowrap">
                                    <input type="password" name="password" class="form-control input-group-password"
                                        id="password-new" placeholder="Mật khẩu mới" aria-label="Username"
                                        aria-describedby="addon-wrapping">
                                    <span class="input-group-text icon-eye-password" id="addon-wrapping">
                                        <i class="fa-solid fa-eye"></i>
                                        <i class="fa-solid fa-eye-slash d-none"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger fz-12 mt-1">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Xác nhận mật khẩu</label>
                                <div class="input-group flex-nowrap">
                                    <input type="password" name="password_confirmation"
                                        class="form-control input-group-password" id="password-confirm"
                                        placeholder="Xác nhận mật khẩu" aria-label="Username"
                                        aria-describedby="addon-wrapping">
                                    <span class="input-group-text icon-eye-password" id="addon-wrapping">
                                        <i class="fa-solid fa-eye"></i>
                                        <i class="fa-solid fa-eye-slash d-none"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span
                                        class="text-danger fz-12 mt-1">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            <div class="text-end mb-3">
                                <button type="submit" class="accept btn btn-success rounded-1 px-4">Xác nhận</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </article>
    </section>

@endsection
