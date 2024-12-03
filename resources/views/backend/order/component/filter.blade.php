<form id="searchForm" action="{{ route('order.index') }}" method="GET">
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
                                placeholder="Tìm kiếm code, khách hàng, phone..." aria-describedby="button-addon1">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @php
            $statusOrder = [
                'pending' => 'Chờ xác nhận',
                'confirmed' => 'Đã xác nhận',
                'shipping' => 'Đang vận chuyển',
                'canceled' => 'Đã hủy',
                'completed' => 'Thành công',
            ];
            // -- //
            $statusPayment = [
                'unpaid' => 'Chưa trả',
                'paid' => 'Đã trả',
                'failed' => 'Thất bại',
            ];
        @endphp
        <div class="col-sm-auto">
            <div class="d-flex">
                <div class="record ms-2">
                    <select name="payment" id="payment" class="form-control text-muted setUpSelect2"
                        style="max-width: 280px">
                        <option value="">[Thanh toán]</option>
                        @foreach ($statusPayment as $keyPey => $valPey)
                            <option value="{{ $keyPey }}" {{ request('payment') == $keyPey ? 'selected' : '' }}>
                                {{ $valPey }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-auto">
            <div class="d-flex">
                <div class="record ms-2">
                    <select name="status" id="status" class="form-control text-muted setUpSelect2"
                        style="max-width: 280px">
                        <option value="">[Trạng thái]</option>
                        @foreach ($statusOrder as $key => $val)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $val }}</option>
                        @endforeach
                    </select>
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
    </div>
</form>
