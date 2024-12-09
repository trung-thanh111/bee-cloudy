@extends('fontend.home.layout')
@section('page_title')
    Chi tiết bài viết
@endsection
@section('content')
    <section id="app" >
        <article>
            <div class="container p-0">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="{{ route('post.page') }}"
                                class="text-decoration-none text-muted">Bài viết</a>
                        </li>
                        <li class="breadcrumb-item text-truncate active" aria-current="page">{{ $post->name }}</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->

                <div class="main-post">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-12 ">
                            <div class="post-item-detail text-muted">
                                <div class="image-detail-post">
                                    <img src="{{ $post->iamge }}" alt=""
                                        class="img-fluid rounded-top-3 object-fit-cover" width="100%"
                                        style="max-height: 400px;">
                                </div>
                            </div>
                            @php
                                $created_at_detail = $post->created_at ?? null;
                                $now_detail = now();
                                $dayDiffer_detail = date_diff($created_at_detail, $now_detail)->format('%a ngày trước');

                                $author_detail = optional($post->users()->first());
                                $authorName_detail = $author_detail->name ? $author_detail->name : $post->cre;
                                $imageAuthor_detail =
                                    $author_detail->image ??
                                    '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif';
                            @endphp
                            <div class="content-post-detail px-4 bg-white shadow py-3 rounded-bottom-3">
                                <div class="title-post-detail">
                                    <h2 class="text-muted fw-600 fs-2 text-break">{{ $post->name }}
                                    </h2>
                                </div>
                                <div class="author-date-post my-3">
                                    <span class="d-flex align-items-center">
                                        <img class="rounded-circle header-profile-user" src="{{ $imageAuthor_detail }}"
                                            alt="Avatar User" class="rounded-circle object-fit-cover" width="35"
                                            height="35">
                                        <span class="text-start ms-xl-2">
                                            <span class="d-none d-xl-inline-block ms-1 fz-14 fw-medium text-muted">
                                                {{ $authorName_detail }}
                                            </span>
                                            <span class="d-none d-xl-block ms-1 fz-10 text-warning">
                                                <i class="fa-regular fa-calendar-days fz-10 me-1"></i>
                                                {{ $dayDiffer_detail }}
                                            </span>
                                        </span>
                                    </span>
                                </div>
                                <div class="content-post-detail fz-14 text-muted mt-3">
                                    {!! $post->content !!}
                                </div>
                                <div class="cre-post text-end my-4">
                                    <span>Theo:
                                        <strong class="fst-italic">{{ $authorName_detail }}</strong>
                                    </span>
                                </div>
                            </div>
                            @if(Auth::check())
                            <div class="accordion shadow-sm text-muted mb-5 rounded-2 border-0 my-3">
                                <div class="accordion-item material-shadow ">
                                    <h2 class="accordion-header border-0" id="headingTow">
                                        <button class="accordion-button fz-16 fw-500 text-dark" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTow" aria-expanded="true"
                                            aria-controls="collapseTow">
                                            <span class="">Bình luận bài viết</span>

                                        </button>
                                    </h2>
                                    <div id="collapseTow" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTow" data-bs-parent="#default-accordion-example">
                                        <div class="accordion-body bg-white fz-14">
                                            <div class="post-comment">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-12 d-block justify-content-center">
                                                        <button type="button" class="btn border-0 px-0">
                                                            <span class="d-block align-items-center">
                                                                <img class="rounded-circle header-profile-user"
                                                                    src="{{ Auth::user()->image !== null ? Auth::user()->image : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif'}}"
                                                                    alt="Avatar User"
                                                                    class="rounded-circle object-fit-cover" width="60"
                                                                    height="60">
                                                                <p class="text-center mt-2">
                                                                    <span
                                                                        class="d-none d-xl-inline-block ms-1 fw-medium text-muted">{{ Auth::check() ? Auth::user()->name : 'Không xác định' }}</span>
                                                                </p>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <div
                                                        class="col-lg-10 col-md-10 col-12 d-block justify-content-center ps-0">
                                                        <form>
                                                            <div class="form-group position-relative w-100">
                                                                <textarea v-model="create.content" class=" textarea-comment form-control rounded-2  shadwo-sm" id="comment"
                                                                    rows="4" placeholder="Hãy cho chúng tôi biết ban đang nghĩ gì?"></textarea>
                                                                <button type="button"
                                                                    class="btn btn-success position-absolute z-3  py-1 px-4"
                                                                    style="bottom: 5px;right: 0px;"
                                                                    v-on:click="createContent()">Gửi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-coment mt-3 mb-2">
                                                <div class="py-2 me-3 mb-3">
                                                    <span class="fw-500 fz-16 ">Xem đánh giá (@{{ comment }})</span>
                                                </div>
                                                <template v-for="(v,k) in list">
                                                    <div class="row mx-2">
                                                        <div
                                                            class="col-lg-2 col-md-2 col-12 d-flex justify-content-end align-items-start" >
                                                            <button type="button" class="btn  border-0 px-0">
                                                                <span
                                                                    class="d-block justify-content-end align-items-center">
                                                                    <img class="rounded-circle header-profile-user"
                                                                        :src="v.image || '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif'"
                                                                        alt="Avatar User"
                                                                        class="rounded-circle object-fit-cover"
                                                                        width="50" 
                                                                        height="50">                                                   
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div
                                                            class="col-lg-10 col-md-10 col-12 d-block justify-content-center ps-0">
                                                            <div class="box-review">
                                                                <div class="review-item rounded-2 my-2">
                                                                    <div
                                                                        class="hstack gap-2 d-flex justify-content-start align-items-center">
                                                                        <div class="pt-2 d-inline-block">
                                                                         <h6>@{{ v.name }}</h6>
                                                                           
                                                                        </div>
                                                                        <div class="dropdown ms-auto ">
                                                                            <a class=" dropdown-toggle" href="#"
                                                                                role="button" data-bs-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                <i
                                                                                    class="fa-solid fa-ellipsis-vertical fz-14 text-muted"></i>
                                                                            </a>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-end border-0 ul-menu p-0 mb-1">
                                                                                <template v-if="v.user_id === {{ Auth::id() }}">
                                                                                    <li class="p-1 li-menu-header"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#delPosts"
                                                                                        v-on:click="del = Object.assign({}, v)">
                                                                                        <a href="#"
                                                                                            class="text-decoration-none text-danger fz-14 ps-1">
                                                                                            <i
                                                                                                class="fa-solid fa-trash me-2"></i>Xóa
                                                                                        </a>
                                                                                    </li>

                                                                                    <template v-if="v.edit_count === 0">
                                                                                        <li class="p-1 li-menu-header"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#updatePosts"
                                                                                            v-on:click="update = Object.assign({}, v)">
                                                                                            <a href="#"
                                                                                                class="text-decoration-none text-muted fz-14 ps-1">
                                                                                                <i
                                                                                                    class="fa-solid fa-circle-info me-2"></i>Chỉnh
                                                                                                sửa
                                                                                            </a>
                                                                                        </li>
                                                                                    </template>

                                                                                    <!-- Trường hợp edit_count là 1 (có thể thêm nội dung khác nếu cần) -->
                                                                                    <template v-if="v.edit_count === 1">
                                                                                        <!-- Nội dung cho trường hợp bình luận đã được chỉnh sửa, nếu cần -->
                                                                                    </template>
                                                                                </template>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="review-time">
                                                                        <span class="fz-12">@{{ v.date }}</span>
                                                                    </div>
                                                                    <div class="content-review mt-2">
                                                                        <p class="fz-14 fst-italic fw-500">
                                                                            @{{ v.content }}
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <div class="icon-reaction pb-2">
                                                                            <button class="like-button"
                                                                                v-on:click="Like(v)"
                                                                                style="border: none; background: none; padding: 0;">
                                                                                <i class="fa-regular fa-heart me-2"></i>
                                                                            </button>

                                                                            <span>@{{ v.like_count }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                                <!-- item review  -->

                                                <!-- phân trang bình luận  -->
                                                {{-- <div class="d-flex justify-content-center align-items-center mt-3">
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination pagination-sm">
                                                            <li class="page-item">
                                                                <a class="page-link" href="#"
                                                                    aria-label="Previous">
                                                                    <span aria-hidden="true">&laquo;</span>
                                                                </a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link active"
                                                                    href="#">1</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link"
                                                                    href="#">2</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link"
                                                                    href="#">3</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#" aria-label="Next">
                                                                    <span aria-hidden="true">&raquo;</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-12 col-12">
                            <div class="card border-0 rounded-1 my-4">
                                <div class="card-header">
                                    <h6 class="card-title fw-18 fw-500">Tìm kiếm</h6>
                                </div>
                                <div class="card-body py-2">
                                    <form action="{{ route('search') }}" method="get" class="">
                                        <div class="d-flex shadow-sm rounded-pill py-1 my-1 overflow-hidden bg-white">
                                            <input type="text" name="keyword"
                                                class="form-control border-0 py-2 ps-3 pe-0"
                                                placeholder="tìm theo ID, tiêu đề v.v.."
                                                value="{{ request('keyword') ?: old('keyword') }}"
                                                style="box-shadow: none;">
                                            <input type="hidden" name="type" value="post">

                                            <button type="submit" class="btn px-4 border-0">
                                                <i class="fas fa-search fz-18 text-muted"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card border-0 rounded-1 shadow-sm mb-4">
                                <div class="card-header">
                                    <h6 class="card-title fw-18 fw-500">Bài viết</h6>
                                </div>
                                <div class="card-body p-1">
                                    <div class="categoryP-item mb-3 overflow-y-auto">
                                        <ul class="list-group list-group-flush">
                                            @if (!is_null($postCatalogues) && !empty($postCatalogues))
                                                @foreach ($postCatalogues as $categoryP)
                                                    <li class="list-group-item item-category">
                                                        <a href="{{ route('post.category', ['id' => $categoryP->id]) }}"
                                                            class="text-decoration-none d-flex align-items-center">
                                                            <img src="{{ $categoryP->image }}"
                                                                alt="{{ $categoryP->name }}" width="50"
                                                                height="50"
                                                                class="me-3 object-fit-contain bg-light rounded-3 ">
                                                            <span class="text-muted fw-500">{{ $categoryP->name }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card border-0 rounded-1 shadow-sm mb-4 {{ count($postSimilar) == 0 ? 'd-none' : '' }}">
                                <div class="card-header">
                                    <h6 class="card-title fw-18 fw-500">Bài viết tương tự</h6>
                                </div>
                                <div class="card-body p-1">
                                    <div class="event-item mb-3">
                                        <ul class="ps-0 mb-0" class="overflow-y-hidden">
                                            @if ($postSimilar != null)
                                                @foreach ($postSimilar as $key => $valSimilar)
                                                    <li class="list-unstyled ">
                                                        <a href="{{ route('post.detail', ['slug' => $valSimilar->slug]) }}"
                                                            class="d-flex flex-wrap justify-content-start text-muted mb-2">
                                                            <div class="image-event-item position-relative col-5 pe-2">
                                                                <img src="{{ $valSimilar->image }}" alt=""
                                                                    width="100%" height="80"
                                                                    class="img-fuild rounded-2 object-fit-contain">
                                                            </div>
                                                            <div class="title-post col-7">
                                                                <h6 class="fz-16 fw-500 overflow-hidden text-break"
                                                                    style="height: 80px;">
                                                                    {{ $valSimilar->name }}
                                                                </h6>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <div class='modal fade' id='updatePosts' tabindex='-1' aria-labelledby='cập-nhật-bài-đăng' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='cập-nhật-bài-đăng'>Cập nhật bình luận</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Đóng'></button>
                </div>
                <div class="container my-4">
                    <label for="nội-dung" class="form-label">Nội dung:</label>
                    <textarea v-model="update.content" id="nội-dung" name="nội-dung" rows="4" required class="form-control"></textarea>
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn btn-primary" data-bs-dismiss='modal'
                        v-on:click="updateContent">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <div class='modal fade' id='delPosts' tabindex='-1' aria-labelledby='xóa-bài-đăng' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='xóa-bài-đăng'>Xóa bài đăng</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Đóng'></button>
                </div>
                <div class="container my-4">
                    Bạn có chắc chắn muốn xóa? Việc này không thể hoàn tác.
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn btn-danger" data-bs-dismiss='modal' v-on:click="deleteContent">Xác
                        nhận xóa</button>
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
                comment: 0,
                likes: [],
                likeCount: [],
                check: 0,
                isLiked: false,
                // names: []
            },
            created() {
                this.loadContent();
                this.LoadLike();
                this.Chekc();
            },
            methods: {
                loadContent() {
                    axios
                        .get('/view-content-data')
                        .then((res) => {
                            this.list = res.data.data;   
                            console.log(this.list);         
                            this.comment = res.data.comment_count;
                        });
                },
                createContent() {
                    axios
                        .post('/view-content-create', this.create)
                        .then((res) => {
                            if (res.data.code == 10) {
                                flasher.success(res.data.message);
                                this.create = {};
                                this.loadContent();
                            } else {
                                flasher.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                flasher.error(v[0], 'Error');
                            });
                        });
                },
                updateContent() {
                    axios
                        .post('/view-content-update', this.update)
                        .then((res) => {
                            if (res.data.code == 10) {
                                flasher.success(res.data.message);
                                this.loadContent();
                            } else {
                                flasher.error(res.data.message);
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
                            console.log(res);
                            
                            if (res.data.code == 10) {
                                flasher.success(res.data.message);
                                this.loadContent();
                            } else {
                                flasher.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },

                LoadLike() {
                    const url = new URL(window.location.href);
                    const pathname = url.pathname;
                    const slug = pathname.split('/').filter(Boolean).pop();
                    axios
                        .get('/content/like-data')
                        .then((res) => {
                            this.list = res.data.like_count;
                        })
                        .catch((res) => {})
                },

                Chekc() {
                    const url = new URL(window.location.href);
                    const pathname = url.pathname;
                    const slug = pathname.split('/').filter(Boolean).pop();
                    axios
                        .get('/content/check')
                        .then((res) => {
                            this.check = res.data.check;
                        })
                        .catch((res) => {
                            // $.each(res.response.data.errors, function(k, v) {});
                        })
                },
                Like(v) {
                    axios
                        .post('/content/like', v)
                        .then((res) => {
                            if (res.data.code == 10) {
                                this.LoadLike();
                                this.likeCount = res.data.like_count;
                                toaster.success(res.data.message);
                            }

                        })
                        .catch((res) => {
                            // $.each(res.response.data.errors, function(k, v) {});
                        });
                },

                toggleMenu(k) {
                    let menu = document.getElementById('menu-' + k);
                    menu.classList.toggle('show');
                }
            },
        });
    </script>
@endsection
