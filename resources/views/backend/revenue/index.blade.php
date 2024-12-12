<div class="main-content" id="app">
    <div class="page-content">
        <div class="container-fluid bg-white">
            <div class="card-header d-flex py-3 justify-content-between">
                <h4 class="card-title mb-0  text-uppercase">Thống kê doanh thu</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Thống kê doanh thu</li>
                    </ol>
                </div>
            </div>

            <div class="row mb-4 mt-5">
                <div class="col-lg-4">
                    <label for="time-range" class="form-label">Chọn khoảng thời gian bạn muốn thống kê:</label>
                    <div class="d-flex">
                        <input v-model="date.tu_ngay" type="date" name="" id="" style=" width: 200px"
                            class="form-control me-3">
                        <input v-model="date.den_ngay" :max="today" type="date" name=""
                            id="" style=" width: 200px" class="form-control me-3">
                        <button id="view-button" v-on:click="ThongKe()" class="btn btn-primary">Xem</button>
                    </div>
                </div>
            </div>


            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card bg-success text-white text-center">
                        <div class="card-body">
                            <h4 class="card-title fs-2 fw-600">Doanh thu</h4>
                            <p class="card-text fs-3">@{{ formatCurrency(tong_tien) }} VNĐ</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card bg-warning text-white text-center">
                        <div class="card-body">
                            <h4 class="card-title fs-2 fw-600">Đơn hàng</h4>
                            <p class="card-text fs-3">@{{ Don_hang }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Table -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <h4>Bảng chi tiết doanh thu</h4>
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>STT</th>
                                <th>Ngày</th>
                                <th>Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(v,k) in list">
                                <tr>
                                    <td>@{{ k + 1 }}</td>
                                    <td>@{{ formatDate(v.created_at) }}</td>
                                    <td>@{{ formatCurrency(v.total_amount) }} VNĐ</td>
                                </tr>
                            </template>


                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                date: {},
                list: [],
                tong_tien: 0,
                Don_hang: 0,
                today: '',
            },
            created() {
                this.today = this.getToday();
            },
            methods: {
                ThongKe() {
                    axios
                        .post('/admin/thong-ke-data', this.date)
                        .then((res) => {
                            this.list = res.data.data;
                            console.log(this.list);
                            this.tong_tien = res.data.tong_tien;
                            this.Don_hang = res.data.Don_hang;
                        });
                },
                getToday() {
                    const now = new Date();
                    return now.toISOString().split('T')[0];
                },

                formatCurrency(value) {
                    if (!value) return '0';
                    return new Intl.NumberFormat('vi-VN').format(value);
                },

                formatDate(dateString) {
                    const options = {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                    };

                    const date = new Date(dateString);
                    return date.toLocaleString('en-GB', options).replace(',', '');
                },
            }
        });
    </script>
@endsection
