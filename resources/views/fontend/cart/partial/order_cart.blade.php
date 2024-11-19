@if (!is_null($order) && count($order) > 0)
    @php
        $total = 0;
    @endphp
    @foreach ($order as $cartItem)
        <tr class="cart-item" data-destroy-id="{{ $cartItem->id }}">
            <td class="p-0">
                <div class="avatar-md bg-light rounded p-1">
                    @if ($cartItem->productVariants)
                        <img src="{{ explode(',', $cartItem->productVariants->album)[0] }}" alt="" width="60"
                            height="60" class="object-fit-cover">
                    @elseif ($cartItem->products)
                        <img src="{{ $cartItem->products->image }}" alt="" width="60" height="60"
                            class="object-fit-cover">
                    @else
                        <img src="/libaries/upload/libaries/images/img-notfound.png" alt="Product Image" width="60"
                            height="60" class="object-fit-cover rounded-2">
                    @endif
                </div>
            </td>
            <td>
                <h5 class="fz-14 text-start text-truncate mb-0" style="width: 200px">
                    <a href="#" class="text-body">
                        @if ($cartItem->productVariants)
                            {{ $cartItem->productVariants->name }}
                        @else
                            {{ $cartItem->products->name }}
                        @endif
                    </a>
                    <ul class="list-inline text-muted fz-12 my-1">
                        @if (isset($attributesByCartItem[$cartItem->id]))
                            @foreach ($attributesByCartItem[$cartItem->id] as $attribute)
                                <li class="list-inline-item">
                                    {{ $attribute->name }}
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </h5>
                <p class="text-muted text-start mb-0 fz-14">
                    <span class="orderPrice">{{ number_format($cartItem->price, 0, ',', '.') }}đ</span>
                    <strong class="text-info orderQuantity">x{{ $cartItem->quantity }}</strong>
                </p>
            </td>
            <td class="text-end fz-14 fw-medium totalPriceOrder">
                {{ number_format($cartItem->price * $cartItem->quantity, 0, ',', '.') }}đ
            </td>
        </tr>
        @php
            $total += $cartItem->price * $cartItem->quantity;
        @endphp
    @endforeach
@endif
<tr style="height: 10px;">
    <td colspan="3">
        <hr>
    </td>
</tr>

<tr>
    <td colspan="3">
        <div class="bg-light-subtle border-success-subtle p-0">
            <div class="text-start">
                <h6 class="mb-2 pb-2">Bạn có voucher khuyến mãi?</h6>

            </div>
            <div class="">
                <form action="{{ route('cart.applyDiscount') }}" method="POST" class="d-flex">
                    @csrf
                    <div class="input-group mb-0">
                        <input type="text" class="form-control" placeholder="Nhập mã voucher" name="promotion_code"
                            data-bs-toggle="tooltip" data-bs-title="Áp dụng tối đa 2 mã cho mỗi đơn hàng">
                        <button type="submit" class="fz-14 btn btn-success col-3 fw-medium">Sử
                            dụng</button>
                    </div>
                </form>
            </div>
        </div>
    </td>
</tr>
@if (session()->has('promotions'))
    <tr style="height: 37px">
        <td colspan="3">
            <span class="fw-medium">Mã giảm giá đã áp dụng:</span>
        </td>
    </tr>
    @foreach (session('promotions') as $promotion)
        <tr style="height: 37px">
            <td colspan="2" class="">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-ticket text-success me-2"></i>
                    <span class="text-success fw-medium text-truncate">
                        {{ $promotion['code'] }}
                    </span>
                </div>
            </td>
            <td class="text-end">
                <form action="{{ route('cart.removeVoucher', $promotion['code']) }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm border-0" data-bs-toggle="tooltip"
                        data-bs-title="Xóa mã giảm giá {{ $promotion['code'] }}">
                        <i class="fa fa-trash me-1"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    <tr style="height: 10px">
        <td colspan="3">
            <hr>
        </td>
    </tr>
@endif
<tr style="height: 50px;">
    <td class=" text-start fz-16" colspan="2">Thành tiền:</td>
    <td class="fw-semibold text-end" id="cart-price">
        {{ number_format($total, 0, ',', '.') }}đ
    </td>
</tr>
<tr style="height: 50px;">
    <td class=" text-start fz-16" colspan="2">Giảm giá:</td>
    <td class="fw-semibold text-end text-danger" id="discount-amount">
        @if (session()->has('total_discount'))
            {{ '- ' . number_format(session('total_discount'), 0, ',', '.') }}đ
        @else
            0đ
        @endif
    </td>
</tr>
<tr style="height: 60px;">
    <td class=" text-start fz-16" colspan="2">Phí vận chuyển:</td>
    <td class="fw-semibold text-end" id="shopping_fee">
        @if (session()->has('shipping_fee') && session('shipping_fee') == 0)
            <span class="text-success">Miễn phí</span>
        @else
            25.000đ
        @endif
    </td>
</tr>

<tr class="" style="height: 50px;">
    <th colspan="2">Tổng tiền:</th>
    <td class="text-end">
        <span class="fw-semibold" id="cart-total-price">
            @php
                $totalPrice = $total;
                $shippingFee = session()->has('shipping_fee') ? session('shipping_fee') : 25000;
                $totalPriceWithShipping = $totalPrice + $shippingFee;
                // Áp dụng tổng số tiền giảm giá từ tất cả mã đã áp dụng
                $totalDiscount = session()->get('total_discount', 0);
                $totalPriceWithShipping -= $totalDiscount;
            @endphp
            {{ number_format($totalPriceWithShipping, 0, ',', '.') . 'đ' }}
        </span>
    </td>
</tr>
<tr class="" style="height: 50px;">
    <td colspan="3">
        <a href="{{ route('order.checkout') }}" class="btn fw-semibold btn-success w-100 text-uppercase fz-14">Tiến
            hành thanh toán</a>
    </td>
</tr>
