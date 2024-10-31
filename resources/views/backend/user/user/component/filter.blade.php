<div class="col">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-soft-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ri-delete-bin-2-line fz-14"></i>
        </button>
        <div class="col-sm-auto">
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success add-btn"><i
                        class="ri-add-line align-bottom me-1 fz-14"></i>Thêm mới</a>
            </div>
        </div>
    </div>
    
</div>
<form id="searchForm" action="{{ route('user.index') }}" method="GET">
    <div class="row g-4 mb-3 fz-12 text-muted">
        @php
            $perpage = request('perpage') ?: old('perpage');
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
                                placeholder="Tìm kiếm id, tên, v.v.." aria-describedby="button-addon1">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-auto">
            <div class="d-flex">
                <div class="record ms-2">
                    <select name="perpage" id="" class="form-control setUpSelect2" style="width: 280px">
                        @for ($i = 10; $i <= 100; $i += 10)
                            <option {{ $perpage == $i ? 'selected' : '' }} value="{{ $i }}">
                                {{ $i }} bản ghi</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-auto">
            <div class="d-flex">
                <div class="record ms-2">
                    <select name="user_catalogue_id" id="" class="form-control setUpSelect2" style="width: 180px">
                            <option value="0">[Nhóm thành viên]</option>
                            @foreach ($userCatalogue as $key => $val)
                                <option value="{{ $val->id }}" {{ old('user_catalogue_id', request('user_catalogue_id')) == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                            @endforeach
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

    </div>
</form>

    