
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
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
                            <p class="fst-italic">Những trường có (<span class="text-danger fz-18">*</span>) là bắt buộc!</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('promotions.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- Tên khuyến mãi -->
                                <div class="mb-3">
                                    <label class="form-label">Tên khuyến mãi:<span class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <!-- Ngày bắt đầu -->
                                <div class="mb-3">
                                    <label class="form-label">Ngày bắt đầu:<span class="text-danger fz-18">*</span></label>
                                    <input type="datetime-local" class="form-control" name="start_date" value="{{ old('start_date') }}" required>
                                    @if ($errors->has('start_date'))
                                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </div>

                                <!-- Ngày kết thúc -->
                                <div class="mb-3">
                                    <label class="form-label">Ngày kết thúc:<span class="text-danger fz-18">*</span></label>
                                    <input type="datetime-local" class="form-control" name="end_date" value="{{ old('end_date') }}" required>
                                    @if ($errors->has('end_date'))
                                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                    @endif
                                </div>

                                <!-- Áp dụng cho -->
                                <div class="mb-3">
                                    <label class="form-label">Áp dụng cho:<span class="text-danger fz-18">*</span></label>
                                    <select id="apply-for" name="apply_for" class="form-select" required>
                                        <option value="all" {{ old('apply_for') == 'all' ? 'selected' : '' }}>Áp dụng cho tất cả sản phẩm</option>
                                        <option value="specific_products" {{ old('apply_for') == 'specific_products' ? 'selected' : '' }}>Áp dụng cho sản phẩm cụ thể</option>
                                        <option value="freeship" {{ old('apply_for') == 'freeship' ? 'selected' : '' }}>Miễn phí vận chuyển</option>
                                    </select>
                                    @if ($errors->has('apply_for'))
                                        <span class="text-danger">{{ $errors->first('apply_for') }}</span>
                                    @endif
                                </div>
                                <!-- Phần sản phẩm khi chọn specific_products -->
                                <div id="specific-products-section" class="mb-3" style="display: none;">
                                    <label class="form-label">Chọn sản phẩm áp dụng:</label>
                                    <select id="product-dropdown" class="form-select" name="product_id">
                                        <option value="">-- Chọn sản phẩm --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_id'))
                                        <span class="text-danger">{{ $errors->first('product_id') }}</span>
                                    @endif
                                </div>

                                <!-- Phần chiết khấu -->
                                <div id="discount-section" class="mb-3" style="display: none;">
                                    <label class="form-label">Số tiền chiết khấu:<span class="text-danger fz-18">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="discount" value="{{ old('discount') }}" placeholder="Số tiền chiết khấu">
                                        <span class="input-group-text">VND</span>
                                    </div>
                                    @if ($errors->has('discount'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('discount') }}</span>
                                    @endif
                                </div>

                                

                                <!-- Số tiền tối thiểu -->
                                <div class="mb-3">
                                    <label class="form-label">Số tiền tối thiểu:</label>
                                    <input type="number" class="form-control" name="minimum_amount" value="{{ old('minimum_amount') }}">
                                    @if ($errors->has('minimum_amount'))
                                        <span class="text-danger">{{ $errors->first('minimum_amount') }}</span>
                                    @endif
                                </div>

                                <!-- Giới hạn sử dụng -->
                                <div class="mb-3">
                                    <label class="form-label">Giới hạn sử dụng:</label>
                                    <input type="number" class="form-control" name="usage_limit" value="{{ old('usage_limit') }}">
                                    @if ($errors->has('usage_limit'))
                                        <span class="text-danger">{{ $errors->first('usage_limit') }}</span>
                                    @endif
                                </div>

                                <!-- Trạng thái -->
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái:</label>
                                    <select name="status" class="form-select" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Vô hiệu</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Nút xác nhận -->
                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Tạo Khuyến Mãi</button>
                        </div>
                    </div>

                    <!-- Live Preview Section -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Xem trước Khuyến Mãi</h5>
                                <div id="promotion-preview">
                                    <p><strong>Tên Khuyến Mãi:</strong> <span id="preview-name"></span></p>
                                    <p><strong>Ngày bắt đầu:</strong> <span id="preview-start-date"></span></p>
                                    <p><strong>Ngày kết thúc:</strong> <span id="preview-end-date"></span></p>
                                    <p><strong>Áp dụng cho:</strong> <span id="preview-apply-for"></span></p>
                                    <p><strong>Số tiền chiết khấu:</strong> <span id="preview-discount"></span></p>
                                    <p><strong>Số tiền tối thiểu:</strong> <span id="preview-minimum-amount"></span></p>
                                    <p><strong>Giới hạn sử dụng:</strong> <span id="preview-usage-limit"></span></p>
                                    <p><strong>Trạng thái:</strong> <span id="preview-status"></span></p>
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

        // Cập nhật xem trước
        function updatePreview() {
            document.getElementById('preview-name').textContent = document.querySelector('input[name="name"]').value;
            document.getElementById('preview-start-date').textContent = document.querySelector('input[name="start_date"]').value;
            document.getElementById('preview-end-date').textContent = document.querySelector('input[name="end_date"]').value;
            document.getElementById('preview-apply-for').textContent = document.querySelector('select[name="apply_for"]').value;
            document.getElementById('preview-discount').textContent = document.querySelector('input[name="discount"]').value;
            document.getElementById('preview-minimum-amount').textContent = document.querySelector('input[name="minimum_amount"]').value;
            document.getElementById('preview-usage-limit').textContent = document.querySelector('input[name="usage_limit"]').value;
            document.getElementById('preview-status').textContent = document.querySelector('select[name="status"]').value;
        }

        // Cập nhật xem trước khi load trang và khi có thay đổi
        updatePreview();
        document.querySelectorAll('input, select').forEach(element => {
            element.addEventListener('change', updatePreview);
            element.addEventListener('input', updatePreview);
        });
    });
</script>