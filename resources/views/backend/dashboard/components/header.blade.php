<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <form class="app-search d-none d-md-block">
                    <div class="position-relative">
                        <input type="text" class="form-control ps-5" placeholder="Tìm kiếm" autocomplete="off"
                            id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm"
                                        aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- đã đăng nhập  -->
                @if (Auth::check())
                @php
                    $user = Auth::user();
                    @endphp
                <div class="dropdown ms-sm-3 header-item">
                    <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"
                            src="{{ $user->image != null ? $user->image : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif' }}"
                            alt="Avatar User" class="rounded-circle object-fit-cover" width="40"
                            height="40">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{$user->name }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-danger user-name-sub-text">{{ $user->userCatalogue->name }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Xin chào {{$user->name }}!</h6>
                        <a class="dropdown-item" href="{{ route('profile.user') }}">
                            <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Thông tin cá nhân</span>
                        </a>
                        <a class="dropdown-item " href="{{ route('home.index') }}">
                            <i class="mdi mdi-home text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Trang chủ</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('shop.index') }}">
                            <i class="fa-solid fa-shop text-muted fz-10 align-middle me-2"></i>
                            <span class="align-middle" data-key="t-logout">Cửa hàng</span>
                        </a>
                        <hr>
                        <a class="dropdown-item text-danger" href="{{ route('auth.logout') }}">
                            <i class="mdi mdi-logout fs-16 align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Đăng xuất</span>
                        </a>
                    </div>
                </div>
            @endif
                
            </div>
        </div>
    </div>
</header>
