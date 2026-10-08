<div class="table-responsive table-card mt-3 mb-1">
    <table class="table align-middle table-nowrap" id="customerTable">
        <thead class="table-light">
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check-all" value="option">
                    </div>
                </th>
                <th>Mã </th>
                <th>Tên Voucher</th>
                <th>Áp dụng</th>
                <th class="text-end">chiết khấu</th>
                <th class="text-end">Số lượng</th>
                <th class="text-end">Số tiền tối thiểu</th>
                <th>Trạng thái</th>
                <th class="sort text-end">Thao tác</th>
            </tr>
        </thead>
        <tbody class="list form-check-all">
            @foreach ($promotions as $item)
            @php
                $apply = '';
                if($item->apply_for == 'all'){
                    $apply = 'Tất cả';
                }elseif($item->apply_for == 'freeship'){
                    $apply = 'Vận chuyển';
                }elseif($item->apply_for == 'specific_products'){
                    $apply = 'Sản phẩm';
                }
            @endphp
                <tr>
                    <td>
                        <input type="checkbox" class="select-item" value="{{ $item->id }}">
                    </td>
                    <td class="fw-bold text-primary">{{ $item->code }}</td>
                    <td class="fw-medium text-truncate" style="max-width: 520px">{{ $item->name }}</td>
                    <td>{{ $apply }}</td>
                    <td class="text-end">{{ number_format($item->discount, '0', ',', '.') }} đ</td>
                    <td class="text-end">{{ $item->usage_limit }}</td>
                    <td class="text-end">{{ number_format($item->minimum_amount, '0', ',', '.') }} đ</td>
                    <td class="status text-center">
                        {!! $item->status == 'active'
                            ? '<span class="badge bg-success-subtle text-success text-uppercase p-2">Hoạt động</span>'
                            : '<span class="badge bg-danger-subtle text-danger text-uppercase p-2">Không HD</span>' !!}
                    </td>
                    <td>
                        <div class="dropdown text-end">
                            <a href="#" role="button" id="dropdownMenuLink5" data-bs-toggle="dropdown"
                                aria-expanded="false" class="">
                                <i class="ri-more-2-fill fs-5"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink5" style="">
                                <li><a class="dropdown-item text-info"
                                        href="{{ route('promotions.show', $item->id) }}">
                                        <i class="fa-regular fa-eye me-2"></i>
                                        xem </a>
                                </li>
                                <li><a class="dropdown-item text-info" href="{{ route('promotions.edit', $item->id) }}">
                                        <i class="ri-edit-box-line me-2"></i>
                                        Chỉnh sửa</a>
                                </li>
                                <li><a class="dropdown-item text-danger"
                                        href="{{ route('promotions.confirm_delete', $item->id) }}"><i
                                            class="ri-delete-bin-line me-2"></i>
                                        Xóa</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
