<div class="table-responsive table-card mt-3 mb-1">
    <table class="table align-middle table-nowrap" id="customerTable">
        <thead class="table-light">
            <tr>
                <th scope="row">
                    <div class="form-check">
                        <input class="form-check-input checkbox-item" type="checkbox" name="checkbox-item[]" value="">
                    </div>
                </th>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th class="text-end">Ngày mua</th>
                <th class="text-end">Sản phẩm</th>
                <th class="text-end">Giá trị</th>
                <th class="text-end">Phương thức</th>
                <th class="text-end">Thanh toán</th>
                <th class="text-end" style="width: 130px">Trạng thái</th>
                <th class="text-end" style="width: 90px">Thao tác</th>
            </tr>
        </thead>
        <tbody class="list form-check-all">
            @if (!is_null($orders))
                @foreach ($orders as $key => $order)
                    @php
                        $imagePayment = '';
                        if ($order->payment_method == 'cod') {
                            $imagePayment = '<i class="fa-solid fa-money-bill-wave fs-2 text-success"></i>';
                        } elseif ($order->payment_method == 'vnpay') {
                            $imagePayment =
                                '<img src="/libaries/upload/images/vnpay-icon.svg" alt="" class="object-fit-contain" width="60" height="30">';
                        } elseif ($order->payment_method == 'momo') {
                            $imagePayment =
                                '<img src="/libaries/upload/images/momo-icon.svg" alt="" class="object-fit-contain" width="35" height="30">';
                        } elseif ($order->payment_method == 'paypal') {
                            $imagePayment =
                                '<img src="/libaries/upload/images/paypal-icon.jpg" alt="" class="object-fit-contain" width="45" height="40">';
                        } else {
                            $imagePayment = '<i class="fa-solid fa-spinner fa-spin-pulse fs-2"></i>';
                        }
                        // -- //
                        $statusMap = [
                            'pending' => ['Chờ xác nhận', 'warning'],
                            'confirmed' => ['Đã xác nhận', 'info'],
                            'shipping' => ['Đang vận chuyển', 'secondary'],
                            'canceled' => ['Đã hủy đơn', 'danger'],
                            'completed' => ['Thành công', 'success'],
                        ];
                        $statusInfo = $statusMap[$order->status] ?? ['Không xác định', 'dark'];
                        $statusBadge =
                            '<span class="badge bg-' .
                            $statusInfo[1] .
                            '-subtle text-' .
                            $statusInfo[1] .
                            ' text-uppercase p-2">' .
                            $statusInfo[0] .
                            '</span>';
                        // -- //
                        $date = date('d-m-Y', strtotime($order->created_at));
                        // -- //
                        $statusPayment = '';
                        if ($order->payment == 'unpaid') {
                            $statusPayment = '
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-warning d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                    <i class="fa-solid fa-circle-info"></i>
                                    Chưa trả
                                </button>
                            </div>';
                        } elseif ($order->payment == 'paid') {
                            $statusPayment = '
                            <div class="d-flex justify-content-end">
                                <button
                                    class="btn btn-success d-flex align-items-center  gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                    <i class="fas fa-check-circle"></i>
                                    Đã trả
                                </button>
                            </div>';
                        } elseif ($order->payment == 'failed') {
                            $statusPayment = '
                            <div class="d-flex justify-content-end">
                                <button
                                    class="btn btn-danger d-flex align-items-center  gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                                    <i class="fas fa-times-circle"></i>
                                    Thất bại
                                </button>
                            </div>';
                        }
                    @endphp
                    <tr>
                        <th scope="col" style="width: 50px;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check-boxitem">
                            </div>
                        </th>
                        <th class="">
                            <a href="{{ route('order.detail', ['id' => $order->id]) }}"
                                class="text-secondary">#{{ $order->code }}</a>
                            </th>
                        <td class="">
                            <div>
                                <span class="fz-14"><strong>{{ $order->full_name }}</strong></span>
                            </div>
                        </td>
                        <td class="text-end">{{ $date }}</td>
                        <td class="text-end">{{ $order->total_items }}</td>
                        <td class="text-end fw-medium text-danger">
                            {{ number_format($order->total_amount, '0', ',', '.') }}đ</td>
                        <td class="text-end">{!! ($order->status !== 'canceled') ? $imagePayment : '---' !!}</td>
                        <td class="text-end">{!! ($order->status !== 'canceled') ? $statusPayment : '---' !!}</td>
                        <td class="text-end fz-12">{!! $statusBadge !!}</td>
                        <td>
                            <div class="dropdown text-end">
                                <a href="#" role="button" id="dropdownMenu{{ $order->id }}"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $order->id }}">
                                    <li>
                                        <a class="dropdown-item text-primary"
                                            href="{{ route('order.detail', ['id' => $order->id]) }}">
                                            <i class="ri-eye-line align-middle"></i>Xem
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
{{-- pagination  --}}
<div class="container-fluid">
    {{ $orders->onEachSide(3)->links('pagination::bootstrap-5') }}
</div>
