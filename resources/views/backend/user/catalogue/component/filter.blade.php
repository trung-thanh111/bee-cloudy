    <div class="col-sm-4">
        <div>
            <button class="btn btn-soft-danger hidden-visibility" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                    class="ri-delete-bin-2-line fz-14"></i></button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Xóa dữ liệu hàng loạt</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc muốn xóa những dữ liệu đang được chọn bên trên
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-success">Xác nhận xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('user.catalogue.index') }}" method="GET">
        <div class="row g-4 mb-3">
            @php
                $perpage = request('perpage') ?: old('perpage');
                $userCatalogueId = request('user_catalogue_id') ?: old('user_catalogue_id');
            @endphp
            <div class="col-sm">
                <div class="d-flex justify-content-sm-end">
                    <div class="search-box ms-2">
                        <form>
                            <div class="input-group mb-3">
                                <button type="submit" class="ri-search-line search-icon btn btn-primary text-light z-3"
                                    id="button-addon1"></button>
                                <input type="text" name="keyword" value="{{ request('keyword') ?: old('keyword') }}"
                                    class="form-control search z-1 ps-5 text-muted"
                                    placeholder="Tìm kiếm id, tên, slug, v.v.." aria-describedby="button-addon1">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="d-flex">
                    <div class="record ms-2">
                        <select name="perpage" id="" class="form-control setUpSelect2" style="width: 280px">
                            @for ($i = 5; $i <= 100; $i += 5)
                                <option {{ $perpage == $i ? 'selected' : '' }} value="{{ $i }}">
                                    {{ $i }} bản ghi</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="d-flex">
                    <div class="fillter-publish ms-2">
                        <select name="publish" id="publish" class="form-control text-muted" style="width: 180px">
                            <option value="">[Tất cả trạng thái]</option>
                            <option value="1" {{ old('publish', request('publish')) == '1' ? 'selected' : '' }}>
                                Hiển thị</option>
                            <option value="0" {{ old('publish', request('publish')) == '0' ? 'selected' : '' }}>Ẩn
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-auto">
                <div>
                    <a href="{{ route('user.catalogue.create') }}" class="btn btn-success add-btn"><i
                            class="ri-add-line align-bottom me-1 fz-14"></i>Thêm mới</a>
                </div>
            </div>
        </div>
    </form>
