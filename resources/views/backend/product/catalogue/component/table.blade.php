<div class="table-responsive table-card mt-3 mb-1">
    <table class="table align-middle table-nowrap" id="customerTable">
        <thead class="table-light">
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check-all">
                    </div>
                </th>
                <th class="">Nhóm sản phẩm</th>
                <th class=" text-center" style="width: 160px">Trạng thái</th>
                <th class=" text-end" style="width: 100px">Thao tác</th>
            </tr>
        </thead>
        <tbody class="list form-check-all">
            @foreach ($productCatalogues as $key => $item)
                <tr>
                    <th scope="row">
                        <div class="form-check">
                            <input class="form-check-input checkbox-item" type="checkbox" name="checkbox-item[]"
                                value="{{ $item->id }}">
                        </div>
                    </th>
                    <td class="customer_single_td" style="">
                        <img src="{{ $item->image ? $item->image : '/libaries/upload/images/img-notfound.png' }}"
                            alt="" class="object-fit-contain me-2 text-start bg-light rounded-2" width="120px" height="80px">
                        <div style="line-height: 2.2rem">
                            <div>
                                <span class="fw-medium fz-16">{{ $item->name }}</span>
                            </div>
                            <div>
                                <span>Danh mục cha:
                                    {{-- kiểm tra tham chiếu tới parent_id  --}}
                                    @if ($item->parentReference)
                                        <strong><a href="javascript:void(0)"
                                                class="text-danger pe-2">{{ $item->parentReference->name }}</a></strong>
                                    @else
                                        <strong><span class="text-success">Root</span></strong>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </td>

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
                                <li><a class="dropdown-item text-info"
                                        href="{{ route('product.catalogue.update', ['slug' => $item->slug]) }}"> <i
                                            class="ri-edit-box-line"></i>
                                        Chỉnh sửa</a></li>

                                <li><a class="dropdown-item text-danger"
                                        href="{{ route('product.catalogue.delete', ['id' => $item->id]) }}"><i
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
    {{ $productCatalogues->onEachSide(3)->links('pagination::bootstrap-5') }}
</div>
