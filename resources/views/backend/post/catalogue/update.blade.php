<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Cập nhật nhóm thuộc tính</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('post.catalogue.index') }}">Danh
                                        sách</a>
                                </li>
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
            <form action="{{ route('post.catalogue.edit', ['slug' => $postCatalogue->slug]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên nhóm:<span class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" id=""
                                        value="{{ old('name', $postCatalogue->name) }}"
                                        placeholder="Tên nhóm thuộc tính">
                                    @if ($errors->has('name'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="addpost-general-info" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug:<span
                                                            class="text-danger fz-18">*</span></label>
                                                    <input type="text" name="slug" class="form-control"
                                                        id=""
                                                        value="{{ old('slug', $postCatalogue->slug) }}"
                                                        placeholder="Nhập slug cho nhóm ">
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
                                        <textarea class="form-control " rows="6" name="description">{{ old('description', $postCatalogue->description) }}</textarea>
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
                                <h5 class="card-title mb-0">Danh mục cha</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Danh mục</label>
                                    <select class="form-select setUpSelect2" name="parent_id">
                                        <option value="">[ Root ]</option>
                                        @foreach ($postCatalogues as $key => $val)
                                            <option value="{{ $val->id }}" {{  $postCatalogue->parent_id == $val->id  ? 'selected' : ''}}>
                                                {{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger fz-12 mt-2">Chọn Root nếu không có danh mục cha</span>
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
                                        <option value="">[Chọn trạng thái]</option>
                                        <option value="1" {{ $postCatalogue->publish == 1 ? 'selected' : '' }}>Hiển thị
                                        </option>
                                        <option value="0" {{ $postCatalogue->publish == 0 ? 'selected' : '' }}>Ẩn</option>
                                    </select>
                                    @if ($errors->has('publish'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('publish') }}</span>
                                    @endif
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
                                                <img src="{{ old('image', $postCatalogue->image ?? '') ? ''. old('image', $postCatalogue->image ?? '') : '/libaries/upload/images/img-notfound.png' }}"
                                                    alt=""
                                                    class="render-image  object-fit-contain rounded-1 mb-2 position-relative "
                                                    width="96" height="96">
                                            </span>
                                            {{-- input ẩn gửi lên controller xử lý  --}}
                                            <input type="hidden" name="image" value="{{ $postCatalogue->image }}">
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
