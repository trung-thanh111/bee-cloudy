@extends('fontend.home.layout')
@section('page_title')
    Đánh Giá Sản Phẩm
@endsection
@section('content')
    <div class="container" id="app">
        <div class="customer-comment">
            <h2>Khách hàng nói về sản phẩm</h2>
            <div class="slide-comment">
                <div class="slide1">
                    <p style=" font-size: 20px;font-weight: 600;"> Khách hàng vui lòng đánh giá về sản phẩm.</p>
                    <button class="btn-comment">
                        <p style="color: #fff; font-size: 16px;">Đánh giá về sản phẩm</p>
                    </button>
                </div>
                <div class="slide2">
                    <img src="https://fptshop.com.vn/img/imgStar.png?w=1920&q=100" alt="" class="img-content">
                </div>
            </div>
            <div class="comment-iterm">
                <div class="iterm-one">
                    <p style="font-size: 19px; font-weight: 600;">Bình Luận</p>
                </div>
                <div class="iterm-two">
                    <div class="rating">
                        <label style="margin-right: 5px" for="rating-select">Chất lượng sản phẩm: </label>
                        <select id="rating-select" v-model="create.publish">
                            <option selected value="0" style="color: black">--Chọn số sao--</option>
                            <option class="star" value="1">&#9733;</option>
                            <option class="star" value="2">&#9733;&#9733;</option>
                            <option class="star" value="3">&#9733;&#9733;&#9733;</option>
                            <option class="star" value="4">&#9733;&#9733;&#9733;&#9733;</option>
                            <option class="star" value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                        </select>
                    </div>
                    <div class="rating-value">Kết quả: <span id="rating-result">0</span> sao</div>
                </div>
            </div>

            <div class="text-input">
                <div class="text-1">
                    <input v-model="create.content" type="text" class="input-formlogin"
                        placeholder="Nhập nội dung bình luận của bạn! ">

                </div>
                <button class="text-2" v-on:click="DanhGiaSP()">
                    Gửi Bình Luận
                </button>
            </div>
            <div class="list-comment">
                <template v-if="list == 0">
                    <i style="font-size: 81px; color: #6c6565;" class=" fa-regular fa-comments"></i>
                    <p style="font-size: 17px;color: #6C6565;">Chưa có bình luận nào của khách hàng về bài viết này </p>
                </template>
                <template v-else>
                    <hr>
                    <div class="producreview">
                        <div class="item-comment" v-for="(v,k) in list">
                            <div class="user">
                                <div class="user-name">
                                    <div class="icon-user">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="name-user">
                                        @{{ v.name }}
                                    </div>
                                </div>
                                <div class="dropdown" style="margin-top: -15px;">
                                    <span class="dots">...</span>
                                    <div class="dropdown-content">
                                        <a href="#" v-on:click="edit = Object.assign({},v)" data-bs-toggle='modal'
                                            data-bs-target='#edit'>Chỉnh sửa</a>
                                        {{-- <a href="#">Xóa</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="sao">
                                <template v-if="v.publish == 1">
                                    <option class="star" value="1">&#9733;</option>
                                </template>
                                <template v-if="v.publish == 2">
                                    <option class="star" value="2">&#9733;&#9733;</option>
                                </template>
                                <template v-if="v.publish == 3">
                                    <option class="star" value="3">&#9733;&#9733;&#9733;</option>
                                </template>
                                <template v-if="v.publish == 4">
                                    <option class="star" value="4">&#9733;&#9733;&#9733;&#9733;</option>
                                </template>
                                <template v-if="v.publish == 5">
                                    <option class="star" value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                </template>
                                <p>@{{ v.content }}</p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <div class='modal fade' id='edit' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Chỉnh sửa đánh giá sản phẩm</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <div class="comment-item">
                        <div class="item-two">
                            <div class="rating">
                                <label style="margin-right: 5px" for="rating-select">Chất lượng sản phẩm: </label>
                                <select id="rating-select" v-model="edit.publish">
                                    <option selected value="0" style="color: black">--Chọn số sao--</option>
                                    <option class="star" value="1">&#9733;</option>
                                    <option class="star" value="2">&#9733;&#9733;</option>
                                    <option class="star" value="3">&#9733;&#9733;&#9733;</option>
                                    <option class="star" value="4">&#9733;&#9733;&#9733;&#9733;</option>
                                    <option class="star" value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-input">
                            <input v-model="edit.content" style="width: 460px;outline: none;" type="text"
                                class="input-form" placeholder="Nhập nội dung bình luận của bạn!">
                        </div>
                        <div class="submit-btn">
                            <button v-on:click="Update()" class="btn-submit" style="background-color: red;color: #fff"
                                data-bs-dismiss='modal'>Gửi đánh giá</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                create: {},
                edit: {},
                list: [],
                image: null,
                imagePath: '',
            },
            created() {
                this.LoadBinhLuan();
            },
            methods: {

                LoadBinhLuan() {
                    axios
                        .get('/producreview-data')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                DanhGiaSP() {
                    axios
                        .post('/producreview-create', this.create)
                        .then((res) => {
                            if (res.data.status) {
                                // alert('...')
                                this.create = {};
                                this.LoadBinhLuan();
                                // toaster.success(res.data.message);
                            } else {
                                // toaster.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                Update() {
                    axios
                        .post('/producreview-update', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                this.create = {};
                                this.LoadBinhLuan();
                            } else {}
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
            },
        });
    </script>
@endsection
