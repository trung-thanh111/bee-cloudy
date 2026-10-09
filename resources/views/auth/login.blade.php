@extends('fontend.home.layout')
@section('page_title')
    Đăng nhập
@endsection
@section('content')
    <section>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8 col-12">
                    <div class="card border-0 shadow-sm mt-4 card-bg-fill">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-body fz-18">Đăng nhập</h5>
                                <p class="text-muted fz-14">Chào mừng bạn đã trở lại!</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form action="{{ route('store.login') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            placeholder="Nhập email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger fz-12 mt-1">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="{{ route('password.confirm_email') }}" class="text-muted fz-14">Quên
                                                mật
                                                khẩu?</a>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Mật khẩu</label>
                                            <div class="input-group flex-nowrap">
                                                <input type="password" class="form-control input-group-password"
                                                    id="password-input" name="password" placeholder="Nhập mật khẩu">
                                                <span class="input-group-text icon-eye-password" id="addon-wrapping">
                                                    <i class="fa-solid fa-eye"></i>
                                                    <i class="fa-solid fa-eye-slash d-none"></i>
                                                </span>
                                            </div>
                                            @if ($errors->has('password'))
                                                <span class="text-danger fz-12 mt-1">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="auth-remember-check">
                                        <label class="form-check-label fz-14" for="auth-remember-check">Ghi nhớ đăng
                                            nhập</label>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Đăng nhập</button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fz-13 mb-4 title">Đăng nhập với </h5>
                                        </div>
                                        <div>
                                            <a href="{{ route('auth.google') }}" type="button"
                                                class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                    class="fa-brands fa-google-plus"></i></a>
                                            <a href="{{ route('auth.facebook') }}" type="button"
                                                class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                    class="fa-brands fa-facebook-f"></i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-4 text-center fz-14">
                                <p class="mb-0">Chưa có tài khoản ? <a href="{{ route('auth.register') }}"
                                        class="fw-semibold text-primary text-decoration-underline"> Đăng ký </a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
