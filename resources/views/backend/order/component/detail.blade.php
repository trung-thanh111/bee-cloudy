<div class="container py-2 mx-2">
    <div class="row mb-2">
        <div class="col-12">
            <h4 class="mb-2">Đơn hàng #{{ $order->code }}</h4>
            <hr class="border-3 text-danger my-3">
        </div>
    </div>
    {{-- modal canceled  --}}
    <!-- Modal HTML -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận hủy đơn </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('order.process_cancele', ['id' => $order->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <h6 class="mb-3">
                            Mã đơn hàng <strong>#{{ $order->code }}</strong>
                        </h6>
                        <div class="mb-3">
                            <label class="form-label mb-2">Lý do hủy đơn hàng từ người bán.</label>
                            <select class="form-select" id="lyDoHuy" name="cancellation_reason" required>
                                <option value="" disabled selected>[ Chọn lý do hủy đơn ]</option>
                                <option value="Hết hàng">Sản phẩm đã hết hàng</option>
                                <option value="Lỗi giá">Nhầm giá hoặc chương trình khuyến mãi</option>
                                <option value="Khách hàng không còn nhu cầu">Khách hàng không còn nhu cầu</option>
                                <option class="optionlydokhac" value="">Lý do khác</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none" id="lydokhac">
                            <label for="lydokhac" class="form-label">
                                <i class="fas fa-comment-dots me-2"></i>Nhập lý do khác
                            </label>
                            <textarea class="form-control content_lydokhac" id="lydokhac" rows="3" placeholder="Vui lòng nhập lý do cụ thể"></textarea>
                        </div>
                        {{-- hủy bởi admin  --}}
                        <input type="hidden" name="canceled_by" value="admin">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger" id="confirmCancel">Xác nhận hủy</button>
                        {{-- confirmCancel --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- {{ ($order->status == 'pending' || $order->status == 'confirmed') ? '' : 'd-none' }} --}}
    <div class="row mb-4 mx-0 ">
        <div class="col-12 bg-light shadow-sm p-2 ">
            @if ($order->status == 'pending')
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle-info text-secondary fs-2 me-3"></i>
                        <div>
                            <h5>Đang chờ xác nhận đơn hàng!</h5>
                            <p class=" mb-0">Nếu bạn quá thời gian hệ thống sẽ tự động xác nhận đơn hàng.</p>
                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-secondary p-2 rounded-2 fz-12 fw-medium updateStatus"
                            data-status="confirmed">Xác nhận</button>
                    </div>
                </div>
            @elseif($order->status == 'confirmed')
                {{-- comfirmed  --}}
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle-check text-success fs-2 me-3"></i>
                        <div>
                            <h5>Đơn hàng đã xác nhận!</h5>
                            <p class=" mb-0">Hãy chuẩn bị hàng giao đến khách hàng.</p>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary py-2 px-4 rounded-2 fz-12 fw-medium dropdown-toggle"
                            type="button" data-bs-toggle="dropdown">
                            Chuyển trạng thái
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button type="submit" class="dropdown-item updateStatus btn btn-info"
                                    data-status="shipping">Đang vận chuyển</button>
                            </li>
                            <li>
                                <button class="dropdown-item updateStatus btn btn-danger updatePaidAt"
                                data-status="canceled" data-payment="failed">Hủy đơn</button>
                            </li>
                        </ul>
                    </div>
                </div>
            @elseif($order->status == 'canceled')
                {{-- canceled  --}}
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle-xmark text-danger fs-2 me-3"></i>
                        <div>
                            <h5>Đơn hàng đã bị hủy bởi {{ $order->canceled_by == 'admin' ? 'người bán' : 'khách hàng' }}!</h5>
                            <p class=" mb-0">Đơn hàng sẽ không được vận chuyển.</p>
                        </div>
                    </div>
                    <div>
                        <span class="disabled text-danger">Đơn hàng đã hủy</span>
                    </div>
                </div>
            @elseif($order->status == 'shipping')
                {{-- shipping  --}}

                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-truck-fast text-secondary  fs-2 me-3"></i>
                        <div>
                            <h5>Đơn hàng đang trên đường giao!</h5>
                            <p class="mb-0">Đơn hàng sẽ được vận chuyển đến khách hàng sớm nhất.</p>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary py-2 px-4 rounded-2 fz-12 fw-medium dropdown-toggle"
                            type="button" data-bs-toggle="dropdown">
                            Chuyển trạng thái
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="btn dropdown-item updateStatus btn btn-info updatePaidAt"
                                    data-status="completed" data-payment="paid">Đã nhận và thanh toán</button>
                            </li>
                            <li>
                                <button class="dropdown-item updateStatus btn btn-danger updatePaidAt"
                                    data-status="canceled" data-payment="failed">Không nhận hàng</button>
                            </li>
                        </ul>
                    </div>
                </div>
            @elseif($order->status == 'completed')
                {{-- canceled  --}}
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="/libaries/upload/images/poper-icon.png" alt="" width="40" class="me-2">
                        <div>
                            <h5>Đơn hàng đã giao thành công!</h5>
                            <p class=" mb-0">Hãy chờ đánh giá từ khách hàng.</p>
                        </div>
                    </div>
                    <div>
                        <span class="disabled text-success">Thành công</span>

                    </div>
                </div>
            @endif

        </div>
    </div>

    @php
        $date = date('H:i:sa d-m-Y', strtotime($order->created_at));
        // -- //
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
        // --//
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
                        class="btn btn-danger d-flex align-items-center gap-2 py-1 px-2 fz-9 fw-bold text-uppercase">
                        <i class="fas fa-times-circle"></i>
                        Thất bại 
                    </button>
                </div>';
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
        $total = 0;
    @endphp

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card bg-white shadow-sm h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">Thông tin khách hàng</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 lh-lg">
                        <li class="mb-2"><strong>Tên khách hàng:</strong> {{ $order->full_name }}</li>
                        <li class="mb-2"><strong>Số điện thoại:</strong> {{ $order->phone }}</li>
                        <li class="mb-2"><strong>Email:</strong> {{ $order->email }}</li>
                        <li><strong>Địa chỉ:</strong> {{ $order->address }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Thông tin đơn hàng -->
        <div class="col-md-6">
            <div class="card bg-white shadow-sm h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">Thông tin đơn hàng</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><strong>Mã đơn hàng:</strong> #{{ $order->code }}</li>
                        <li class="mb-2"><strong>Ngày đặt:</strong> {{ $date }}</li>
                        <li class="mb-2"><strong>Phương thức thanh toán:</strong> {!! $order->status !== 'canceled' ? $imagePayment : '---' !!}</li>
                        <li class="mb-2 d-flex align-items-center"><strong class="me-2">Trạng thái thanh
                                toán:</strong>{!! $order->status !== 'canceled' ? $statusPayment : '---' !!}</li>
                        <li class="fz-12"><strong>Trạng thái:</strong> {!! $statusBadge !!}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Chi tiết sản phẩm -->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light mb-3">
                    <h5 class="card-title  mb-0">Sản phẩm</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="text-bg-success fz-14">
                                <tr>
                                    <th scope="col" style="width: 60px">STT</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col" class="text-center">Số lượng</th>
                                    <th scope="col" class="text-end">Đơn giá</th>
                                    <th scope="col" class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!is_null($order))
                                    @foreach ($order->orderItems as $key => $val)
                                        @php
                                            $moneyCheckout = $val->final_quantity * $val->final_price;
                                            $total += $moneyCheckout;
                                        @endphp
                                        <tr class="align-middle">
                                            <td scope="col" class="text-center">{{ $key + 1 }}</td>
                                            <td style="max-width: 450px" class="align-middle">
                                                @if ($val->productVariants)
                                                    <img src="{{ explode(',', $val->productVariants->album)[0] }}"
                                                        alt="Image" width="80" height="80"
                                                        class="rounded-2 me-2 bg-light p-2">
                                                @elseif ($val->products)
                                                    <img src="{{ $val->products->image }}" alt="Product Image"
                                                        width="80" height="70"
                                                        class="rounded-2 me-2 bg-light">
                                                @else
                                                    <img src="{{ $BASE_URL }}/libaries/upload/libaries/images/img-notfound.png"
                                                        alt="Product Image" width="80" height="70"
                                                        class="rounded-2 me-2 bg-light">
                                                @endif

                                                <span class="d-inline-block text-truncate fw-medium fz-14"
                                                    style="max-width: 560px;">
                                                    {{ $val->product_name }}
                                                    <span>
                                                        <ul class="list-inline text-muted fz-12 my-1">
                                                            @if (isset($attributesByOderItem[$val->id]))
                                                                @foreach ($attributesByOderItem[$val->id] as $attribute)
                                                                    <li class="list-inline-item">
                                                                        {{ $attribute->name }}
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $val->final_quantity }}</td>
                                            <td class="text-end">
                                                {{ number_format($val->final_price, '0', ',', '.') }}đ
                                            </td>
                                            <td class="text-end">
                                                <strong>{{ number_format($moneyCheckout, '0', ',', '.') }}đ</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr class="text-end bg-light">
                                    <td colspan="4" class="text-start"><strong>Tổng tiền:</strong></td>
                                    <td><strong>{{ number_format($order->total_amount, '0', ',', '.') }}đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light d-flex justify-content-between">
                    <h5 class="card-title mb-0">Ghi chú đơn hàng</h5>
                    <span class="edit-note text-primary fz-14 cursor-pointer" data-target="note"
                        for="inputNode">Sửa</span>
                </div>
                <div class="card-body">
                    <p class="mb-0 content-note">{{ $order->note }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="order_id" class="orderId" value="{{ $order->id }}">
<script>
    let orderUpdatePaiAt = @json($order);
</script>