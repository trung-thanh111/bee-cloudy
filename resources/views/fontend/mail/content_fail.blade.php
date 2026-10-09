<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content_fail="width=device-width, initial-scale=1.0">
    <title>Đơn hàng đã bị hủy!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #353434 !important;
        }

        .container {
            background-color: #f8f8f8;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #ffffff;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }

        thead {
            background-color: #16b4a0;
            color: white;
        }

        tfoot {
            font-weight: bold;
            background-color: #ecf0f1;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-info img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 4px;
        }

        .product-details span {
            display: block;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-variant {
            font-size: 0.9em;
            color: #7f8c8d;
        }

        .text-right {
            text-align: right;
        }

        .customer-info {
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 4px;
        }

        .customer-info p {
            margin: 10px 0;
        }

        .customer-info {
            display: flex;
            justify-content_fail: space-between;
            /* Điều chỉnh chiều rộng */
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .column {
            width: 48%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .thanks {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="thanks">
            <div style="text-align: center;">
                <img src="https://cdn-icons-png.flaticon.com/512/5268/5268671.png" alt=""
                    width="80" height="80" style="border-radius: 50%; object-fit: cover;">
            </div>
            <h2 style="text-align: center; margin-bottom: 50px;">Đơn hàng đã bị hủy!</h2>
            <h3>Mã đơn hàng: {{ $content_fail['order']->code }}</h3>
            <p style="font-size: 18px; font-weight: bold; color: #e95b5b" >Do một số lý do {{ ($content_fail['order']->canceled_by === 'admin' ? 'người bán'  : 'bạn') }} đã hủy đơn!</p>
            <p style="font-size: 14px; line-height: 1.5rem;">
                Lý do: {{ $content_fail['order']->cancellation_reason }}
            </p>
        </div>
        <h3>Chi tiết đơn hàng</h3>
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th class="text-right">Số lượng</th>
                    <th class="text-right">Giá</th>
                    <th class="text-right">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @if (!is_null($content_fail['order']))
                    @foreach ($content_fail['order']->orderItems as $key => $val)
                        @php
                            $moneyCheckout = $val->final_quantity * $val->final_price;
                            $BASE_URL = config('app.url');
                        @endphp

                        <tr>
                            <td style="width: 60%">
                                <div class="product-info">
                                    <div class="product-details">
                                        <span class="product-name">{{ $val->product_name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right">{{ $val->final_quantity }}</td>
                            <td class="text-right">{{ number_format($val->final_price, '0', ',', '.') }}đ</td>
                            <td class="text-right">{{ number_format($moneyCheckout, '0', ',', '.') }}đ</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <h3>Thông tin nhận hàng</h3>
        <div class="customer-info w-100">
            <div class="column text-start w-100">
                <p><strong>Họ tên:</strong></p>
                <p><strong>Email:</strong></p>
                <p><strong>Số điện thoại:</strong></p>
                <p><strong>Địa chỉ:</strong></p>
                <p><strong>Tổng tiền đơn hàng:</strong></p>
                <p><strong>Phương thức thanh toán:</strong></p>
            </div>
            <div class="column text-end w-100">
                <p>{{ $content_fail['order']->full_name }}</p>
                <p>{{ $content_fail['order']->email }}</p>
                <p>{{ $content_fail['order']->phone }}</p>
                <p class="text-truncate">{{ $content_fail['order']->address }}</p>
                <p><strong>--</strong></p>
                <p> -- </p>
            </div>
        </div>
    </div>
</body>

</html>

</html>
