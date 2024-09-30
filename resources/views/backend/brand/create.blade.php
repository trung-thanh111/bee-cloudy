<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Thêm mới thương hiệu</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Danh sách</a>
                                </li>
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
                                <h5>Thông tin</h5>
                                <span>Lưu ý: Điền đầy đủ và chính xác thông
                                    tin giúp hệ
                                    thống có thể dễ dàng quản lý hơn. <p class="fst-italic">Những trường có (<span
                                            class="text-danger fz-18">*</span>)
                                        là bắt buộc!</p> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên thương hiệu:<span class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" id=""
                                        value="{{ old('name') }}" placeholder="Tên thương hiệu thuộc tính">
                                    @if ($errors->has('name'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug:<span
                                                            class="text-danger fz-18">*</span></label>
                                                    <input type="text" name="slug" class="form-control"
                                                        id="" value="{{ old('slug') }}"
                                                        placeholder="Nhập slug cho thương hiệu ">
                                                    @if ($errors->has('slug'))
                                                        <span
                                                            class="text-danger fz-12 mt-1">{{ $errors->first('slug') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label>Mô tả</label>
                                    <div>
                                        <textarea class="form-control ck-editor" id="ck-editor" data-height="200" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Xác nhận</button>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"> Xuất Xứ</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-1">
                                    <label for="made_in" class="form-label">Trụ sở</label>
                                    <input type="text" class="form-control" id="made_in" name="made_in" placeholder="Địa điểm ,quốc gia, sản xuất " value="">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="dateofyear" class="form-label">Thành lập</label>
                                    <input type="date" class="form-control" id="dateofyear" name="establish" value="">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Xuất bản</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Trạng thái</label>
                                    <select class="form-select setUpSelect2" name="publish">
                                        <option value="">[ Chọn Trạng thái ]</option>
                                        <option value="1"
                                            {{ old('publish', request('publish')) == '1' ? 'selected' : '' }}>Hiển thị
                                        </option>
                                        <option value="0"
                                            {{ old('publish', request('publish')) == '0' ? 'selected' : '' }}>Ẩn
                                        </option>
                                    </select>
                                    <span class="text-warning fz-12 mt-2">Bạn không chọn chúng tôi sẽ ẩn bản ghi!</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Hình ảnh</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <p class="text-muted">Chọn ảnh đại diện (logo).</p>
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            {{-- image-target dùng dể choose image hthi cho ngxem  --}}
                                            <span class="image-target">
                                                <img src="/libaries/upload/images/img-notfound.png"
                                                    alt=""
                                                    class="render-image  object-fit-cover rounded-1 mb-2 position-relative "
                                                    width="96" height="96">
                                            </span>
                                            {{-- input ẩn gửi lên controller xử lý  --}}
                                            <input type="hidden" name="image" value="">
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
