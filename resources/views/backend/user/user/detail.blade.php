<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Chi tiết người dùng</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Danh sách</a>
                                </li>
                                <li class="breadcrumb-item active">Chi tiết</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content m-0 mt-3">
                <div class="page-content p-0 px-2">
                    <div class="container-fluid">
                        <div class="profile-foreground position-relative mx-n4 mt-n4">
                            <div class="profile-wid-bg">
                                <img src="{{ $user->image != null ? $user->image : '/libaries/upload/images/user-default.avif' }}"
                                    alt="" class="profile-wid-img" />
                            </div>
                        </div>
                        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
                            <div class="row g-4">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="{{ $user->image != null ? $user->image : '/libaries/upload/images/user-default.avif' }}"
                                            alt="user-img" class="rounded-circle" width="90" height="90" />
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col">
                                    <div class="p-2">
                                        <h3 class="text-white mb-1">{{ $user->name }}</h3>
                                        <p class="text-white text-opacity-75">
                                            {{ $user != null ? $user->userCatalogue->name : 'Chưa xác định' }}</p>
                                        <div class="hstack text-white-50 gap-1">
                                            <div class="me-2"><i
                                                    class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $user->address != null ? $user->address : 'Đang cập nhật' }}
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end row-->
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div class="d-flex profile-wrapper">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1"
                                            role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link fs-14 active" data-bs-toggle="tab"
                                                    href="#overview-tab" role="tab">
                                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                                        class="d-none d-md-inline-block">Tổng quan</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities"
                                                    role="tab">
                                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span
                                                        class="d-none d-md-inline-block">Hoạt động</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="flex-shrink-0">
                                            <a href="{{ route('user.update', ['id' => $user->id]) }}"
                                                class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i>
                                                Cập nhật</a>
                                        </div>
                                    </div>
                                    <!-- Tab panes -->
                                    <div class="tab-content pt-4 text-muted">
                                        <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                            <div class="row">
                                                <div class="col-xxl-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-3">Thông tin</h5>
                                                            <div class="table-responsive">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th class="ps-0" scope="row">Họ và tên
                                                                                :</th>
                                                                            <td class="text-muted">{{ $user->name }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="ps-0" scope="row">Số điện
                                                                                thoại :</th>
                                                                            <td class="text-muted">(+84)
                                                                                {{ $user->phone != null ? $user->phone : 'Đang cập nhật' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="ps-0" scope="row">Email :
                                                                            </th>
                                                                            <td class="text-muted">{{ $user->email }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="ps-0" scope="row">Ngày sinh
                                                                                :</th>
                                                                            <td class="text-muted">
                                                                                {{ $user->birthday != null ? date('d-m-Y', strtotime($user->birthday)) : 'Đang cập nhật' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="ps-0" scope="row">Địa chỉ :
                                                                            </th>
                                                                            <td class="text-muted">
                                                                                {{ $user->address != null ? $user->address : 'Đang cập nhật' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="ps-0" scope="row">Ngày
                                                                                tham gia :</th>
                                                                            <td class="text-muted">
                                                                                {{ date('d-m-Y', strtotime($user->created_at)) }}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div><!-- end card -->

                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">Trạng thái</h5>
                                                            <div class="d-flex flex-wrap align-items-center gap-2">
                                                                <div>
                                                                    <a href="javascript:void(0);"
                                                                        class="avatar-xs d-block">
                                                                        <span
                                                                            class="avatar-title rounded-circle fs-14 bg-success material-shadow">
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <span
                                                                    class="">{{ $user->publish == 1 ? 'Hoạt động' : 'Không hoạt động' }}</span>
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div><!-- end card -->
                                                </div>
                                                <!--end col-->
                                                <div class="col-xxl-8">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-3">Giới thiệu</h5>
                                                            <p>{{ $user->description != null ? $user->description : 'Đang cập nhật' }}
                                                            </p>

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-header align-items-center d-flex">
                                                                    <h4 class="card-title mb-0  me-2">Hoạt động gần đây
                                                                    </h4>
                                                                    <div class="flex-shrink-0 ms-auto">
                                                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                                                            role="tablist">
                                                                            <li class="nav-item">
                                                                                <a class="nav-link active"
                                                                                    data-bs-toggle="tab"
                                                                                    href="#today" role="tab">
                                                                                    Hôm nay
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive table-card">
                                                                        <table
                                                                            class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                                            @if (count($orderUserTodays) > 0)
                                                                            <thead class="text-muted table-light">
                                                                                <tr>
                                                                                    <th scope="col" width="130">
                                                                                        Mã đơn hàng</th>
                                                                                    <th scope="col"
                                                                                        class="text-end">Sản phẩm</th>
                                                                                    <th scope="col"
                                                                                        class="text-end">Thành tiền
                                                                                    </th>
                                                                                    <th scope="col"
                                                                                        class="text-end">Phương thức
                                                                                    </th>
                                                                                    <th scope="col"
                                                                                        class="text-end">Thời gian</th>
                                                                                    <th scope="col"
                                                                                        class="text-end">Trạng thái
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            @endif
                                                                            <tbody>
                                                                                @if ($orderUserTodays &&  count($orderUserTodays) > 0)
                                                                                    @foreach ($orderUserTodays as $keyOrderRc => $valueOrderRc)
                                                                                        @php
                                                                                            $imagePayment = '';
                                                                                            if (
                                                                                                $valueOrderRc->payment_method ==
                                                                                                'cod'
                                                                                            ) {
                                                                                                $imagePayment =
                                                                                                    '<i class="fa-solid fa-money-bill-wave fs-2 text-success"></i>';
                                                                                            } elseif (
                                                                                                $valueOrderRc->payment_method ==
                                                                                                'vnpay'
                                                                                            ) {
                                                                                                $imagePayment =
                                                                                                    '<img src="/libaries/upload/images/vnpay-icon.svg" alt="" class="object-fit-contain" width="60" height="30">';
                                                                                            } elseif (
                                                                                                $valueOrderRc->payment_method ==
                                                                                                'momo'
                                                                                            ) {
                                                                                                $imagePayment =
                                                                                                    '<img src="/libaries/upload/images/momo-icon.svg" alt="" class="object-fit-contain" width="35" height="30">';
                                                                                            } elseif (
                                                                                                $valueOrderRc->payment_method ==
                                                                                                'paypal'
                                                                                            ) {
                                                                                                $imagePayment =
                                                                                                    '<img src="/libaries/upload/images/paypal-icon.jpg" alt="" class="object-fit-contain" width="45" height="40">';
                                                                                            } else {
                                                                                                $imagePayment =
                                                                                                    '<i class="fa-solid fa-spinner fa-spin-pulse fs-2"></i>';
                                                                                            }
                                                                                            //-- //
                                                                                            $date = date(
                                                                                                'd-m-Y',
                                                                                                strtotime(
                                                                                                    $valueOrderRc->created_at,
                                                                                                ),
                                                                                            );
                                                                                            //-- -//
                                                                                            $statusMap = [
                                                                                                'pending' => [
                                                                                                    'Chờ xác nhận',
                                                                                                    'warning',
                                                                                                ],
                                                                                                'confirmed' => [
                                                                                                    'Đã xác nhận',
                                                                                                    'info',
                                                                                                ],
                                                                                                'shipping' => [
                                                                                                    'Đang vận chuyển',
                                                                                                    'secondary',
                                                                                                ],
                                                                                                'canceled' => [
                                                                                                    'Đã hủy đơn',
                                                                                                    'danger',
                                                                                                ],
                                                                                                'completed' => [
                                                                                                    'Thành công',
                                                                                                    'success',
                                                                                                ],
                                                                                            ];
                                                                                            $statusInfo = $statusMap[
                                                                                                $valueOrderRc->status
                                                                                            ] ?? [
                                                                                                'Không xác định',
                                                                                                'dark',
                                                                                            ];
                                                                                            $statusBadge =
                                                                                                '<span class="badge bg-' .
                                                                                                $statusInfo[1] .
                                                                                                '-subtle text-' .
                                                                                                $statusInfo[1] .
                                                                                                ' text-uppercase p-2">' .
                                                                                                $statusInfo[0] .
                                                                                                '</span>';
                                                                                        @endphp
                                                                                        <tr>
                                                                                            <td>
                                                                                                <a href="{{ route('order.detail', ['id' => $valueOrderRc->id]) }}"
                                                                                                    class="fw-medium link-primary">#{{ $valueOrderRc->code }}</a>
                                                                                            </td>
                                                                                            <td class="text-end">
                                                                                                {{ $valueOrderRc->total_items }}
                                                                                            </td>
                                                                                            <td class="text-end">
                                                                                                <span
                                                                                                    class="text-success">{{ number_format($valueOrderRc->total_amount, '0', '.', ',') }}đ</span>
                                                                                            </td>
                                                                                            <td class="text-end">
                                                                                                {!! $valueOrderRc->status !== 'canceled' ? $imagePayment : '---' !!}
                                                                                            </td>
                                                                                            <td class="text-end">
                                                                                                <span>{{ $date }}</span>
                                                                                            </td>
                                                                                            <td class="text-end">
                                                                                                {!! $statusBadge !!}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div class="order-null p-3">
                                                                                        <div
                                                                                            class="img-null text-center">
                                                                                            <img src="/libaries/upload/images/order-null.png"
                                                                                                alt=""
                                                                                                class=""
                                                                                                width="300"
                                                                                                height="200">
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex flex-col text-center align-items-center">
                                                                                            <h5
                                                                                                class="mb-2  fw-semibold">
                                                                                                Người dung hiện tại chưa
                                                                                                có hoạt động nào!
                                                                                            </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end card -->
                                                        </div><!-- end col -->
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <div class="tab-pane fade" id="activities" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">Tất cả hoạt động</h5>
                                                    <div class="card-body">
                                                        <div class="table-responsive table-card">
                                                            <table
                                                                class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                                @if (count($orderUserAllTimes) > 0)
                                                                <thead class="text-muted table-light">
                                                                    <tr>
                                                                        <th scope="col" width="130">Mã đơn hàng
                                                                        </th>
                                                                        <th scope="col" class="text-end">Sản phẩm
                                                                        </th>
                                                                        <th scope="col" class="text-end">Thành tiền
                                                                        </th>
                                                                        <th scope="col" class="text-end">Phương
                                                                            thức</th>
                                                                        <th scope="col" class="text-end">Thời gian
                                                                        </th>
                                                                        <th scope="col" class="text-end">Trạng thái
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                @endif
                                                                <tbody>
                                                                    @if ($orderUserAllTimes && count($orderUserAllTimes) > 0)
                                                                        @foreach ($orderUserAllTimes as $keyOrderAllTime => $valueOrderAllTime)
                                                                            @php
                                                                                $imagePayment = '';
                                                                                if (
                                                                                    $valueOrderAllTime->payment_method ==
                                                                                    'cod'
                                                                                ) {
                                                                                    $imagePayment =
                                                                                        '<i class="fa-solid fa-money-bill-wave fs-2 text-success"></i>';
                                                                                } elseif (
                                                                                    $valueOrderAllTime->payment_method ==
                                                                                    'vnpay'
                                                                                ) {
                                                                                    $imagePayment =
                                                                                        '<img src="/libaries/upload/images/vnpay-icon.svg" alt="" class="object-fit-contain" width="60" height="30">';
                                                                                } elseif (
                                                                                    $valueOrderAllTime->payment_method ==
                                                                                    'momo'
                                                                                ) {
                                                                                    $imagePayment =
                                                                                        '<img src="/libaries/upload/images/momo-icon.svg" alt="" class="object-fit-contain" width="35" height="30">';
                                                                                } elseif (
                                                                                    $valueOrderAllTime->payment_method ==
                                                                                    'paypal'
                                                                                ) {
                                                                                    $imagePayment =
                                                                                        '<img src="/libaries/upload/images/paypal-icon.jpg" alt="" class="object-fit-contain" width="45" height="40">';
                                                                                } else {
                                                                                    $imagePayment =
                                                                                        '<i class="fa-solid fa-spinner fa-spin-pulse fs-2"></i>';
                                                                                }
                                                                                //-- //
                                                                                $date = date(
                                                                                    'd-m-Y',
                                                                                    strtotime(
                                                                                        $valueOrderAllTime->created_at,
                                                                                    ),
                                                                                );
                                                                                //-- -//
                                                                                $statusMap = [
                                                                                    'pending' => [
                                                                                        'Chờ xác nhận',
                                                                                        'warning',
                                                                                    ],
                                                                                    'confirmed' => [
                                                                                        'Đã xác nhận',
                                                                                        'info',
                                                                                    ],
                                                                                    'shipping' => [
                                                                                        'Đang vận chuyển',
                                                                                        'secondary',
                                                                                    ],
                                                                                    'canceled' => [
                                                                                        'Đã hủy đơn',
                                                                                        'danger',
                                                                                    ],
                                                                                    'completed' => [
                                                                                        'Thành công',
                                                                                        'success',
                                                                                    ],
                                                                                ];
                                                                                $statusInfo = $statusMap[
                                                                                    $valueOrderAllTime->status
                                                                                ] ?? ['Không xác định', 'dark'];
                                                                                $statusBadge =
                                                                                    '<span class="badge bg-' .
                                                                                    $statusInfo[1] .
                                                                                    '-subtle text-' .
                                                                                    $statusInfo[1] .
                                                                                    ' text-uppercase p-2">' .
                                                                                    $statusInfo[0] .
                                                                                    '</span>';
                                                                            @endphp
                                                                            <tr>
                                                                                <td>
                                                                                    <a href="{{ route('order.detail', ['id' => $valueOrderAllTime->id]) }}"
                                                                                        class="fw-medium link-primary">#{{ $valueOrderAllTime->code }}</a>
                                                                                </td>
                                                                                <td class="text-end">
                                                                                    {{ $valueOrderAllTime->total_items }}
                                                                                </td>
                                                                                <td class="text-end">
                                                                                    <span
                                                                                        class="text-success">{{ number_format($valueOrderAllTime->total_amount, '0', '.', ',') }}đ</span>
                                                                                </td>
                                                                                <td class="text-end">
                                                                                    {!! $valueOrderAllTime->status !== 'canceled' ? $imagePayment : '---' !!}</td>
                                                                                <td class="text-end">
                                                                                    <span>{{ $date }}</span>
                                                                                </td>
                                                                                <td class="text-end">
                                                                                    {!! $statusBadge !!}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="order-null p-3">
                                                                            <div class="img-null text-center">
                                                                                <img src="/libaries/upload/images/order-null.png"
                                                                                    alt="" class=""
                                                                                    width="300" height="200">
                                                                            </div>
                                                                            <div
                                                                                class="flex flex-col text-center align-items-center">
                                                                                <h5 class="mb-2  fw-semibold">Người
                                                                                    dung hiện tại chưa có hoạt động nào!
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                            <div class="container-fluid mt-3">
                                                                {{ $orderUserAllTimes->onEachSide(3)->links('pagination::bootstrap-5') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end card-body-->
                                            </div>
                                            <!--end card-->
                                        </div>
                                    </div>
                                    <!--end tab-content-->
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                    </div><!-- container-fluid -->
                </div><!-- End Page-content -->

            </div>
        </div>
    </div>
</div>
