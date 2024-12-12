<div class="col-lg-3 col-md-4 flex-grow-1 mb-3">
    <div class="card border-0 card-height-100 ">
        <div class="card-header align-items-center d-flex">
            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Thông tin </h6>
        </div>
        <div class="card-body p-0 mt-3">
            <ul class="p-0">
                <li class="list-unstyled fz-16 cursor-pointer">
                    <div class="nav-item-profile {{ request()->is('profile') || request()->is('profile/edit') || request()->is('profile/change-pass') ? 'active' : '' }}">
                        <span
                            class="nav-link cursor-pointer fw-400 d-flex justify-content-between align-items-center">
                            <span class="fz-16 fw-400">
                                <i class="fa-solid fa-circle-user fz-16 me-2"></i>
                                Thông tin cá nhân
                            </span>
                            <i class="fa-solid fa-chevron-down fz-12 d-none"></i>
                            <i class="fa-solid fa-chevron-right fw-bolder fz-12"></i>
                        </span>
                    </div>
                    <div class="sub-menu-lv2 d-none">
                        <ul class="sub-menu-ul flex-column text-muted ps-0">
                            <li class="sub-menu-li list-unstyled ps-4 ">
                                <a href="{{ route('profile.user') }}" class="nav-link cursor-pointer p-2">
                                    <i class='bx bx-circle fz-8 me-2'></i>
                                    <span>Thông tin</span>
                                </a>
                            </li>
                            <li class="sub-menu-li list-unstyled ps-4">
                                <a href="{{ route('profile.edit') }}" class="nav-link cursor-pointer p-2">
                                    <i class='bx bx-circle fz-8 me-2'></i>
                                    <span>Cập nhật</span>
                                </a>
                            </li>
                            <li class="sub-menu-li list-unstyled ps-4">
                                <a href="{{ route('profile.change-view') }}" class="nav-link cursor-pointer p-2">
                                    <i class='bx bx-circle fz-8 me-2'></i>
                                    <span>Đổi mật khẩu</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="list-unstyled fz-16 cursor-pointer">
                    <div class="nav-item-profile {{ request()->is('account/view_order') || request()->is('account/order/detail/*') ? 'active' : '' }}">
                        <span
                            class="nav-link cursor-pointer fw-400 d-flex justify-content-between align-items-center">
                            <span class="fz-16 fw-400"> <i
                                    class='bx bxs-package fz-18 me-2'></i>
                                Đơn hàng</span>
                            <i class="fa-solid fa-chevron-down fz-12 d-none"></i>
                            <i class="fa-solid fa-chevron-right fw-bolder fz-12"></i>
                        </span>
                    </div>
                    <div class="sub-menu-lv2 d-none">
                        <ul class="sub-menu-ul flex-column text-muted ps-0">
                            <li class="sub-menu-li list-unstyled ps-4">
                                <a href="{{ route('account.order') }}" type="submit"
                                    class="nav-link cursor-pointer p-2">
                                    <i class='bx bx-circle fz-8 me-2'></i>
                                    <span>Đơn hàng của tôi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="list-unstyled fz-16 cursor-pointer">
                    <div class="nav-item-profile {{ request()->is('promotion') || request()->is('account/view_promotion') ? 'active' : '' }}">
                        <span
                            class="nav-link cursor-pointer fw-400 d-flex justify-content-between align-items-center">
                            <span class="fz-16 fw-400"> <i
                                    class='fa-solid fa-ticket fz-18 me-2'></i>
                                Khuyến mãi</span>
                            <i class="fa-solid fa-chevron-down fz-12 d-none"></i>
                            <i class="fa-solid fa-chevron-right fw-bolder fz-12"></i>
                        </span>
                    </div>
                    <div class="sub-menu-lv2 d-none">
                        <ul class="sub-menu-ul flex-column text-muted ps-0">
                            <li class="sub-menu-li list-unstyled ps-4">
                                <a href="{{ route('promotion.home_index') }}" type="submit"
                                    class="nav-link cursor-pointer p-2">
                                    <i class='bx bx-circle fz-8 me-2'></i>
                                    <span>Cửa hàng</span>
                                </a>
                            </li>
                            <li class="sub-menu-li list-unstyled ps-4">
                                <a href="{{ route('account.promotions') }}" type="submit"
                                    class="nav-link cursor-pointer p-2">
                                    <i class='bx bx-circle fz-8 me-2'></i>
                                    <span>Của tôi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>