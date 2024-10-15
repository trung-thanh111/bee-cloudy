<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Thêm mới bài viết</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Danh sách</a>
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
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề bài viết:<span
                                            class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" id=""
                                        value="{{ old('name') }}" placeholder="Tên bài viết">
                                    @if ($errors->has('name'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug:<span class="text-danger fz-18">*</span></label>
                                    <input type="text" name="slug" class="form-control" id=""
                                        value="{{ old('slug') }}" placeholder="Slug bài viết">
                                    @if ($errors->has('slug'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('slug') }}</span>
                                    @endif
                                </div>
                                <div>
                                    <label>Mô tả</label>
                                    <div>
                                        <textarea class="form-control" name="description" rows="3" placeholder="mô tả ngắn">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger fz-12 mt-1">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="mt-3 mb-2">
                                    <label>Nội dung</label>
                                    <div>
                                        <textarea class="form-control ck-editor " id="content" data-height="300" name="content">{{ old('content') }}</textarea>
                                        @if ($errors->has('content'))
                                            <span class="text-danger fz-12 mt-1">{{ $errors->first('content') }}</span>
                                        @endif
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
                                <h5 class="card-title mb-0">Nhóm bài viết</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="choices-publish-status-input" class="form-label">Tên nhóm <span
                                                class="text-danger fz-18 ">*</span>
                                        </label>
                                        <span class="mt-2"><a href="{{ route('post.catalogue.create') }}"
                                                class="text-decoration-underline text-primary">thêm mới</a></span>
                                    </div>
                                    <select class="form-select setUpSelect2" name="post_catalogue_id[]" multiple="multiple">
                                        <option value=" ">[Chọn nhóm bài viết]</option>
                                        @foreach ($postCatalogues as $key => $catalogue)
                                            <option value="{{ $catalogue->id }}"
                                                {{ (collect(old('post_catalogue_id'))->contains($catalogue->id)) ? 'selected' : '' }}>
                                                {{ $catalogue->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('post_catalogue_id'))
                                        <span
                                            class="text-danger fz-12 mt-1">{{ $errors->first('post_catalogue_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Trích nguồn</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Trích nguồn:<span
                                            class="text-danger fz-18">*</span></label>
                                    <input type="text" name="cre" class="form-control" id=""
                                        value="{{ old('cre') }}" placeholder="cre bài viết">
                                    <span class="text-warning fz-12 mt-2">Không có thì có thể bỏ qua</span>
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
                                        <option value="">[Chọn trạng thái]</option>
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
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
                                                <img src="/libaries/upload/images/img-notfound.png" alt=""
                                                    class="render-image object-fit-contain rounded-1 mb-2 position-relative "
                                                    width="96" height="96">
                                            </span>
                                            {{-- input ẩn gửi lên controller xử lý  --}}
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
