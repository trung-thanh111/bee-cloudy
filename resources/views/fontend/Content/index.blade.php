@extends('fontend.home.layout')
@section('page_title')
    Đánh Giá Sản Phẩm
@endsection
@section('content')
    <div class="container" id="app">
        <div class="" style="text-align: right;margin-top: 10px; display: flex;justify-content: space-between">
            <h1 style="color: rgb(85,85,85)">
                Bài Viết
            </h1>
            <button class="btn-create" data-bs-toggle='modal' data-bs-target='#createPosts'>Create New</button>
        </div>
        <div class="content-body">

            <div class="card">
                <template v-for="(v,k) in list">
                    <div class="card" style="margin-bottom: 10px">
                        <div class="content-item">
                            <div class="name">
                                <img class="name-img"
                                    src="http://127.0.0.1:8000/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif"
                                    alt="Image 1">
                                <div class="">
                                    <h5 style="color: rgb(85,85,85)" class="heading">@{{ v.name }}</h5>
                                    <p style="margin-top: -5px;font-size: 12px">@{{ v.date }}</p>
                                </div>
                            </div>

                            <div class="date">
                                <div class="like-container">
                                    <button v-on:click="Like(k)" :id="'likeBtn-' + k" class="like-btn">
                                        👍 Like <span :id="'likeCount-' + k">0</span>
                                    </button>
                                </div>
                                <div class="dropdown">
                                    <div class="dots-icon" v-on:click="toggleMenu(k)">
                                        &#x22EE;
                                    </div>
                                    <div :id="'menu-' + k" class="dropdown-menu">
                                        <a href="#" data-bs-toggle='modal' data-bs-target='#updatePosts'
                                            v-on:click="update = Object.assign({},v)">Chỉnh sửa</a>
                                        <a href="#" data-bs-toggle='modal' data-bs-target='#delPosts'
                                            v-on:click="del = Object.assign({},v)">Xóa</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-content">
                            <p>@{{ v.content }}</p>
                        </div>
                        <div class="image-gallery">
                            <div class="gallery">
                                <img v-bind:src="v.img" alt="Image 1">
                            </div>
                        </div>
                    </div>
                </template>

            </div>
        </div>
    </div>


    <div class='modal fade' id='createPosts' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>
                        Create a New Post
                    </h1>
                    <button type='button' class='btn-close content' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class="container">
                    <label for="content">Content:</label>
                    <textarea v-model="create.content" id="content" name="content" rows="4" required></textarea>

                    <label for="image">Image URL:</label>
                    <input v-model="create.img" type="text" id="image" name="image">
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn-content" data-bs-dismiss='modal'
                        v-on:click="createContent">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class='modal fade' id='updatePosts' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>
                        Update a Post
                    </h1>
                    <button type='button' class='btn-close content' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class="container">
                    <label for="content">Content:</label>
                    <textarea v-model="update.content" id="content" name="content" rows="4" required></textarea>

                    <label for="image">Image URL:</label>
                    <input v-model="update.img" type="text" id="image" name="image">
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn-content" data-bs-dismiss='modal' v-on:click="updateContent">Xác
                        Nhận</button>
                </div>
            </div>
        </div>
    </div>

    <div class='modal fade' id='delPosts' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>
                        Delete a Post
                    </h1>
                    <button type='button' class='btn-close content' data-bs-dismiss='modal'
                        aria-label='Close'></button>
                </div>
                <div class="container">
                    Bạn có chắc chăn muốn xóa bài viết này? Việc này không thể hoàn tác được.
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn-content" data-bs-dismiss='modal' v-on:click="deleteContent">Xác
                        Nhận Xóa</button>
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
                list: [],
                create: {},
                update: {},
                del: {},
                likes: []
            },
            created() {
                this.loadContent();
            },
            methods: {
                loadContent() {
                    axios
                        .get('/view-content-data')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                createContent() {
                    axios
                        .post('/view-content-create', this.create)
                        .then((res) => {
                            if (res.data.status) {
                                alert(res.data.message);
                                this.create = {};
                                this.loadContent();
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
                updateContent() {
                    axios
                        .post('/view-content-update', this.update)
                        .then((res) => {
                            if (res.data.status) {
                                alert(res.data.message);
                                this.loadContent();
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
                deleteContent() {
                    axios
                        .post('/view-content-delete', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                alert(res.data.message);
                                this.loadContent();
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

                Like(k) {
                    if (this.likes[k] === 0) {
                        this.likes[k] = 1;
                    } else {
                        this.likes[k] = 0;
                    }
                    let likeCountElement = document.getElementById('likeCount-' + k);
                    likeCountElement.textContent = this.likes[k];
                },

                toggleMenu(k) {
                    let menu = document.getElementById('menu-' + k);
                    menu.classList.toggle('show');
                }
            },
        });
    </script>
@endsection
