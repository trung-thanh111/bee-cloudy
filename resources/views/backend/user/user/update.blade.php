<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Chỉnh sửa</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Danh sách</a>
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
                                <span>Lưu ý: Đầy đủ và chính xác thông
                                    tin giúp hệ
                                    thống có thể dễ dàng quản lý hơn. <p class="fst-italic">Những trường có (<span
                                            class="text-danger fz-18">*</span>)
                                        là bắt buộc!</p> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('user.edit', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên thành viên:<span
                                            class="text-danger fz-18">*</span></label>
                                    <input type="text" class="form-control" name="name" id=""
                                        value="{{ old('name', $user->name) }}" placeholder="Tên thành viên">
                                    @if ($errors->has('name'))
                                        <span class="text-danger fz-12 mt-1">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Email:<span
                                                            class="text-danger fz-18">*</span></label>
                                                    <input type="text" name="email" class="form-control"
                                                        id="" value="{{ old('email', $user->email) }}"
                                                        placeholder="Nhập email cho nhóm" disabled>
                                                    @if ($errors->has('email'))
                                                        <span
                                                            class="text-danger fz-12 mt-1">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <label class="form-label">Điện thoại:<span
                                                            class="text-danger fz-18 "
                                                            style="visibility: hidden">*</span></label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="{{ old('phone', $user->phone) }}" placeholder="Nhập số điện thoại">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <label class="form-label">Ngày sinh:<span class="text-danger fz-18"
                                                            style="visibility: hidden">*</span></label>
                                                    <input type="date" name="birthday" class="form-control"
                                                        value="{{ old('birthday', $user->birthday) }}"
                                                        placeholder="Nhập tên gợi nhớ của nhóm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label>Mô tả</label>
                                    <div>
                                        <textarea class="form-control ck-editor" id="ck-editor" data-height="200" name="description">{{ old('description', $user->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="tab-content mt-3">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Tỉnh/Thành Phố</label>
                                                    <select name="province_id" id="province"
                                                        class="form-control setUpSelect2">
                                                    </select>
                                                    @if ($errors->has('province'))
                                                        <span
                                                            class="text-danger fz-12 mt-1">{{ $errors->first('province') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Quận/Huyện</label>
                                                    <select name="district_id" id="district"
                                                        class="form-control setUpSelect2">
                                                    </select>
                                                    @if ($errors->has('district'))
                                                        <span
                                                            class="text-danger fz-12 mt-1">{{ $errors->first('district') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Phường/Xã</label>
                                                    <select name="ward_id" id="ward"
                                                        class="form-control setUpSelect2">
                                                    </select>
                                                    @if ($errors->has('ward'))
                                                        <span
                                                            class="text-danger fz-12 mt-1">{{ $errors->first('ward') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <input type="hidden" name="province_name" id="province_name"
                                                value="">
                                            <input type="hidden" name="district_name" id="district_name"
                                                value="">
                                            <input type="hidden" name="ward_name" id="ward_name" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="">
                                                    <label class="form-label">Địa chỉ:<span class="text-danger fz-18 "
                                                            style="visibility: hidden">*</span></label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ old('address', $user->address) }}"
                                                        placeholder="98 100 Tân thới nhất">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content mt-3">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        {{-- <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="form-label" for="password-input">Mật khẩu</label>
                                                <div class="input-group flex-nowrap">
                                                    <input type="password" class="form-control input-group-password"
                                                        id="password-input" name="password"
                                                        placeholder="Nhập mật khẩu">
                                                    <span class="input-group-text icon-eye-password"
                                                        id="addon-wrapping">
                                                        <i class="fa-solid fa-eye"></i>
                                                        <i class="fa-solid fa-eye-slash d-none"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('password'))
                                                    <span
                                                        class="text-danger fz-12 mt-1">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label" for="password-confirm">Xác nhận mật
                                                    khẩu</label>
                                                <div class="input-group flex-nowrap">
                                                    <input type="password" class="form-control input-group-password"
                                                        id="password-confirm" name="password_confirmation"
                                                        placeholder="Xác nhận mật khẩu" value="">
                                                    <span class="input-group-text icon-eye-password"
                                                        id="addon-wrapping">
                                                        <i class="fa-solid fa-eye"></i>
                                                        <i class="fa-solid fa-eye-slash d-none"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                    <span
                                                        class="text-danger fz-12 mt-1">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>
                                        </div> --}}
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
                                <h5 class="card-title mb-0">Nhóm thành viên</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="choices-publish-status-input " class="form-label">Tên nhóm
                                        <span class="text-danger fz-18 ">*</span>
                                    </label>
                                    <select class="form-select select2" name="user_catalogue_id">
                                        <option value="0">[Chọn nhóm thành viên]
                                        </option>
                                        @foreach ($userCatalogue as $key => $val)
                                            <option value="{{ $val->id }}"
                                                {{ old('user_catalogue_id', $user->user_catalogue_id) == $val->id ? 'selected' : '' }}>
                                                {{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_catalogue_id'))
                                        <span
                                            class="text-danger fz-12 mt-1">{{ $errors->first('user_catalogue_id') }}</span>
                                    @endif
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
                                        <option value="1" {{ ($user->publish == 1) ? 'selected' : '' }}>Hiển thị</option>
                                        <option value="0" {{ ($user->publish == 0) ? 'selected' : '' }}>Ẩn</option>
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
                                                <img src="{{ old('image', $user->image ?? '') ? '' . old('image', $user->image ?? '') : '/libaries/upload/images/img-notfound.png' }}"
                                                    alt=""
                                                    class="render-image object-fit-contain rounded-1 mb-2 position-relative "
                                                    width="96" height="96">
                                            </span>
                                            {{-- input ẩn gửi lên controller xử lý  --}}
                                            <input type="hidden" name="image" value="{{ old('image', $user->image) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="password" id="" value="{{ $user->password }}">
                <input type="hidden" name="email" id="" value="{{ $user->email }}">
            </form>
        </div>
    </div>
</div>
<script>
    window.province_id = @json($user->province_id);
    window.district_id = @json($user->district_id);
    window.ward_id = @json($user->ward_id);
</script>