<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row" id="app">
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
                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                    <div class="table-responsive table-card mt-3 mb-1">
                                                        <table class="table align-middle table-nowrap"
                                                            id="customerTable">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th scope="col" style="width: 50px;">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" id="check-all">
                                                                        </div>
                                                                    </th>
                                                                    <th class='text-start'>Kháng Hàng</th>
                                                                    <th class='text-start'>Sản Phẩm</th>
                                                                    <th class='text-start'>Nội Dung</th>
                                                                    <th class='text-center'>Đánh giá</th>
                                                                    <th class='text-center'>Lượt thích</th>
                                                                    <th class='text-center'>Thời gian</th>
                                                                    <th class="text-end" style="width: 90px">Thao tác
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <template v-for="(v , k) in list">
                                                                    <tr class='align-middle text-center'>
                                                                        <th class='align-middle'>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" id="check-boxitem">
                                                                            </div>
                                                                        </th>
                                                                        <td class='text-start text-truncate' style="max-width: 150px">
                                                                            @{{ v.ten_kh }}</td>
                                                                        <td class='text-start text-truncate'
                                                                            style="max-width: 200px">
                                                                            @{{ v.name }}</td>
                                                                        <td class='text-start'>@{{ v.content }}
                                                                        </td>
                                                                        <td class='text-center'>
                                                                            <div class="w-100" v-if="v.publish > 0">
                                                                                <span class="product-rate">
                                                                                    <i v-for="index in 5"
                                                                                        :key="index"
                                                                                        :class="[
                                                                                            'fas',
                                                                                            {
                                                                                                'fa-star': index <= Math
                                                                                                    .floor(v.publish),
                                                                                                'fa-star-half-alt': index ===
                                                                                                    Math.ceil(v
                                                                                                    .publish) && v
                                                                                                    .publish % 1 !== 0,
                                                                                                'far fa-star': index >
                                                                                                    Math.ceil(v.publish)
                                                                                            }
                                                                                        ]"
                                                                                        style="color: #FFD700;"></i>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                        <td class='text-center'>@{{ v.like_count }}
                                                                        </td>
                                                                        <td class="text-center">@{{ v.created_at }}
                                                                        </td>
                                                                        <td class='align-middle'>
                                                                            <div class="dropdown text-end">
                                                                                <a href="#" role="button"
                                                                                    id="dropdownMenu@{{ v.id + 1 }}"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    <i class="ri-more-2-fill fs-5"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu"
                                                                                    aria-labelledby="dropdownMenu@{{ v.id + 1 }}">
                                                                                    <li>
                                                                                        <a v-on:click="update = Object.assign({},v)"
                                                                                            data-bs-toggle='modal'
                                                                                            data-bs-target='#edit'
                                                                                            class="dropdown-item text-primary">
                                                                                            <i
                                                                                                class="fa-regular fa-pen-to-square me-2 align-middle"></i>Chỉnh
                                                                                            sửa
                                                                                        </a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a v-on:click="del = Object.assign({},v)"
                                                                                            data-bs-toggle='modal'
                                                                                            data-bs-target='#xoa'
                                                                                            class="dropdown-item text-danger">
                                                                                            <i
                                                                                                class="fa-solid fa-trash align-middle me-2"></i>Xóa
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
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
                                                                        <h1 class='modal-title fs-5'
                                                                            id='exampleModalLabel'>
                                                                            Chỉnh sửa đánh giá sản phẩm</h1>
                                                                        <button type='button' class='btn-close'
                                                                            data-bs-dismiss='modal'
                                                                            aria-label='Close'></button>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                        <div class="comment-item">
                                                                            <div class="item-two">
                                                                                <div class="rating">
                                                                                    <label style="margin-right: 5px"
                                                                                        for="rating-select">Chất lượng
                                                                                        sản phẩm:
                                                                                    </label>
                                                                                    <select id="rating-select"
                                                                                        v-model="update.publish"
                                                                                        class="form-select">
                                                                                        <option selected value="0"
                                                                                            style="color: black">--Chọn
                                                                                            số sao--
                                                                                        </option>
                                                                                        <option class="star"
                                                                                            value="1">
                                                                                            &#9733;</option>
                                                                                        <option class="star"
                                                                                            value="2">
                                                                                            &#9733;&#9733;</option>
                                                                                        <option class="star"
                                                                                            value="3">
                                                                                            &#9733;&#9733;&#9733;
                                                                                        </option>
                                                                                        <option class="star"
                                                                                            value="4">
                                                                                            &#9733;&#9733;&#9733;&#9733;
                                                                                        </option>
                                                                                        <option class="star"
                                                                                            value="5">
                                                                                            &#9733;&#9733;&#9733;&#9733;&#9733;
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-input mt-3">
                                                                                <label for=""> Nội Dung</label>
                                                                                <input v-model="update.content"
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Nhập nội dung bình luận của bạn!">
                                                                            </div>
                                                                            <div class="submit-btn text-end">
                                                                                <button v-on:click="CapNhat()"
                                                                                    class="btn mt-3"
                                                                                    style="background-color: rgb(0, 162, 255);color: #fff"
                                                                                    type="button"
                                                                                    data-bs-dismiss='modal'>Xác
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
                                                                        <h1 class='modal-title fs-5'
                                                                            id='exampleModalLabel'>
                                                                            Xóa đánh giá sản phẩm</h1>
                                                                        <button type='button' class='btn-close'
                                                                            data-bs-dismiss='modal'
                                                                            aria-label='Close'></button>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                        Bạn chăc chắn muốn xóa đánh giá <b
                                                                            style="color: red">
                                                                            @{{ del.content }}</b>
                                                                        này!!!
                                                                    </div>
                                                                    <div class="submit-btn text-end">
                                                                        <button v-on:click="Xoa()"
                                                                            class="btn me-3 mb-3 "
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
    @section('js')
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
                                    flasher.error(v[0], 'Error');
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
                                    flasher.error(v[0], 'Error');
                                });
                            });
                    }
                }
            });
        </script>
    @endsection
