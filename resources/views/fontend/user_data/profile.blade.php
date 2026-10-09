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
                @if(Auth::check())
                @php 
                    $user = Auth::user();
                @endphp
                <div class="profile-main">
                    @include('fontend.account.components.header-profile')
                    <div class="body-profile">
                        <div class="row">
                            @include('fontend.account.components.aside')
                            <div class="col-lg-9 col-md-8 flex-grow-1">
                                <div class="article-profile">
                                    <div class="card mb-3 border-0">
                                        <div class="card-header border-0">
                                            <h6 class="card-title mb-0 flex-grow-1 fz-18 pt-2 pb-2">Thông tin cá nhân
                                            </h6>
                                        </div><!-- end cardheader -->
                                    </div>
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center flex-grow">
                                                <div>
                                                    <h6 class="card-title mb-0 flex-grow-1 fz-16 pt-2 pb-1">Thông tin
                                                    </h6>
                                                    <p class="fz-14">Chứng tôi sẽ liên lạc với bạn thông qua nhưng thông
                                                        tin bên dưới!</p>
                                                </div>
                                                <a href="{{ route('profile.edit') }}"><i class="fa-solid fa-pen fz-18 text-muted pe-3"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Chỉnh sửa thông tin"></i></a>
                                            </div>
                                            <div class="table-reposive mt-5">
                                                <table class="table table-borderless align-middle ps-lg-3">
                                                    <thead>
                                                        <tr class="">
                                                            <td>Hình ảnh</td>
                                                            <th>
                                                                <img src="{{ $user->image !== null ? $user->image : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif'}}"
                                                                    alt=""
                                                                    class="user-account object-fit-cover rounded-circle"
                                                                    width="60" height="60">
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>Họ tên</td>
                                                            <th>{{ $user->name }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <th>{{ $user->email }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Ngày sinh</td>
                                                            <th>{{ date('d-m-Y', $user->birth_day) }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Địa chỉ: </td>
                                                            <th>{{ $user->address }}</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </article>
    </section>
@endsection
