@extends('fontend.home.layout')
@section('page_title')
    Chi tiết bài viết
@endsection
@section('content')
    <section id="app">
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
                                                                    src="/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif"
                                                                    alt="Avatar User"
                                                                    class="rounded-circle object-fit-cover" width="60"
                                                                    height="60">
                                                                <p class="text-center mt-2">
                                                                    <span
                                                                        class="d-none d-xl-inline-block ms-1 fw-medium text-muted">{{ Auth::user()->name }}</span>
                                                                </p>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <div
                                                        class="col-lg-10 col-md-10 col-12 d-block justify-content-center ps-0">
                                                        <form>
                                                            <div class="form-group position-relative ">
                                                                <textarea v-model="create.content" class=" textarea-comment form-control rounded-2  shadwo-sm" id="comment"
                                                                    rows="4" placeholder="Hãy cho chúng tôi biết ban đang nghĩ gì?"></textarea>
                                                                <button type="button"
                                                                    class="btn btn-success position-absolute z-3  py-1 px-4"
                                                                    style="bottom: 8px ; right: 20px;"
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
                                                            class="col-lg-2 col-md-2 col-12 d-flex justify-content-end align-items-start">
                                                            <button type="button" class="btn  border-0 px-0">
                                                                <span
                                                                    class="d-block justify-content-end align-items-center">
                                                                    <img class="rounded-circle header-profile-user"
                                                                        src="/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif"
                                                                        alt="Avatar User"
                                                                        class="rounded-circle object-fit-cover"
                                                                        width="50" height="50">
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
                                                                            <h6 class="fz-18 mb-0">@{{ v.name }}
                                                                            </h6>
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
                                                                                <li class="p-1 li-menu-header"
                                                                                    data-bs-toggle='modal'
                                                                                    data-bs-target='#delPosts'
                                                                                    v-on:click="del = Object.assign({},v)">
                                                                                    <a href="#"
                                                                                        class="text-decoration-none text-danger fz-14 ps-1">
                                                                                        <i
                                                                                            class="fa-solid fa-trash me-2"></i>Xóa
                                                                                    </a>
                                                                                </li>
                                                                                <template v-if="v.edit_count == 0">
                                                                                    <li class="p-1 li-menu-header"
                                                                                        data-bs-toggle='modal'
                                                                                        data-bs-target='#updatePosts'
                                                                                        v-on:click="update = Object.assign({},v)">
                                                                                        <a href="#"
                                                                                            class="text-decoration-none text-muted fz-14 ps-1">
                                                                                            <i
                                                                                                class="fa-solid fa-circle-info me-2"></i>Chỉnh
                                                                                            sửa
                                                                                        </a>
                                                                                    </li>
                                                                                </template>
                                                                                <template v-if="v.edit_count == 1">

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
                                                                    <div class="icon-reaction pb-2">
                                                                        <button v-on:click="Like(k)"
                                                                            :id="'likeBtn-' + k">
                                                                            <i class="fa-regular fa-heart me-2"></i>
                                                                        </button>
                                                                        <span :id="'likeCount-' + k">0</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                                <!-- item review  -->

                                                <!-- phân trang bình luận  -->
                                                <div class="d-flex justify-content-center align-items-center mt-3">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-12 mt-4">
                            <div class="card border-0 rounded-1 mb-4">
                                <div class="card-header">
                                    <h6 class="card-title fw-18 fw-500">Tìm kiếm</h6>
                                </div>
                                <div class="card-body py-2">
                                    <form action="{{ route('search') }}" method="get" class="d-none d-md-block ">
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
                                    <h6 class="card-title fw-18 fw-500">Danh mục</h6>
                                </div>
                                <div class="card-body p-1">
                                    <div class="categoryP-item mb-3 overflow-y-scroll">
                                        <ul class="list-group list-group-flush">
                                            @if (!is_null($postCatalogues) && !empty($postCatalogues))
                                                @foreach ($postCatalogues as $catalogueP)
                                                    <li class="list-group-item item-category">
                                                        <a href="{{ route('post.category', ['id' => $catalogueP->id]) }}"
                                                            class="text-decoration-none d-flex align-items-center">
                                                            <img src="{{ $catalogueP->image }}"
                                                                alt="{{ $catalogueP->name }}" width="50"
                                                                height="50"
                                                                class="me-3 object-fit-contain bg-light rounded-3 ">
                                                            <span class="text-muted fw-500">{{ $catalogueP->name }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 rounded-1 shadow-sm mb-4">
                                <div class="card-header">
                                    <h6 class="card-title fw-18 fw-500">Sản phẩm</h6>
                                </div>
                                <div class="card-body p-1">
                                    <div class="categoryP-item mb-3 overflow-y-scroll">
                                        <ul class="list-group list-group-flush">
                                            @if (!is_null($productCategories) && !empty($productCategories))
                                                @foreach ($productCategories as $cataloguePro)
                                                    <li class="list-group-item item-category">
                                                        <a href="{{ route('product.category', ['id' => $cataloguePro->id]) }}"
                                                            class="text-decoration-none d-flex align-items-center">
                                                            <img src="{{ $cataloguePro->image }}"
                                                                alt="{{ $cataloguePro->name }}" width="50"
                                                                height="50"
                                                                class="me-3 object-fit-contain bg-light rounded-3 ">
                                                            <span
                                                                class="text-muted fw-500">{{ $cataloguePro->name }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card border-0 rounded-1 shadow-sm mb-4">
                                <div class="card-header">
                                    <h6 class="card-title fw-18 fw-500">Khuyến mãi</h6>
                                </div>
                                <div class="card-body p-1">
                                    <div class="event-item mb-3">
                                        <ul class="ps-0 mb-0">
                                            <li class="list-unstyled d-flex justify-content-start text-muted mb-3">
                                                <div class="image-event-item position-relative">
                                                    <img src="/libaries/images/banner_aside.jpg" alt=""
                                                        width="100%" class="img-fuild  me-2">
                                                    <i
                                                        class="fa-solid fa-delete-left delete-banner-aside fz-14 text-muted position-absolute top-0 end-0"></i>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 rounded-1 shadow-sm mb-4">
                                <div class="card-header">
                                    <h6 class="card-title fw-18 fw-500">Quảng cáo</h6>
                                </div>
                                <div class="card-body p-1">
                                    <div class="ads-item mb-3">
                                        <ul class="ps-0 mb-0">
                                            <li class="list-unstyled d-flex justify-content-start text-muted mb-3">
                                                <div class=" position-relative">
                                                    <img src="/libaries/images/banner_aside.jpg" alt=""
                                                        width="100%" class="img-fuild  me-2 image-ads-item">
                                                    <i
                                                        class="fa-solid fa-delete-left delete-ads-aside fz-14 text-muted position-absolute top-0 end-0"></i>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                            @if ($postSimilar != null && count($postSimilar) > 0)
                                <div class="card border-0 rounded-1 shadow-sm mb-4">
                                    <div class="card-header">
                                        <h6 class="card-title fw-18 fw-500">Bài viết tương tự</h6>
                                    </div>
                                    <div class="card-body p-1">
                                        <div class="event-item mb-3">
                                            <ul class="ps-0 mb-0" class="overflow-y-hidden">
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
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <div class='modal fade' id='updatePosts' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>
                        Update a Post
                    </h1>
                    <button type='button' class='btn-close content' data-bs-dismiss='modal'
                        aria-label='Close'></button>
                </div>
                <div class="container">
                    <label for="content">Content:</label>
                    <textarea v-model="update.content" id="content" name="content" rows="4" required></textarea>


                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn-content" data-bs-dismiss='modal' v-on:click="updateContent">Xác
                        Nhận</button>
                </div>
            </div>
        </div>
    </div>
    <div class='modal fade' id='delPosts' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>
                        Delete a Post
                    </h1>
                    <button type='button' class='btn-close content' data-bs-dismiss='modal'
                        aria-label='Close'></button>
                </div>
                <div class="container">
                    Bạn có chắc chăn muốn xóa ? Việc này không thể hoàn tác được.
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn-content" data-bs-dismiss='modal' v-on:click="deleteContent">Xác
                        Nhận Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <a href="#" class="text-decoration-none back-to-top text-end position-fixed z-3 d-none"
            style="bottom: 60px; right: 30px;">
            <div class=" border-2 rounded-circle">
                <i class="fa-solid fa-chevron-up fs-5 border-1 border-danger text-bg-secondary rounded-circle p-2"></i>
            </div>
        </a>
        <!-- <div class=" live-chat ms-lg-16">
                                                            <a href="zalo">
                                                                <img class="rounded-circle " src="public/image/zalo.png" alt="" width="50">
                                                            </a>
                                                        </div> -->
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
                            this.comment = res.data.comment_count;
                            // console.log(this.comment);
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

                    let heartIcon = document.getElementById('likeBtn-' + k).querySelector('i');
                    if (this.likes[k] === 1) {
                        heartIcon.classList.remove('fa-regular');
                        heartIcon.classList.add('fa-solid');
                    } else {
                        heartIcon.classList.remove('fa-solid');
                        heartIcon.classList.add('fa-regular');
                    }
                },

                toggleMenu(k) {
                    let menu = document.getElementById('menu-' + k);
                    menu.classList.toggle('show');
                }
            },
        });
    </script>
@endsection
