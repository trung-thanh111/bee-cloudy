<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title mb-0 text-uppercase">Danh sách Đánh giá sản phẩm</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Danh sách Đánh giá sản phẩm</li>
                                </ol>
                            </div>
                        </div>

                        <div class="card-body" id="app">
                            <div class="listjs-table" id="customerList">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table class='table table-bordered'>
                                                    <thead>
                                                        <tr class='align-middle text-center'>
                                                            <th class='align-middle'>#</th>
                                                            <th class='align-middle'>Kháng Hàng</th>
                                                            <th class='align-middle'>Sản Phẩm</th>
                                                            <th class='align-middle'>Nội Dung</th>
                                                            <th class='align-middle'>Số Sao</th>
                                                            <th class='align-middle'>Số Like</th>
                                                            <th class='align-middle'>Ngày Đánh giá</th>
                                                            <th class='align-middle'>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <template v-for="(v , k) in list">
                                                            <tr class='align-middle text-center'>
                                                                <th class='align-middle'>@{{ k + 1 }}</th>
                                                                <td class='align-middle'>@{{ v.ten_kh }}</td>
                                                                <td class='align-middle'>@{{ v.name }}</td>
                                                                <td class='align-middle'>@{{ v.content }}</td>
                                                                <td class='align-middle'>@{{ v.publish }}</td>
                                                                <td class='align-middle'>@{{ v.like_count }}</td>
                                                                <td class='align-middle'>@{{ v.created_at }}</td>
                                                                <td class='align-middle'>
                                                                    <i v-on:click="update = Object.assign({},v)"
                                                                        class="fa-regular fa-pen-to-square me-3"
                                                                        data-bs-toggle='modal'
                                                                        data-bs-target='#edit'></i>
                                                                    <i class="fa-solid fa-trash"
                                                                        v-on:click="del = Object.assign({},v)"
                                                                        data-bs-toggle='modal'
                                                                        data-bs-target='#xoa'></i>
                                                                </td>
                                                            </tr>
                                                        </template>
                                                    </tbody>
                                                </table>
                                                <div class='modal fade' id='edit' tabindex='-1'
                                                    aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog modal-lg'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h1 class='modal-title fs-5' id='exampleModalLabel'>
                                                                    Chỉnh sửa đánh giá sản phẩm</h1>
                                                                <button type='button' class='btn-close'
                                                                    data-bs-dismiss='modal' aria-label='Close'></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <div class="comment-item">
                                                                    <div class="item-two">
                                                                        <div class="rating">
                                                                            <label style="margin-right: 5px"
                                                                                for="rating-select">Chất lượng sản phẩm:
                                                                            </label>
                                                                            <select id="rating-select"
                                                                                v-model="update.publish"
                                                                                class="form-select">
                                                                                <option selected value="0"
                                                                                    style="color: black">--Chọn số sao--
                                                                                </option>
                                                                                <option class="star" value="1">
                                                                                    &#9733;</option>
                                                                                <option class="star" value="2">
                                                                                    &#9733;&#9733;</option>
                                                                                <option class="star" value="3">
                                                                                    &#9733;&#9733;&#9733;</option>
                                                                                <option class="star" value="4">
                                                                                    &#9733;&#9733;&#9733;&#9733;
                                                                                </option>
                                                                                <option class="star" value="5">
                                                                                    &#9733;&#9733;&#9733;&#9733;&#9733;
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-input mt-3">
                                                                        <label for=""> Nội Dung</label>
                                                                        <input v-model="update.content" type="text"
                                                                            class="form-control"
                                                                            placeholder="Nhập nội dung bình luận của bạn!">
                                                                    </div>
                                                                    <div class="submit-btn text-end">
                                                                        <button v-on:click="CapNhat()" class="btn mt-3"
                                                                            style="background-color: rgb(0, 162, 255);color: #fff"
                                                                            type="button" data-bs-dismiss='modal'>Xác
                                                                            Nhận</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='modal fade' id='xoa' tabindex='-1'
                                                    aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog '>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h1 class='modal-title fs-5' id='exampleModalLabel'>
                                                                    Xóa đánh giá sản phẩm</h1>
                                                                <button type='button' class='btn-close'
                                                                    data-bs-dismiss='modal'
                                                                    aria-label='Close'></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                Bạn chăc chắn muốn xóa đánh giá <b style="color: red">
                                                                    @{{ del.content }}</b>
                                                                này!!!
                                                            </div>
                                                            <div class="submit-btn text-end">
                                                                <button v-on:click="Xoa()" class="btn me-3 mb-3 "
                                                                    style="background-color: rgb(0, 162, 255);color: #fff"
                                                                    type="button" data-bs-dismiss='modal'>Xác
                                                                    Nhận</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    new Vue({
        el: '#app',
        data: {
            list: [],
            update: {},
            del: {},
        },
        created() {
            this.LoadDanhGia();
        },
        methods: {
            LoadDanhGia() {
                axios
                    .get('/admin/producreview-data')
                    .then((res) => {
                        this.list = res.data.data;
                    });
            },
            CapNhat() {
                axios
                    .post('/producreview-update-admin', this.update)
                    .then((res) => {
                        if (res.data.status) {
                            // alert(res.data.message);
                            this.LoadDanhGia();
                        } else {}
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0], 'Error');
                        });
                    });
            },
            Xoa() {
                axios
                    .post('/producreview-delete-admin', this.del)
                    .then((res) => {
                        if (res.data.status) {
                            // alert(res.data.message);
                            this.LoadDanhGia();
                        } else {}
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0], 'Error');
                        });
                    });
            },

        }

    });
</script>
