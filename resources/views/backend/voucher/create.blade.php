<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Thêm mới Voucher</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('voucher.index') }}">Danh sách</a></li>
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
                            <div class="align-items-center">
                                <h5>Thông tin Voucher</h5>
                                <span>Lưu ý: Điền đầy đủ và chính xác thông tin giúp hệ thống dễ dàng quản lý
                                    hơn.</span>
                                <p class="fst-italic">Những trường có (<span class="text-danger fz-18">*</span>) là bắt
                                    buộc!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('voucher.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- Tên Voucher -->
                                <div class="mb-3">
                                    <label class="form-label">Tên Voucher:<span
                                            class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Tên Voucher">
                                    @if ($errors->has('name'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <!-- Thời gian áp dụng -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Thời gian bắt đầu:<span
                                                    class="text-danger fz-18">*</span></label>
                                            <input type="datetime-local" class="form-control" name="start_date"
                                                value="{{ old('start_date') }}">
                                            @if ($errors->has('start_date'))
                                                <span
                                                    class="text-danger fz-12 mt-1">{{ $errors->first('start_date') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Thời gian kết thúc:<span
                                                    class="text-danger fz-18">*</span></label>
                                            <input type="datetime-local" class="form-control" name="end_date"
                                                value="{{ old('end_date') }}">
                                            @if ($errors->has('end_date'))
                                                <span class="text-danger fz-12 mt-1">{{ $errors->first('end_date') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Số tiền chiết khấu -->
                                <div class="mb-3">
                                    <label class="form-label">Số tiền chiết khấu:<span
                                            class="text-danger fz-18">*</span></label>
                                    <input type="number" class="form-control" name="discount_value"
                                        value="{{ old('discount_value') }}" placeholder="Số tiền chiết khấu">
                                    @if ($errors->has('discount_value'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('discount_value') }}</span>
                                    @endif
                                </div>

                                <!-- Số tiền tối thiểu -->
                                <div class="mb-3">
                                    <label class="form-label">Số tiền tối thiểu:</label>
                                    <input type="number" class="form-control" name="minimum_amount"
                                        value="{{ old('minimum_amount') }}" placeholder="Số tiền tối thiểu">
                                    @if ($errors->has('minimum_amount'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('minimum_amount') }}</span>
                                    @endif
                                </div>

                                <!-- Giới hạn sử dụng -->
                                <div class="mb-3">
                                    <label class="form-label">Giới hạn sử dụng:</label>
                                    <input type="number" class="form-control" name="usage_limit"
                                        value="{{ old('usage_limit') }}" placeholder="Giới hạn số lượng sử dụng">
                                    @if ($errors->has('usage_limit'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('usage_limit') }}</span>
                                    @endif
                                </div>

                                <!-- Áp dụng cho -->
                                <div class="mb-3">
                                    <label class="form-label">Áp dụng cho:<span
                                            class="text-danger fz-18">*</span></label>
                                    <select class="form-select" name="apply_for">
                                        <option value="all" {{ old('apply_for') == 'all' ? 'selected' : '' }}>Cho tất cả
                                        </option>
                                        <option value="new_accounts" {{ old('apply_for') == 'new_accounts' ? 'selected' : '' }}>Cho tài khoản mới</option>
                                        <option value="specific_products" {{ old('apply_for') == 'specific_products' ? 'selected' : '' }}>Cho sản phẩm nhất định</option>
                                    </select>
                                    @if ($errors->has('apply_for'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('apply_for') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Nút xác nhận -->
                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Thêm Voucher</button>
                        </div>
                    </div>

                    <!-- Thông tin chung về sản phẩm -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thông tin chung</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 d-none">
                                    <label class="form-label">Mã Voucher:</label>
                                    <input type="text" class="form-control" name="code" value="{{ $randomCode ?? '' }}"
                                        readonly>
                                </div>


                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" name="status">
                                        <option value="">[Chọn Trạng thái]</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Kích hoạt
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không
                                            kích hoạt</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>



                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>