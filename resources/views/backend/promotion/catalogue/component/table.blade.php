<div class="table-responsive table-card mt-3 mb-1">
    <table class="table align-middle table-nowrap" id="customerTable">
        <thead class="table-light">
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check-all" value="option">
                    </div>
                </th>
                <th>Mã Voucher</th>
                <th>Tên Voucher</th>
                <th>chiết khấu</th>
                <th>Số lượng</th>
                <th>Số tiền tối thiểu</th>
                <th>Áp dụng</th>
                <th>Trạng thái</th>
                <th class="sort text-end">Thao tác</th>
            </tr>
        </thead>
        <tbody class="list form-check-all">
            @foreach ($promotions as $item)
                    <tr>
                    <td><input type="checkbox" class="select-item" value="{{ $item->id }}"></td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->discount }}</td>
                        <td>{{ $item->usage_limit }}</td>
                        <td>{{ $item->minimum_amount }}</td>
                        <td>{{ $item->apply_for }}</td>

                        <td class="status text-center">
                            {!! $item->status == 'active'
                ? '<span class="badge bg-success-subtle text-success text-uppercase p-2">Đang hoạt động</span>'
                : '<span class="badge bg-danger-subtle text-danger text-uppercase p-2">Ngưng hoạt động </span>' !!}
                        </td>
                        <td>
                            <div class="dropdown text-end">
                                <a href="#" role="button" id="dropdownMenuLink5" data-bs-toggle="dropdown" aria-expanded="false"
                                    class="">
                                    <i class="ri-more-2-fill fs-5"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink5" style="">
                                  
                                    <li><a class="dropdown-item text-info"
                                            href="{{ route('promotions.catalogue.edit', $item->id) }}"> <i
                                                class="ri-edit-box-line"></i>
                                            Chỉnh sửa</a></li>

                                    <li><a class="dropdown-item text-danger" href="{{ route('promotions.confirm_delete', $item->id) }}"><i class="ri-delete-bin-line"></i>
                                            Xóa</a></li>
                                    <li><a class="dropdown-item text-danger" href="{{ route('promotions.show', $item->id) }}"></i>
                                            xem </a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
</div>
