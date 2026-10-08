@extends('fontend.home.layout')
@section('page_title')
    Thanh toán thất bại
@endsection
@section('content')
    <section>
        <div class="row justify-content-md-center m-5">
            <div class="col-md-6">
                <div class="bg-white shadow-sm d-block justify-content-center">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <img src="/libaries/upload/images/icon-failed.png" alt="" width="80" height="80">
                        </div>
                        <h5 class="fz-16">Thanh toán thất bại!</h5>
                        <p class="text-muted fz-14">Đơn hàng của bạn chưa được thanh toán!</p>
                        <h3 class="fw-semibold fz-16">Mã đơn hàng: <a href="#"
                                class="text-decoration-underline text-muted">{{ ($order) ? $order->code : '' }}</a></h3>
                        <div class="d-flex justify-content-center align-items-center ">
                            <a href="{{ route('home.index') }}" class="btn btn-outline-danger rounded-1 fz-14 mt-2 me-2">Xem đơn hàng</a>
                        <a href="{{ route('shop.index') }}" class="btn btn-danger rounded-1 fz-14 mt-2">Tiếp tục mua hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </article>
    </section>
@endsection
