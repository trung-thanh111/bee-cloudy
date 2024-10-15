<main class="col-md-10 ms-sm-auto px-4">
   

    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="mb-0">Quản lí Voucher</h2>
        <button class="btn btn-success">Thêm Voucher</button>
    </div>

    <div class="bg-white p-4 rounded shadow-sm">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" class="form-check-input"></th>
                    <th>Mã Voucher</th>
                    <th>Tên Voucher</th>
                    <th>chiết khấu</th>
                    <th>Số lượng</th>
                    <th>Số tiền tối thiểu</th>
                    <th>Áp dụng</th>
                    <th>bắt đầu</th>
                    <th>kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vouchers as $item)
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->discount_value }}</td>
                        <td>{{ $item->usage_limit }}</td>
                        <td>{{ $item->minimum_amount }}</td>
                        <td>{{ $item->apply_for }}</td>
                        <td>{{ $item->start_date }}</td>
                        <td>{{ $item->end_date }}</td>
                        <td>
                            <!-- Hiển thị trạng thái active/inactive -->
                            @if ($item->status == 'active')
                                <span class="badge bg-success">Kích hoạt</span>
                            @else
                                <span class="badge bg-danger">Không kích hoạt</span>
                            @endif
                        </td>
                        <td>
                            <a href="" class="btn btn-primary">Sửa</a>
                            <form action="" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <!-- <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>xcvxbcb54</td>
                                <td>ABCXYZ</td>
                                <td>Giảm đơn hàng 50k</td>
                                <td>100</td>
                                <td>1</td>
                                <td>1</td>
                                <td>09/09/2024 - 20/09/2024</td>
                                <td><span class="badge bg-danger rounded-pill">Kết thúc</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Chỉnh sửa</button>
                                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                </td>
                            </tr> -->
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false">
                50/Trang
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">10/Trang</a></li>
                <li><a class="dropdown-item" href="#">20/Trang</a></li>
                <li><a class="dropdown-item" href="#">50/Trang</a></li>
            </ul>
        </div>
    </div>
</main>