@extends('fontend.home.layout')
@section('page_title')
    Giỏ hàng
@endsection
@section('content')
<section>
    <article>
        <div class="container p-0 w-100">
            <!-- breadcrumb  -->
            <nav class="pt-3 pb-3" aria-label="breadcrumb">
                <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                    <li class="breadcrumb-item "><a href="{{ route('shop.index') }}" class="text-decoration-none text-muted">Cửa hàng</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                </ol>
            </nav>
            <!-- end breadcrumb  -->
            <div class="bg-cart position-relative z-2">
                <img src="/libaries/templates/bee-cloudy-user/libaries/images/cart_icon2.png" alt="" height="200" class="z-1 w-100 object-fit-contain position-absolute top-50 start-50 translate-middle">
            </div>
            <!-- content -->
            <div class="main-cart row flex-wrap text-muted pt-3 mx-0 mb-5">
                <!-- giỏ hàng rỗng  -->
                <!-- <div class="no-product text-center p-3">
                            <a href="#">
                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/image-add-to-cart.png" alt="" class="img-fluid object-fit-cover " width="200">
                                <div class="mt-1 text-white">
                                    <h6 class=" text-muted text-uppercase mb-2">Bạn chưa có sản phẩm nào!</h6>
                                    <a href="#" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Xem sản phẩm</a>
                                </div>
                            </a>
                        </div> -->
                <!-- có sản phẩm  -->
                <div class="col-lg-8 col-md-12 col-sm-12 mb-md-4 mb-sm-3 ps-0 rounded-1">
                    <div class="card-header bg-light shadow-sm border-0 mb-3">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0 p-3">Giỏ hàng</h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive bg-white shadow-sm p-2">
                        <table class="table align-middle table-hover h-100">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-center">Số Lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="card-body">
                                            <div class="row gy-3">
                                                <div class="col-sm-auto">
                                                    <div class="bg-light rounded p-1">
                                                        <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao_polo2.png" alt=""
                                                            width="90" height="90"
                                                            class="img-fluid d-block object-fit-cover me-2">
                                                    </div>
                                                </div>
                                                <div class="col-sm" style="width: 250px;">
                                                    <h5 class="fz-16 text-break">
                                                        <a href="#" class="text-muted">Áo polo nam sọc ngang
                                                            ngắn
                                                            tay thấm hút mát
                                                            mẻ thoải máy</a>
                                                    </h5>
                                                    <ul class="list-inline text-muted fz-14 mb-2">
                                                        <li class="list-inline-item">Màu : <span
                                                                class="fw-medium">Đen</span></li>
                                                        <li class="list-inline-item">Size : <span
                                                                class="fw-medium">M</span></li>
                                                    </ul>
                                                    <a href="#" class="d-block text-danger fz-14 ">
                                                        <i
                                                            class="fa-solid fa-trash text-danger align-bottom me-1 mb-1 "></i>
                                                        <span class="mt-1 align-middle"> Xóa</span>
                                                    </a>

                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-medium text-muted"> 259.000đ</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="input-group componant-quantity justify-content-center shadow-sm flex-grow"
                                                style="max-width: 120px;">
                                                <button class="quantity-minus w-md-100 rounded-3 " type="button"
                                                    id="button-addon1">
                                                    <i class='bx bx-minus fw-medium'></i>
                                                </button>
                                                <input type="text" name="quantity w-sm-25 "
                                                    class="form-control border-0 fz-20 text-center fw-600"
                                                    value="1" min="1" style="max-width: 60px;">
                                                <input type="hidden" name="quantity" value="">
                                                <button class="quantity-plus w-md-100 " type="button"
                                                    id="button-addon2">
                                                    <i class='bx bx-plus'></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-medium text-muted"> 259.000đ</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="card-body">
                                            <div class="row gy-3">
                                                <div class="col-sm-auto">
                                                    <div class="bg-light rounded p-1">
                                                        <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao_polo2.png" alt=""
                                                            width="90" height="90"
                                                            class="img-fluid d-block object-fit-cover me-2">
                                                    </div>
                                                </div>
                                                <div class="col-sm" style="width: 250px;">
                                                    <h5 class="fz-16 text-break">
                                                        <a href="#" class="text-muted">Áo polo nam sọc ngang
                                                            ngắn
                                                            tay thấm hút mát
                                                            mẻ thoải máy</a>
                                                    </h5>
                                                    <ul class="list-inline text-muted fz-14 mb-2">
                                                        <li class="list-inline-item">Màu : <span
                                                                class="fw-medium">Đen</span></li>
                                                        <li class="list-inline-item">Size : <span
                                                                class="fw-medium">M</span></li>
                                                    </ul>
                                                    <a href="#" class="d-block text-danger fz-14 ">

                                                        <i
                                                            class="fa-solid fa-trash text-danger align-bottom me-1 mb-1 "></i>
                                                        <span class="mt-1 align-middle"> Xóa</span>
                                                    </a>

                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-medium text-muted"> 259.000đ</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="input-group componant-quantity justify-content-center shadow-sm flex-grow"
                                                style="max-width: 120px;">
                                                <button class="quantity-minus w-md-100 rounded-3 " type="button"
                                                    id="button-addon1">
                                                    <i class='bx bx-minus fw-medium'></i>
                                                </button>
                                                <input type="text" name="quantity w-sm-25 "
                                                    class="form-control border-0 fz-20 text-center fw-600"
                                                    value="1" min="1" style="max-width: 60px;">
                                                <input type="hidden" name="quantity" value="">
                                                <button class="quantity-plus w-md-100 " type="button"
                                                    id="button-addon2">
                                                    <i class='bx bx-plus'></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-medium text-muted"> 259.000đ</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="card-body">
                                            <div class="row gy-3">
                                                <div class="col-sm-auto">
                                                    <div class="bg-light rounded p-1">
                                                        <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao_polo2.png" alt=""
                                                            width="90" height="90"
                                                            class="img-fluid d-block object-fit-cover me-2">
                                                    </div>
                                                </div>
                                                <div class="col-sm" style="width: 250px;">
                                                    <h5 class="fz-16 text-break">
                                                        <a href="#" class="text-muted">Áo polo nam sọc ngang
                                                            ngắn
                                                            tay thấm hút mát
                                                            mẻ thoải máy</a>
                                                    </h5>
                                                    <ul class="list-inline text-muted fz-14 mb-2">
                                                        <li class="list-inline-item">Màu : <span
                                                                class="fw-medium">Đen</span></li>
                                                        <li class="list-inline-item">Size : <span
                                                                class="fw-medium">M</span></li>
                                                    </ul>
                                                    <a href="#" class="d-block text-danger fz-14 ">
                                                        <i
                                                            class="fa-solid fa-trash text-danger align-bottom me-1 mb-1 "></i>
                                                        <span class="mt-1 align-middle"> Xóa</span>
                                                    </a>

                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-medium text-muted"> 259.000đ</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="input-group componant-quantity justify-content-center shadow-sm flex-grow"
                                                style="max-width: 120px;">
                                                <button class="quantity-minus w-md-100 rounded-3 " type="button"
                                                    id="button-addon1">
                                                    <i class='bx bx-minus fw-medium'></i>
                                                </button>
                                                <input type="text" name="quantity w-sm-25 "
                                                    class="form-control border-0 fz-20 text-center fw-600"
                                                    value="1" min="1" style="max-width: 60px;">
                                                <input type="hidden" name="quantity" value="">
                                                <button class="quantity-plus w-md-100 " type="button"
                                                    id="button-addon2">
                                                    <i class='bx bx-plus'></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-medium text-muted"> 259.000đ</span>
                                    </td>
                                </tr>
                            </tbody>


                        </table>
                        <div class="footer-cart d-flex justify-content-between align-items-center py-3">
                            <a href="#" class="back-to-product fz-14 text-muted ms-3">
                                <i class="fa-solid fa-chevron-left fz-3 me-2"></i>
                                <span>Xem sản phẩm</span>
                            </a>
                            <a href="#" class="back-to-product btn btn-outline-danger fz-14 rounded-1"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-trash-alt fz-3 me-2"></i>
                                <span>Xóa giỏ hàng</span>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa toàn bộ
                                                sản phẩm
                                                trong giỏ hàng</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class=" fz-16">Bạn có chắc chắn muốn xóa hết sản phẩm trong
                                                giỏ hàng
                                                hay không?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light rounded-1"
                                                data-bs-dismiss="modal">Hủy</button>
                                            <button type="button" class="btn btn-danger rounded-1">Xác nhận
                                                xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 pe-0 ps-3">
                    <div class="card border-0 rounded-2 shadow-sm">
                        <div class="card-header border-0 py-3">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Đơn hàng</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless align-middle mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="p-0">
                                                <div class="avatar-md bg-light rounded p-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao_polo2.png" alt=""
                                                        width="90" height="90"
                                                        class="img-fluid d-block object-fit-cover me-2">
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fz-14 text-break">
                                                    <a href="#" class="text-body">Áo polo nam sọc ngang ngắn
                                                        tay thấm hút mát
                                                        mẻ thoải máy</a>
                                                </h5>
                                                <p class="text-muted mb-0 fz-14">259.000đ <strong
                                                        class="text-info">x2</strong></p>
                                            </td>
                                            <td class="text-end fz-14 fw-medium ">518.000đ</td>
                                        </tr>
                                        <tr>
                                            <td class="p-0">
                                                <div class="avatar-md bg-light rounded p-1">
                                                    <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao_polo2.png" alt=""
                                                        width="90" height="90"
                                                        class="img-fluid d-block object-fit-cover me-2">
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fz-14 text-break">
                                                    <a href="#" class="text-body">Áo polo nam sọc ngang ngắn
                                                        tay thấm hút mát
                                                        mẻ thoải máy</a>
                                                </h5>
                                                <p class="text-muted mb-0 fz-14">259.000đ <strong
                                                        class="text-info">x2</strong></p>
                                            </td>
                                            <td class="text-end fz-14 fw-medium ">518.000đ</td>
                                        </tr>
                                        <tr style="height: 10px;">
                                            <td colspan="3">
                                                <hr>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="3">
                                                <div class="bg-light-subtle border-success-subtle p-0"></div>
                                                <div class="text-start">
                                                    <h6 class="mb-2">Bạn có voucher khuyến mãi?</h6>
                                                </div>
                                                <div class="hstack gap-2">
                                                    <input class="form-control me-auto" type="text"
                                                        placeholder="Nhập mã voucher">
                                                    <button type="button"
                                                        class="btn btn-success fw-500 w-25 rounded-1">Áp
                                                        mã</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="height: 50px;">
                                            <td class="fz-16" colspan="2">Thành tiền:</td>
                                            <td class="fw-semibold text-end">2.000.000đ</td>
                                        </tr>
                                        <tr style="height: 50px;">
                                            <td class="fz-16" colspan="2">Giảm giá:
                                            </td>
                                            <td class="fw-semibold text-end">- 100.000đ</td>
                                        </tr>
                                        <tr style="height: 60px;">
                                            <td class="fz-16" colspan="2">Phí vận chuyển:</td>
                                            <td class="fw-semibold text-end">16.500đ</td>
                                        </tr>

                                        <tr class="" style="height: 50px;">
                                            <th colspan="2">Tổng tiền:</th>
                                            <td class="text-end">
                                                <span class="fw-semibold">
                                                    1.000.000đ
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="" style="height: 50px;">
                                            <td colspan="3">
                                                <a href="#"
                                                    class="btn fw-semibold btn-success w-100 text-uppercase fz-14">Tiến
                                                    hành thanh toán</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="border-2">
            <!-- product similar  -->
            <div class="product-similar mb-3 text-muted">
                <div class="title-product mt-4 mb-3">
                    <h5 class="fs-4 fw-500 mb-3 text-uppercase">
                        sản phẩm mới
                        <hr class=" border-4 border-info mb-2" style="width: 160px;">
                    </h5>
                </div>
                <div class="row flex-wrap">
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="card card-product shadow-sm border-0">
                            <div class="head-card d-flex p-2">
                                <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                    data-bs-title="Thêm vào yêu thích">
                                    <i class="fa-regular fa-bookmark fz-16"></i>
                                </span>
                            </div>
                            <div class="image-main-product position-relative">
                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%"
                                    height="250" class="img-fluid">
                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                    <div class="hstack gap-3">
                                        <div class="p-2">
                                            <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                nam</span>
                                        </div>
                                        <div class="p-2 ms-auto">
                                            <div class="product-image-color">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <h6 class="fw-medium">
                                    <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                        Vải Pique
                                        Ngắn Tay
                                        mát mẻ, thoải mái</a>
                                </h6>
                                <div class="d-flex justify-content-start mb-2">
                                    <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                    <span class="mt-1">
                                        <del class="text-secondary fz-14 ">559.000đ</del>
                                    </span>
                                </div>
                                <div class="box-action">
                                    <a href="#" class="action-cart-item-buy">
                                        <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                        <span>Mua ngay</span>
                                    </a>
                                    <a href="#" class="action-cart-item-add">
                                        <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                        <span>thêm giỏ hàng</span>

                                    </a>
                                </div>
                                <div class="head-card d-flex p-0">
                                    <span class="fz-14 ">
                                        <div class="rating">
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                        </div>
                                    </span>
                                    <span class="ms-auto fz-14">25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="card card-product shadow-sm border-0">
                            <div class="head-card d-flex p-2">
                                <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                    data-bs-title="Thêm vào yêu thích">
                                    <i class="fa-regular fa-bookmark fz-16"></i>
                                </span>
                            </div>
                            <div class="image-main-product position-relative">
                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%"
                                    height="250" class="img-fluid">
                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                    <div class="hstack gap-3">
                                        <div class="p-2">
                                            <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                nam</span>
                                        </div>
                                        <div class="p-2 ms-auto">
                                            <div class="product-image-color">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <h6 class="fw-medium">
                                    <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                        Vải Pique
                                        Ngắn Tay
                                        mát mẻ, thoải mái</a>
                                </h6>
                                <div class="d-flex justify-content-start mb-2">
                                    <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                    <span class="mt-1">
                                        <del class="text-secondary fz-14 ">559.000đ</del>
                                    </span>
                                </div>
                                <div class="box-action">
                                    <a href="#" class="action-cart-item-buy">
                                        <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                        <span>Mua ngay</span>
                                    </a>
                                    <a href="#" class="action-cart-item-add">
                                        <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                        <span>thêm giỏ hàng</span>

                                    </a>
                                </div>
                                <div class="head-card d-flex p-0">
                                    <span class="fz-14 ">
                                        <div class="rating">
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                        </div>
                                    </span>
                                    <span class="ms-auto fz-14">25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="card card-product shadow-sm border-0">
                            <div class="head-card d-flex p-2">
                                <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                    data-bs-title="Thêm vào yêu thích">
                                    <i class="fa-regular fa-bookmark fz-16"></i>
                                </span>
                            </div>
                            <div class="image-main-product position-relative">
                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%"
                                    height="250" class="img-fluid">
                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                    <div class="hstack gap-3">
                                        <div class="p-2">
                                            <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                nam</span>
                                        </div>
                                        <div class="p-2 ms-auto">
                                            <div class="product-image-color">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <h6 class="fw-medium">
                                    <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                        Vải Pique
                                        Ngắn Tay
                                        mát mẻ, thoải mái</a>
                                </h6>
                                <div class="d-flex justify-content-start mb-2">
                                    <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                    <span class="mt-1">
                                        <del class="text-secondary fz-14 ">559.000đ</del>
                                    </span>
                                </div>
                                <div class="box-action">
                                    <a href="#" class="action-cart-item-buy">
                                        <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                        <span>Mua ngay</span>
                                    </a>
                                    <a href="#" class="action-cart-item-add">
                                        <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                        <span>thêm giỏ hàng</span>

                                    </a>
                                </div>
                                <div class="head-card d-flex p-0">
                                    <span class="fz-14 ">
                                        <div class="rating">
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                        </div>
                                    </span>
                                    <span class="ms-auto fz-14">25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="card card-product shadow-sm border-0">
                            <div class="head-card d-flex p-2">
                                <span class="text-bg-danger rounded-end ps-2 pe-2 pt-1 fz-10">12%</span>
                                <span class="ms-auto text-muted" data-bs-toggle="tooltip"
                                    data-bs-title="Thêm vào yêu thích">
                                    <i class="fa-regular fa-bookmark fz-16"></i>
                                </span>
                            </div>
                            <div class="image-main-product position-relative">
                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/ao1.jpg" alt="product image" width="100%"
                                    height="250" class="img-fluid">
                                <div class="news-product-detail position-absolute bottom-0 start-0 w-100">
                                    <div class="hstack gap-3">
                                        <div class="p-2">
                                            <span class="fz-14 text-uppercase text-dark fw-600">Áo thun
                                                nam</span>
                                        </div>
                                        <div class="p-2 ms-auto">
                                            <div class="product-image-color">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/blue.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/yellow.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/green.png" alt="image color product"
                                                    width="14" height="14"
                                                    class="rounded-circle img-fluid me-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <h6 class="fw-medium">
                                    <a href="#" class="text-break w-100 text-muted">AIRism Cotton Áo Polo
                                        Vải Pique
                                        Ngắn Tay
                                        mát mẻ, thoải mái</a>
                                </h6>
                                <div class="d-flex justify-content-start mb-2">
                                    <span class="text-danger fz-20 fw-medium me-3">259.000đ </span>
                                    <span class="mt-1">
                                        <del class="text-secondary fz-14 ">559.000đ</del>
                                    </span>
                                </div>
                                <div class="box-action">
                                    <a href="#" class="action-cart-item-buy">
                                        <i class="fa-solid fa-cart-shopping fz-18 me-2"></i>
                                        <span>Mua ngay</span>
                                    </a>
                                    <a href="#" class="action-cart-item-add">
                                        <i class="fa-solid fa-cart-plus fz-18 me-2"></i>
                                        <span>thêm giỏ hàng</span>

                                    </a>
                                </div>
                                <div class="head-card d-flex p-0">
                                    <span class="fz-14 ">
                                        <div class="rating">
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                        </div>
                                    </span>
                                    <span class="ms-auto fz-14">25</span>
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
