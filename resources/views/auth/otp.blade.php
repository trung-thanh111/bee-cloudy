@extends('fontend.home.layout')
@section('page_title')
    Mã OTP
@endsection
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
                    <div class="col-xl-5 col-lg-6 col-md-8 col-12 bg-white shadow-sm p-4 text-muted ">
                        <div class="title-vertify-mail text-center">
                            <h6 class="fz-18 text-uppercase">Quên mật khẩu</h6>
                            <p class="fz-16 fw-600 text-info text-decoration-underline">Nhập mã OTP</p>
                        </div>
                        <div class="position-relative mx-4 my-5">
                            <div class="progress process-step1 " role="progressbar" aria-label="Progress" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                            <button type="button"
                                class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-success rounded-pill"
                                style="width: 2rem; height:2rem;">1</button>
                            <button type="button"
                                class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-success rounded-pill"
                                style="width: 2rem; height:2rem;">2</button>
                            <button type="button"
                                class="position-absolute top-0 start-100 translate-middle btn btn-sm bg-btn-progress rounded-pill"
                                style="width: 2rem; height:2rem;">3</button>
                        </div>
                        <div class="alert alert-warning text-warning rounded-1 py-2 border-0" role="alert">
                            <span class="fz-14 align-middle fw-normal">Mã OTP chúng tôi đã cung cấp thông qua email vừa xác
                                thực</span>
                        </div>
                        <form action="{{ route('password.otp.submit') }}" method="POST">
                            @csrf
                            @php
                                $stringSessionEmail = implode(',', session('email'));
                            @endphp

                            <input type="hidden" name="email" value="{{ $stringSessionEmail }}">
                            <div class="mb-3">
                                <label class="form-label">OTP </label>
                                <input type="text" class="form-control" name="otp"
                                    placeholder="Nhập mã OTP đã nhận được" value="">
                                @if ($errors->has('otp'))
                                    <span class="text-danger fz-12 mt-1">{{ $errors->first('otp') }}</span>
                                @endif
                            </div>
                            <div class="text-end mb-3">
                                <button type="submit" class="accept btn btn-success rounded-1 px-4">Xác nhận</button>
                            </div>
                            <div class="text-end mb-3">
                                <span class="fz-14">Chưa nhận đc OTP. <a href="{{ route('password.otp.resend') }}">Gửi
                                        lại</a></span>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </article>
    </section>
@endsection
