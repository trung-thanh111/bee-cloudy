<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Chỉnh sửa Voucher</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="">Danh sách</a></li>
                                <li class="breadcrumb-item active">Chỉnh sửa</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Thông tin Voucher</h5>
                            <span>Lưu ý: Điền đầy đủ và chính xác thông tin giúp hệ thống dễ dàng quản lý hơn.</span>
                            <p class="fst-italic">Những trường có (<span class="text-danger fz-18">*</span>) là bắt buộc!</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('promotions.update', $promotion->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- Tên Voucher -->
                                <div class="mb-3">
                                    <label class="form-label">Tên Voucher:<span class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $promotion->name) }}" placeholder="Tên Voucher">
                                    @if ($errors->has('name'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <!-- Mã Code -->
                                <div class="mb-3">
                                    <label class="form-label">Mã Code:<span class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="code" value="{{ old('code', $promotion->code) }}" placeholder="Mã Code">
                                    @if ($errors->has('code'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('code') }}</span>
                                    @endif
                                </div>

                                <!-- Thời gian áp dụng -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Thời gian bắt đầu:<span class="text-danger fz-18">*</span></label>
                                            <input type="datetime-local" class="form-control" name="start_date" value="{{ old('start_date', $promotion->start_date) }}">
                                            @if ($errors->has('start_date'))
                                                <span class="text-danger fz-12 mt-1">{{ $errors->first('start_date') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Thời gian kết thúc:<span class="text-danger fz-18">*</span></label>
                                            <input type="datetime-local" class="form-control" name="end_date" value="{{ old('end_date', $promotion->end_date) }}">
                                            @if ($errors->has('end_date'))
                                                <span class="text-danger fz-12 mt-1">{{ $errors->first('end_date') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Số tiền chiết khấu -->
                                <div class="mb-3">
                                    <label class="form-label">Số tiền chiết khấu:<span class="text-danger fz-18">*</span></label>
                                    <input type="number" class="form-control" name="discount_value" value="{{ old('discount_value', $promotion->discount_value) }}" placeholder="Số tiền chiết khấu">
                                    @if ($errors->has('discount_value'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('discount_value') }}</span>
                                    @endif
                                </div>

                                <!-- Số tiền tối thiểu -->
                                <div class="mb-3">
                                    <label class="form-label">Số tiền tối thiểu:</label>
                                    <input type="number" class="form-control" name="minimum_amount" value="{{ old('minimum_amount', $promotion->minimum_amount) }}" placeholder="Số tiền tối thiểu">
                                    @if ($errors->has('minimum_amount'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('minimum_amount') }}</span>
                                    @endif
                                </div>

                                <!-- Giới hạn sử dụng -->
                                <div class="mb-3">
                                    <label class="form-label">Giới hạn sử dụng:</label>
                                    <input type="number" class="form-control" name="usage_limit" value="{{ old('usage_limit', $promotion->usage_limit) }}" placeholder="Giới hạn số lượng sử dụng">
                                    @if ($errors->has('usage_limit'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('usage_limit') }}</span>
                                    @endif
                                </div>

                                <!-- Áp dụng cho -->
                                <div class="mb-3">
                                    <label class="form-label">Áp dụng cho:<span class="text-danger fz-18">*</span></label>
                                    <select class="form-select" name="apply_for" id="apply-for">
                                        <option value="all" {{ old('apply_for', $promotion->apply_for) == 'all' ? 'selected' : '' }}>Cho tất cả</option>
                                        <option value="new_accounts" {{ old('apply_for', $promotion->apply_for) == 'new_accounts' ? 'selected' : '' }}>Cho tài khoản mới</option>
                                        <option value="specific_products" {{ old('apply_for', $promotion->apply_for) == 'specific_products' ? 'selected' : '' }}>Cho sản phẩm nhất định</option>
                                    </select>
                                    @if ($errors->has('apply_for'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('apply_for') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" name="status">
                                        <option value="active" {{ old('status', $promotion->status) == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="inactive" {{ old('status', $promotion->status) == 'inactive' ? 'selected' : '' }}>Không kích hoạt</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Nút xác nhận -->
                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Cập nhật Voucher</button>
                        </div>
                    </div>

                    <!-- Live Preview Section -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Xem trước Voucher</h5>
                                <div id="voucher-preview">
                                    <p><strong>Tên Voucher:</strong> <span id="preview-name"></span></p>
                                    <p><strong>Mã Code:</strong> <span id="preview-code"></span></p>
                                    <p><strong>Thời gian bắt đầu:</strong> <span id="preview-start-date"></span></p>
                                    <p><strong>Thời gian kết thúc:</strong> <span id="preview-end-date"></span></p>
                                    <p><strong>Số tiền chiết khấu:</strong> <span id="preview-discount-value"></span></p>
                                    <p><strong>Số tiền tối thiểu:</strong> <span id="preview-minimum-amount"></span></p>
                                    <p><strong>Giới hạn sử dụng:</strong> <span id="preview-usage-limit"></span></p>
                                    <p><strong>Áp dụng cho:</strong> <span id="preview-apply-for"></span></p>
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
    function updatePreview() {
        document.getElementById('preview-name').textContent = document.querySelector('input[name="name"]').value;
        document.getElementById('preview-code').textContent = document.querySelector('input[name="code"]').value;
        document.getElementById('preview-start-date').textContent = document.querySelector('input[name="start_date"]').value;
        document.getElementById('preview-end-date').textContent = document.querySelector('input[name="end_date"]').value;
        document.getElementById('preview-discount-value').textContent = document.querySelector('input[name="discount_value"]').value;
        document.getElementById('preview-minimum-amount').textContent = document.querySelector('input[name="minimum_amount"]').value;
        document.getElementById('preview-usage-limit').textContent = document.querySelector('input[name="usage_limit"]').value;
        document.getElementById('preview-apply-for').textContent = document.querySelector('select[name="apply_for"]').value;
        document.getElementById('preview-status').textContent = document.querySelector('select[name="status"]').value;
    }

    document.addEventListener('DOMContentLoaded', function () {
        updatePreview();
        
        document.querySelectorAll('input, select').forEach(element => {
            element.addEventListener('change', updatePreview);
            element.addEventListener('input', updatePreview);
        });
    });
</script>