<div class="table-responsive table-card mt-3 mb-1">
    <table class="table align-middle table-nowrap" id="customerTable">
        <thead class="table-light">
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check-all" value="option">
                    </div>
                </th>
                <th class="sort" data-sort="name">Thành viên</th>
                <th class="sort" data-sort="email">Email</th>
                <th class="sort text-center" data-sort="date">Ngày sinh</th>
                <th class="sort text-center" data-sort="created_at">Tham gia</th>
                <th class="sort text-center" data-sort="user_catalogue">Nhóm</th>
                <th class="sort text-center" data-sort="status">Trạng thái</th>
                <th class="sort text-end" data-sort="action" style="width:100px">Thao tác</th>
            </tr>
        </thead>
        <tbody class="list form-check-all">
            @foreach ($users as $key => $item)
                @php
                    $badge = '';
                    if ($item->user_catalogue_id == 1) {
                        $badge .= '<span class="badge bg-secondary-subtle text-secondary text-uppercase p-2">Khách hàng</span>';
                    }else if($item->user_catalogue_id == 2){
                        $badge .= '<span class="badge bg-danger-subtle text-danger text-uppercase p-2">Quản trị viên</span>';
                    }
                @endphp
                <tr>
                    <th scope="row">
                        <div class="form-check">
                            <input class="form-check-input checkbox-item" type="checkbox" name="checkbox-item"
                                value="option1">
                        </div>
                    </th>
                    <td class="customer_name">
                        <img src="{{ ($item->image) ? $item->image : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif' }}" alt=""
                            class="object-fit-contain me-2 rounded-circle" width="60px" height="60px">
                        {{ $item->name }}
                    </td>
                    <td class="email">{{ $item->email }}</td>
                    <td class=" text-center">{{ date('d-m-Y', strtotime($item->birthday)) }}</td>
                    <td class=" text-center">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                    <td class=" text-center">
                        {!! $badge !!}
                    </td>
                    <td class="status text-center">
                        {!! $item->publish == 1
                            ? '<span class="badge bg-success-subtle text-success text-uppercase p-2">Hoạt động</span>'
                            : '<span class="badge bg-danger-subtle text-danger text-uppercase p-2">Ngưng HĐ</span>' !!}
                    </td>
                    <td>
                        <div class="dropdown text-end">
                            <a href="#" role="button" id="dropdownMenuLink5" data-bs-toggle="dropdown"
                                aria-expanded="false" class="">
                                <i class="ri-more-2-fill fs-5"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink5" style="">
                                <li><a class="dropdown-item text-primary" href="{{ route('user.detail', ['id' => $item->id]) }}"><i
                                            class="ri-eye-line align-middle"></i> Xem</a></li>
                                <li><a class="dropdown-item text-info"
                                        href="{{ route('user.update', ['id' => $item->id]) }}"> <i
                                            class="ri-edit-box-line"></i>
                                        Chỉnh sửa</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- pagination  --}}
<div class="container-fluid">
    {{ $users->onEachSide(3)->links('pagination::bootstrap-5') }}
</div>
