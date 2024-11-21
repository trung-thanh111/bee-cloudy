@if (Auth::check())
    @php
        $user = Auth::user();
    @endphp
@endif
<div class="header-profile mb-3 rounded-2">
    <div class="text-muted d-flex justify-content-between align-items ">
        <div class="row ps-lg-3 pe-lg-3 p-lg-5 p-md-5 p-sm-4 p-xs-3">
            <div class="col-lg-4 col-md-4">
                <img src="{{ $user->image != null ? $user->image : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif' }}"
                    alt="image user acount" class="rounded-circle " width="90px" height="90px">
            </div>
            <div class="col-lg-8 col-md-8 align-items-center">
                <div class="news-profile  mt-2">
                    <h6 class="fw-bold  fz-18">{{ $user != null ? $user->name : 'Chưa xác định' }}</h6>
                    <p class="mb-0 fz-14">Tư cách: <strong
                            class="text-danger">{{ $user != null ? $user->userCatalogue->name : 'Chưa xác định' }}</strong>
                    </p>
                    <p class="fz-13">Ngày tham gia:
                        {{ $user != null ? date('d-m-Y', strtotime($user->created_at)) : 'Chưa xác định' }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 text-end align-items-start position-relative">
            <a class="gear-profile text-muted" href="#">
                <i class="fa-solid fa-gear fz-20 p-3"></i>
            </a>
            <div class="dropdown-icon-profile rounded-2">
                <ul class="ul-menu w-100 p-0 dropdown-content mb-1">
                    <li class="li-menu-header p-1">
                        <a href="{{ route('profile.edit') }}" class="text-decoration-none fz-12 ps-1">
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
                        <a href="{{ route('home.contact') }}" class="text-decoration-none fz-12 ps-1 text-muted">
                            <i class="fa-solid fa-circle-info me-2"></i>Hỗ trợ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
