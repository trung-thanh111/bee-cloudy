<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Thêm mới banner</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Danh sách</a>
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
            <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên banner:<span
                                            class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" id=""
                                        value="{{ old('name') }}" placeholder="Tên banner">
                                    @if ($errors->has('name'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tên trang hiển thị:</label>
                                    <select class="form-select setUpSelect2" name="location">
                                        <option value="0" selected>Trang chủ vị trí 1</option>
                                        <option value="1">Trang chủ vị trí 2</option>
                                        <option value="2">Trang cửa hàng</option>
                                    </select>
                                    @if ($errors->has('location'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('location') }}</span>
                                    @endif
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Hình ảnh</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <p class="text-muted">Chọn ảnh đại diện.</p>
                                            <div class="col-lg-12">
                                                <div class="click-to-upload-variant text-center ">
                                                    <div class="icon"> <a type="button" class="upload-variant-picture"> <img
                                                                src="/libaries/upload/images/img-notfound.png" alt=""
                                                                class="render-image object-fit-cover rounded-1 mb-2 position-relative "
                                                                width="96" height="96"> </a> </div>
                                                    <div class="small-text"> <span>Sử dụng nút chọn hình hoặc click vào đây để
                                                            thêm hình ảnh.</span> </div>
                                                </div>
                                                <div class="upload-variant-list">
                                                    <div class="row">
                                                        <ul id="sortable2"
                                                            class="clearfix data-album sortui ui-sortable d-lg-flex justify-content-start flex-wrap">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($errors->has('album'))
                                                <span class="text-danger fz-12 mt-1">{{ $errors->first('album') }}</span>
                                            @endif
                                        </div>
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
                                <h5 class="card-title mb-0">Xuất bản</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="choices-publish-status-input " class="form-label">Trạng thái</label>
                                    <select class="form-select select2" name="publish">
                                        <option value="">[ Chọn Trạng thái ]</option>
                                        <option value="1"
                                            {{ old('publish', request('publish')) == '1' ? 'selected' : '' }}>Hiển thị
                                        </option>
                                        <option value="0"
                                            {{ old('publish', request('publish')) == '0' ? 'selected' : '' }}>Ẩn
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">THời gian</h5>
                            </div>
                            <div class="card-body">
                                <div class="mt-3 mb-2">
                                    <label>Ngày bắt đầu</label>
                                    <div>
                                        <input type="date" class="form-control" id="date" name="date_start">
                                        @if ($errors->has('date_start'))
                                            <span
                                                class="text-danger fz-12 mt-1">{{ $errors->first('date_start') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-3 mb-2">
                                    <label>Ngày kết thúc</label>
                                    <div>
                                        <input type="date" class="form-control" id="date" name="date_end">
                                        @if ($errors->has('date_end'))
                                            <span class="text-danger fz-12 mt-1">{{ $errors->first('date_end') }}</span>
                                        @endif
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
