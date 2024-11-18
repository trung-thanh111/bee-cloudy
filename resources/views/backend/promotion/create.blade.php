<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Thêm Mới Khuyến Mãi</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('promotions.index') }}">Danh sách</a></li>
                                <li class="breadcrumb-item active">Thêm mới</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Thông tin Khuyến Mãi</h5>
                            <span>Lưu ý: Điền đầy đủ và chính xác thông tin giúp hệ thống dễ dàng quản lý hơn.</span>
                            <p class="fst-italic">Những trường có (<span class="text-danger fz-18">*</span>) là bắt
                                buộc!</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('promotions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- Tên khuyến mãi -->
                                <div class="mb-3">
                                    <label class="form-label">Tên khuyến mãi:<span
                                            class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số lượng:</label>
                                    <input type="number" class="form-control" name="usage_limit"
                                        value="{{ old('usage_limit') }}">
                                    @if ($errors->has('usage_limit'))
                                        <span class="text-danger">{{ $errors->first('usage_limit') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hướng dẫn sử dụng:</label>
                                    <textarea class="form-control ck-editor" name="description" id="ck-editor"
                                        data-height="250"> {{ old('description') }}</textarea>
                                </div>
                                <!-- Áp dụng cho -->
                                <div class="mb-3">
                                    <h5 class=" mb-0">
                                        Áp dụng cụ thể
                                    </h5>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Áp dụng cho:<span
                                            class="text-danger fz-18">*</span></label>
                                    <select id="apply-for" name="apply_for" class="form-select">
                                        <option value="all" {{ old('apply_for') == 'all' ? 'selected' : '' }}>Áp dụng cho
                                            tất cả sản phẩm</option>
                                        <option value="specific_products" {{ old('apply_for') == 'specific_products' ? 'selected' : '' }}>Áp dụng cho sản phẩm cụ thể</option>
                                        <option value="freeship" {{ old('apply_for') == 'freeship' ? 'selected' : '' }}>
                                            Miễn phí vận chuyển</option>
                                    </select>
                                    @if ($errors->has('apply_for'))
                                        <span class="text-danger">{{ $errors->first('apply_for') }}</span>
                                    @endif
                                </div>
                                <!-- Phần sản phẩm khi chọn specific_products -->
                                <div class="">
                                    <div id="specific-products-section" class="mb-3" style="display: none;">
                                        <label class="form-label">Chọn sản phẩm áp dụng:</label>
                                        <select id="product-dropdown" class="form-select setUpSelect2"
                                            name="product_id">
                                            <option value="">-- Chọn sản phẩm --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('product_id'))
                                            <span class="text-danger">{{ $errors->first('product_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nút xác nhận -->
                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Tạo Khuyến Mãi</button>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="fa fa-gear me-2"></i>Tùy chỉnh
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-1">
                                    <!-- Giá trị giảm và điều kiện -->
                                    <div class="mb-3" id="discount-section">
                                        <label class="form-label">Giá trị giảm: <span
                                                class="text-danger fz-18">*</span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="discount"
                                                value="{{ old('discount') }}" placeholder="Số tiền chiết khấu">
                                            <span class="input-group-text">VND</span>
                                        </div>
                                        @if ($errors->has('discount'))
                                            <span class="text-danger fz-12 mt-1">{{ $errors->first('discount') }}</span>
                                        @endif
                                    </div>
                                    <div class="">
                                        <label class="form-label">Đơn hàng tối thiểu</label>
                                        <div class="input-group">
                                            <input type="number" name="minimum_amount" class="form-control"
                                                placeholder="100.000 VND">
                                            <span class="input-group-text">VND</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- thời gian áp dụng -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fa fa-clock me-2"></i>Thời Gian Áp Dụng
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="g-3">
                                    <div class=" mb-3">
                                        <label class="form-label">Bắt đầu</label>
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="start_date"
                                                value="{{ old('start_date') }}">
                                        </div>
                                        @if ($errors->has('start_date'))
                                            <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                        @endif
                                    </div>
                                    <div class=" mb-3">
                                        <label class="form-label">Kết thúc</label>
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="end_date"
                                                value="{{ old('end_date') }}">
                                        </div>
                                        @if ($errors->has('end_date'))
                                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Xuất bản</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="choices-publish-status-input " class="form-label">Trạng thái</label>
                                    <select name="status" class="form-select setUpSelect2">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Kích
                                            hoạt</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Vô
                                            hiệu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Hình ảnh</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <p class="text-muted">Chọn ảnh đại diện.</p>
                                    @if ($errors->has('image')) 
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            {{-- image-target dùng dể choose image hthi cho ngxem --}}
                                            <span class="image-target">
                                                <img src="/libaries/upload/images/img-notfound.png" alt=""
                                                    class="render-image object-fit-contain rounded-1 mb-2 position-relative "
                                                    width="96" height="96">
                                            </span>
                                            {{-- input ẩn gửi lên controller xử lý --}}
                                            <input type="hidden" name="image" value="{{ old('image') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const applyForField = document.getElementById('apply-for');
        const discountSection = document.getElementById('discount-section');
        const specificProductsSection = document.getElementById('specific-products-section');

        function toggleFields() {
            const applyForValue = applyForField.value;
            if (applyForValue === 'freeship') {
                discountSection.style.display = 'none';
                specificProductsSection.style.display = 'none';
            } else if (applyForValue === 'specific_products') {
                discountSection.style.display = 'block';
                specificProductsSection.style.display = 'block';
            } else {
                discountSection.style.display = 'block';
                specificProductsSection.style.display = 'none';
            }
        }

        // Hiển thị đúng trường khi load trang
        toggleFields();
        applyForField.addEventListener('change', toggleFields);


    });
</script>