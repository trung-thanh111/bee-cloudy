
<div class="container">
    <h1 class="mb-4">Chi tiết khuyến mãi: {{ $promotion->name }}</h1>

    <!-- Thông tin chung của khuyến mãi -->
    <div class="card mb-4">
        <div class="card-header">
            Thông tin khuyến mãi
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Tên khuyến mãi</th>
                    <td>{{ $promotion->name }}</td>
                </tr>
                <tr>
                    <th>Ngày bắt đầu</th>
                    <td>{{ $promotion->start_date }}</td>
                </tr>
                <tr>
                    <th>Ngày kết thúc</th>
                    <td>{{ $promotion->end_date }}</td>
                </tr>
                <tr>
                    <th>Giá trị giảm giá</th>
                    <td>{{ $promotion->discount_value }}%</td>
                </tr>
                <tr>
                    <th>Số lượng</th>
                    <td>{{ $promotion->usage_limit }}</td>
                </tr>
                <tr>
                    <th>Trạng thái</th>
                    <td>{{ $promotion->status }}</td>
                </tr>
                
            </table>
        </div>
    </div>

    <!-- Danh sách sản phẩm áp dụng khuyến mãi -->
    <div class="card mb-4">
        <div class="card-header">
            Sản phẩm áp dụng khuyến mãi
        </div>
        <div class="card-body">
            @if($promotion->products->isEmpty())
                <p>Không có sản phẩm nào áp dụng cho khuyến mãi này.</p>
            @else
                <ul>
                    @foreach($promotion->products as $product)
                        <li>{{ $product->name }} - Giá: {{ $product->price }} VNĐ</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>