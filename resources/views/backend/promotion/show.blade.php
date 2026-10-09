
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                            <h4 class="mb-sm-0">Chi tiết Voucher</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('promotions.index') }}">Danh sách</a></li>
                                    <li class="breadcrumb-item active">Chi tiết</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-medium fz-16">Voucher: </span>
                                <h4 class="fs-5 mt-2 fst-italic">{{ $promotion->name }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                
            
                <!-- Thông tin chung của khuyến mãi -->
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        Thông tin khuyến mãi
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Mã code</th>
                                <td class="fw-bold">{{ $promotion->code }}</td>
                            </tr>
                            <tr>
                                <th>Tên khuyến mãi</th>
                                <td>{{ $promotion->name }}</td>
                            </tr>
                            
                            <tr>
                                <th>Ngày bắt đầu</th>
                                <td>{{ date('d-m-Y', strtotime($promotion->start_date)) }}</td>
                            </tr>
                            <tr>
                                <th>Ngày kết thúc</th>
                                <td>{{ date('d-m-Y', strtotime($promotion->end_date)) }}</td>
                            </tr>
                            <tr>
                                <th>Giá trị giảm giá</th>
                                <td>{{ number_format($promotion->discount, '0','.',',') }} VND</td>
                            </tr>
                            <tr>
                                <th>Số lượng</th>
                                <td>{{ $promotion->usage_limit }} Voucher</td>
                            </tr>
                            @php
                             $badge = '';
                             if($promotion->status == 'active'){
                                $badge = '<span class="badge text-bg-success">Hoạt động</span>';
                             } elseif (condition) {
                                $badge = '<span class="badge text-bg-danger">Vô hiệu</span>';
                             }
                            @endphp
                            <tr>
                                <th>Trạng thái</th>
                                <td>{!! $badge !!}</td>
                            </tr>
                            <tr>
                                <th>Hướng dẫn sử dụng</th>
                                <td>{{ $promotion->description }}</td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <!-- Danh sách sản phẩm áp dụng khuyến mãi -->
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        Sản phẩm áp dụng khuyến mãi
                    </div>
                    <div class="card-body">
                        @if($promotion->products->isEmpty())
                            <p>Không có sản phẩm nào áp dụng cho khuyến mãi này.</p>
                        @else
                            <ul>
                                @foreach($promotion->products as $product)
                                    <li>{{ $product->name }} - Giá: {{ number_format($product->price, '0', ',', '.') }}đ</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


