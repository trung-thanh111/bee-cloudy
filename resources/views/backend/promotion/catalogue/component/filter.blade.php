<div class="col">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-soft-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ri-delete-bin-2-line fz-14"></i>
        </button>
        <div class="col-sm-auto">
            <div>
                <a href="{{ route('promotions.create') }}" class="btn btn-success add-btn"><i
                        class="ri-add-line align-bottom me-1 fz-14"></i>Thêm mới</a>
            </div>
        </div>
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
                    Bạn có chắc muốn xóa những dữ liệu đang được chọn hay không?
                </div>
                <div class="modal-footer">
                <form id="bulk-delete-form" action="{{ route('promotions.bulkdeleteAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Hủy</button>
                    <input type="hidden" name="array_id" id="checked_array_id" value="">
                    <button type="submit" class="btn btn-success">Xác nhận xóa</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('promotions.index') }}" method="GET">
    <div class="row g-4 mb-3 fz-12 text-muted">
        <div class="col-sm">
            <div class="d-flex justify-content-sm-end">
                <div class="search-box ms-2">
                    <div class="input-group mb-3">
                        <button type="submit" class="ri-search-line search-icon btn btn-primary text-light z-3" id="button-addon1"></button>
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            class="form-control search z-1 ps-5 text-muted" placeholder="Tìm kiếm id, tên, slug, v.v.." aria-describedby="button-addon1">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-auto">
            <div class="d-flex">
                <div class="record ms-2">
                    <select name="perpage" class="form-control setUpSelect2" style="width: 280px">
                        <option value="10" {{ request('perpage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('perpage') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('perpage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perpage') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-auto">
            <div class="d-flex">
                <div class="fillter-publish ms-2">
                    <select name="publish" id="publish" class="form-control text-muted" style="width: 180px">
                        <option value="">[Tất cả trạng thái]</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

