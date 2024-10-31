<div class="table-responsive table-card mt-3 mb-1">
    <table class="table align-middle table-nowrap" id="customerTable">
        <thead class="table-light">
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check-all" value="option">
                    </div>
                </th>
                <th class="sort" data-sort="name">Nhóm thành viên</th>
                <th class="sort" data-sort="desc">Mô tả</th>
                <th class="sort text-center" data-sort="arconym">Gọi tắt</th>
                <th class="sort text-center" data-sort="status">Trạng thái</th>
                <th class="sort text-end" data-sort="action">Thao tác</th>
            </tr>
        </thead>
        <tbody class="list form-check-all">
            @foreach ($userCatalogues as $key => $item)
                <tr>
                    <th scope="row">
                        <div class="form-check">
                            <input class="form-check-input checkbox-item" type="checkbox" name="checkbox-item" value="option1">
                        </div>
                    </th>
                    <td class="customer_name">
                        <img src="{{ ($item->image) ? $item->image : '/templates/flat-admin/html/master/assets/images/image-notfound.png' }}" alt="" class="object-fit-contain me-2" width="120px"
                            height="70px">
                        {{ $item->name }}
                    </td>
                    <td class="desc">{!! $item->description !!}</td>
                    <td class="phone text-center">{{ $item->acronym }}</td>
                    <td class="status text-center">
                        {!! $item->publish == 1
                            ? '<span class="badge bg-success-subtle text-success text-uppercase p-2">Hiển Thị</span>'
                            : '<span class="badge bg-danger-subtle text-danger text-uppercase p-2">Ẩn</span>' !!}
                    </td>
                    <td>
                        <div class="dropdown text-end">
                            <a href="#" role="button" id="dropdownMenuLink5" data-bs-toggle="dropdown"
                                aria-expanded="false" class="">
                                <i class="ri-more-2-fill fs-5"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink5" style="">
                                {{-- <li><a class="dropdown-item text-primary" href="#"><i
                                            class="ri-eye-line align-middle"></i> Xem</a></li> --}}
                                            <li><a class="dropdown-item text-info" href="{{ route('user.catalogue.update', ['slug' => $item->slug]) }}"> <i class="ri-edit-box-line"></i>
                                                Chỉnh sửa</a></li>

                                <li><a class="dropdown-item text-danger" href="{{ route('user.catalogue.delete', ['id' => $item->id]) }}"><i
                                            class="ri-delete-bin-line"></i>
                                        Xóa</a></li>
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
    {{ $userCatalogues->onEachSide(3)->links('pagination::bootstrap-5') }}
</div>
