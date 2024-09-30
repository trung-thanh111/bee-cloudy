<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Danh sách</a>
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
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm:<span
                                            class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" id=""
                                        value="{{ old('name') }}" placeholder="Tên sản phẩm">
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
                                                        placeholder="Slug sản phẩm">
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
                                        <textarea class="form-control ck-editor" id="description" data-height="150" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label>Nội dung</label>
                                        {{-- data- đc gọi là thuộc tính dữ liệu tùy chỉnh  --}}
                                        <a href="#" class="multipleUploadImageCkeditor"
                                            data-target="ckContent">Upload nhiều hình ảnh</a>
                                    </div>
                                    <div>
                                        <textarea class="form-control ck-editor" id="ckContent" data-height="300" name="content">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                {{-- sản phẩm nhiều phiên bản  --}}
                                @include('backend.product.product.component.variant')
                                {{-- kết thúc nhiều phiên bản  --}}
                                {{-- album ảnh từng phiên bản   --}}
                                
                                
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0 ms-0">Cấu hình SEO</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="" id="">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Tiêu đề SEO</label>
                                                            <input type="text" class="form-control"
                                                                name="meta_title" placeholder="Nhập tiêu đề SEO"
                                                                value="{{ old('meta_title') }}">
                                                            @if ($errors->has('meta_title'))
                                                                <span
                                                                    class="text-danger fz-12 mt-1">{{ $errors->first('meta_title') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Từ khóa SEO</label>
                                                            <input type="text" class="form-control"
                                                                name="meta_keyword" placeholder="Nhập từ khóa SEO"
                                                                value="{{ old('meta_keyword') }}">
                                                            @if ($errors->has('meta_keyword'))
                                                                <span
                                                                    class="text-danger fz-12 mt-1">{{ $errors->first('meta_keyword') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="form-label">Mô tả SEO</label>
                                                    <textarea class="form-control ck-editor" name="meta_description" id="meta_description " data-height="150">{{ old('description') }}</textarea>
                                                    @if ($errors->has('meta_description'))
                                                        <span
                                                            class="text-danger fz-12 mt-1">{{ $errors->first('meta_description') }}</span>
                                                    @endif
                                                </div>
                                            </div>
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
                                <h5 class="card-title mb-0">Nhóm sản phẩm</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="choices-publish-status-input" class="form-label">Tên nhóm <span
                                                class="text-danger fz-18 ">*</span>
                                        </label>
                                        <span class="mt-2"><a href="{{ route('product.catalogue.create') }}"
                                                class="text-decoration-underline text-primary">thêm mới</a></span>
                                    </div>
                                    <select class="form-select select2" name="product_catalogue_id">
                                        <option value="0">[Chọn nhóm sản phẩm]</option>
                                        @foreach ($productCatalogues as $key => $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_catalogue_id'))
                                        <span
                                            class="text-danger fz-12 mt-1">{{ $errors->first('product_catalogue_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thông tin chung</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="product_sku" class="form-label">Mã sản phẩm</label>
                                    <input type="text" name="sku" id="product_sku" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Xuất sứ</label>
                                    <input type="text" name="made_in" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Giá bán</label>
                                    <input type="text" name="price" class="form-control">
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
                                <h5 class="card-title mb-0">Hình ảnh</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <p class="text-muted">Chọn ảnh đại diện.</p>
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            {{-- image-target dùng dể choose image hthi cho ngxem  --}}
                                            <span class="image-target">
                                                <img src="/templates/flat-admin/html/master/assets/images/image-notfound.png"
                                                    alt=""
                                                    class="render-image object-fit-cover rounded-1 mb-2 position-relative "
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
