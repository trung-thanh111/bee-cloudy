@extends('fontend.home.layout')
@section('page_title')
    Đăng ký
@endsection
@section('content')
    <section>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8 col-12">
                    <div class="card border-0 shadow-sm mt-4 card-bg-fill">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-body fz-18">Đăng ký!</h5>
                                <p class="text-muted fz-14">Đăng ký ngay để có thể trải nghiệm website!</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form action="{{ route('store.register') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Họ tên</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Nhập họ tên" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger fz-12 mt-1">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            placeholder="Nhập email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger fz-12 mt-1">{{ $errors->first('email') }}</span>
                                        @endif
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
                                    <div class="mb-3">
                                        <label class="form-label" for="password-confirm">Xác nhận mật khẩu</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="password" class="form-control input-group-password"
                                                id="password-confirm" name="password_confirmation"
                                                placeholder="Xác nhận mật khẩu" value="">
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
                                    <div class="form-check">
                                        <input required class="form-check-input" type="checkbox" name="accept_clause"
                                            value="" id="auth-remember-check"
                                            {{ old('accept_clause') ? 'checked' : '' }}>
                                        <label class="form-check-label fz-14" for="auth-remember-check">Chấp nhận điều khoản
                                            <a href="#" class="text-decoration-underline">của chúng tôi!</a>
                                        </label>
                                    </div>
                                    @if ($errors->has('accept_clause'))
                                        <span class="text-danger fz-12 ">{{ $errors->first('accept_clause') }}</span>
                                    @endif
                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Đăng ký</button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fz-13 mb-4 title">Đăng ký với </h5>
                                        </div>
                                        <div>
                                            <a href="{{ route('auth.google') }}" type="button"
                                                class="btn btn-danger btn-icon waves-effect waves-light">
                                                <i class="fa-brands fa-google-plus fz-18"></i>
                                            </a>
                                            <a href="#" type="button"
                                                class="btn btn-dark btn-icon waves-effect waves-light">
                                                <i class="fa-brands fa-github fz-18"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-4 text-center fz-14">
                                <p class="mb-0">Đã có tài khoản ?
                                    <a href="{{ route('auth.login') }}"
                                        class="fw-semibold text-primary text-decoration-underline"> Đăng nhập </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
