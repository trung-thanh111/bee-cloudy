@extends('fontend.home.layout')
@section('page_title')
    Thông tin cá nhân
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0 mb-5">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="#" class="text-decoration-none text-muted">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="profile-main">
                    @include('fontend.account.components.header-profile')
                    <div class="body-profile">
                        <div class="row">
                            @include('fontend.account.components.aside')

                            <div class="col-lg-9 col-md-8 flex-grow-1">
                                <div class="article-profile">
                                    <div class="card border-0 mb-3">
                                        <div class="card-header border-0">
                                            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Cập nhật thông tin
                                            </h6>
                                        </div><!-- end cardheader -->
                                    </div>
                                    <div class="card border-0 ">
                                        <div class="card-body fz-16">
                                            <div class="flex-grow">
                                                <h6 class="card-title mb-0 flex-grow-1 fz-16 pt-2 pb-1">Thông tin
                                                </h6>
                                                <p class="fz-14">Hãy chắc rằng thông tin bạn đang nhập là chính xác!
                                                </p>
                                            </div>
                                            <div class="mt-5">
                                                <form action="{{ route('profile.update') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Họ và tên</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" placeholder="Họ và tên"
                                                                            value="{{ old('name', $user->name) }}">
                                                                    </div>
                                                                    @if ($errors->has('name'))
                                                                        <span
                                                                            class="text-danger fz-12 mt-1">{{ $errors->first('name') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Ngày sinh</label>
                                                                        <input type="date" class="form-control"
                                                                            name="birthday" placeholder="Ngày sinh"
                                                                            value="{{ old('birthday', $user->birthday) }}">
                                                                    </div>
                                                                    @if ($errors->has('birtday'))
                                                                        <span
                                                                            class="text-danger fz-12 mt-1">{{ $errors->first('birtday') }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Email</label>
                                                                        <input type="email" class="form-control"
                                                                            name="email" placeholder="Email"
                                                                            value="{{ old('email', $user->email) }}"
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Số điện thoại</label>
                                                                        <input type="text" class="form-control"
                                                                            name="phone" placeholder="Số điện thoại"
                                                                            value="{{ old('phone', $user->phone) }}">
                                                                    </div>
                                                                    @if ($errors->has('phone'))
                                                                        <span
                                                                            class="text-danger fz-12 mt-1">{{ $errors->first('phone') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="addproduct-general-info"
                                                                    role="tabpanel">
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
                                                                    <div class="row">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Địa chỉ:<span
                                                                                    class="text-danger fz-18 "
                                                                                    style="visibility: hidden">*</span></label>
                                                                            <input type="text" name="address"
                                                                                class="form-control"
                                                                                value="{{ old('address', $user->address) }}"
                                                                                placeholder="98 100 Tân thới nhất">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Giới thiệu</label>
                                                                            <textarea name="description" class="form-control" rows="3">{{ old('description', $user->description) }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                                            <div class="mb-3">
                                                                <div class="text-center">
                                                                    <img src="{{ $user->image != null ? $user->image : '/libaries/upload/images/img-notfound.png' }}"
                                                                        alt="Avatar" alt="User Image"
                                                                        class="rounded-circle object-fit-contain mb-3"
                                                                        width="100" height="100">
                                                                    <input type="file" name="image"
                                                                        class="form-control mb-1">
                                                                    <p class="fz-12">Chấp nhận định dạng JPG, PNG, Webp
                                                                    </p>
                                                                </div>
                                                                @if ($errors->has('image'))
                                                                    <span
                                                                        class="text-danger fz-12 mt-1">{{ $errors->first('image') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="text-end my-2 d-flex justify-content-end">
                                                            <div class="text-end mb-3">
                                                                <button type="submit"
                                                                    class="btn btn-outline-secondary w-sm">Hủy</button>
                                                            </div>
                                                            <div class="text-end mb-3 ms-3">
                                                                <button type="submit"
                                                                    class=" accept btn btn-success w-sm">Xác nhận</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <script>
        window.province_id = @json($user->province_id);
        window.district_id = @json($user->district_id);
        window.ward_id = @json($user->ward_id);
    </script>
@endsection
