@extends('fontend.home.layout')
@section('page_title')
    Bài viết
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="#" class="text-decoration-none text-muted">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="posts-main">
                    <!-- <div class="header-post shadow-sm mb-3">
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-auto">
                                                                <div class="text-muted p-5 rounded-2">
                                                                    <span class="fs-2 text-uppercase text-center fw-bold">Bài viết</span>
                                                                </div>
                                                            </div>
                                                          </div>
                                                    </div> -->

                    <div class="main-post-category row flex-wrap mx-0 bg-main-color shadow-sm rounded-1 mb-3 p-2">
                        <div class="col-lg-4 col-md-4 col-12 position-relative" style="height: 200px">
                            <div class="title-category position-absolute top-50 w-75 translate-middle" style="left: 50%;">
                                <h5 class="text-uppercase">Danh mục bài viết</h5>
                                <p class="fz-12 mb-0">Bạn sẽ được đọc nhưng bài viết theo danh mục sau.</p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-12">
                            <div id="thumbnail-carousel3" class="splide">
                                <div class="splide__track">
                                    <ul class="splide__list ">
                                        @if ($postCategories != null)
                                            @foreach ($postCategories as $key => $valPostCategory)
                                                <li class="splide__slide mx-2">
                                                    <a href="#">
                                                        <img src="{{ $valPostCategory->image }}" alt="product post"
                                                            width="" height="100%"
                                                            class="img-fluid rounded-3 border-info border border-3"
                                                            style="filter: brightness(70%); padding: 2px;">
                                                        <div
                                                            class="card-body title-cate-post w-100 p-1 mt-5 text-center position-absolute top-50 start-50 translate-middle">
                                                            <h5 class="fw-medium">
                                                                <a href="#"
                                                                    class=" w-100 text-white text-uppercase fz-14 ">{{ $valPostCategory->name }}</a>
                                                            </h5>
                                                            <hr class="border-4 text-dark w-50 m-auto">
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
                    <hr class="border-5 border-secondary rounded-pill my-4">
                    <div class="main-post">
                        <div class="title-head-post">
                            <h5 class="fs-5 fw-500 mb-3 text-uppercase">
                                Nổi bật
                                <hr class=" border-4 border-info mb-2" style="width: 80px;">

                            </h5>
                        </div>
                        <div class="row flex-wrap">
                            <div class="col-lg-8 col-md-8 col-12">
                                <div id="main-carousel2" class="splide">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @if ($postStandC1 != null)
                                                @foreach ($postStandC1 as $key => $valPostStand)
                                                    @php
                                                        $created_at = $valPostStand->created_at;
                                                        $now = now();
                                                        $dayDiffer = date_diff($created_at, $now)->format(
                                                            '%a ngày trước',
                                                        );

                                                        $author = optional($valPostStand->users()->first());
                                                        $authorName = $author->name
                                                            ? $author->name
                                                            : $valPostStand->cre;
                                                        $imageAuthor =
                                                            $author->image ??
                                                            '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif';
                                                    @endphp

                                                    <li class="splide__slide">
                                                        <a
                                                            href="{{ route('post.detail', ['slug' => $valPostStand->slug]) }}">
                                                            <img src="{{ $valPostStand->image }}" alt="Post Image"
                                                                class="img-fluid object-fit-cover rounded-top-3"
                                                                width="100%" style="max-height: 450px !important;">

                                                            <div class="text-muted bg-white p-2 rounded-bottom-3">
                                                                <h5 class="title-post">{{ $valPostStand->name }}</h5>
                                                                <span class="fz-14 text-truncate mb-2">
                                                                    {!! $valPostStand->description !!}</span>

                                                                <span class="align-middle fz-14 me-3 fw-medium">
                                                                    <img src="{{ $imageAuthor }}" alt="Author"
                                                                        width="30" height="30"
                                                                        class="rounded-circle mb-1 me-2">{{ $authorName }}
                                                                </span>

                                                                <span class="align-middle fz-14">
                                                                    <i class="fa-regular fa-clock fz-16 me-2"></i>
                                                                    {{ $dayDiffer }}
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                @if ($postStandC2 != null)
                                    @foreach ($postStandC2 as $key => $valPostStand2)
                                        @php
                                            $created_atc2 = $valPostStand2->created_at;
                                            $nowc2 = now();
                                            $dayDifferc2 = date_diff($created_atc2, $nowc2)->format('%a ngày trước');

                                            $authorc2 = optional($valPostStand2->users()->first());
                                            $authorNamec2 = $authorc2->name ? $authorc2->name : $valPostStand2->cre;
                                            $imageAuthorc2 =
                                                $authorc2->image ??
                                                '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif';
                                        @endphp

                                        <div class="post-item shadow-sm rounded-2 mb-4">
                                            <a href="{{ route('post.detail', ['slug' => $valPostStand2->slug]) }}">
                                                <img src="{{ $valPostStand2->image }}" alt=""
                                                    class="img-fluid object-fit-cover rounded-top-3" width="100%"
                                                    style="max-height: 200px !important;">
                                                <div class="content-card-post bg-white text-muted p-2 rounded-bottom-3">
                                                    <h5 class="fz-18 title-post overflow-hidden mb-2" style="height: 43px;">
                                                        {{ $valPostStand2->name }}</h5>
                                                    <span class="align-middle fz-12 me-3 fw-medium">
                                                        <img src="{{ $imageAuthorc2 }}" alt="author post" width="30"
                                                            height="30"
                                                            class="rounded-circle mb-1 me-2">{{ $authorNamec2 }}
                                                    </span>
                                                    <span class="align-middle fz-12">
                                                        <i class="fa-regular fa-clock fz-12 me-2"></i>
                                                        {{ $dayDifferc2 }}
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row flex-wrap">
                            @if ($postStandC3 != null)
                                @foreach ($postStandC3 as $key => $valPostStand3)
                                    @php
                                        $created_atc3 = $valPostStand3->created_at;
                                        $nowc3 = now();
                                        $dayDifferc3 = date_diff($created_atc3, $nowc3)->format('%a ngày trước');

                                        $authorc3 = optional($valPostStand3->users()->first());
                                        $authorNamec3 = $authorc3->name ? $authorc3->name : $valPostStand3->cre;
                                        $imageAuthorc3 =
                                            $authorc3->image ??
                                            '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif';
                                    @endphp
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="post-item shadow-sm rounded-2 w-100 mb-4">
                                            <a href="{{ route('post.detail', ['slug' => $valPostStand3->slug]) }}">
                                                <img src="{{ $valPostStand3->image }}" alt=""
                                                    class="img-fluid object-fit-cover rounded-top-3" width="100%"
                                                    style="height: 200px !important;">
                                                <div class="content-card-post text-muted p-2 bg-white rounded-bottom-3">
                                                    <h6 class="fz-18 title-post overflow-hidden mb-2 "
                                                        style="height: 43px;">
                                                        {{ $valPostStand3->name }}</h6>
                                                    <span class="align-middle fz-12 me-3 fw-medium">
                                                        <img src="{{ $imageAuthorc3 }}" alt="author post" width="30"
                                                            height="30"
                                                            class="rounded-circle mb-1 me-2">{{ $authorNamec3 }}
                                                    </span>
                                                    <span class="align-middle fz-12">
                                                        <i class="fa-regular fa-clock fz-12 me-2"></i>
                                                        {{ $dayDifferc3 }}
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- bài viết nhiều like nhất sl6 -->
                        <div class="title-post-host mt-4">
                            <h5 class="fs-5 fw-500 mb-3 text-uppercase">
                                Yêu thích
                                <hr class=" border-4 border-info mb-2" style="width: 80px;">
                            </h5>
                        </div>
                        <div class="row mb-3 row-cols-3 bg-white shadow-sm rounded-2">
                            @if ($postLikes != null)
                                @foreach ($postLikes as $key => $valPostLike)
                                    <div class="col p-3">
                                        <a href="{{ route('post.detail', ['slug' => $valPostLike->slug]) }}">
                                            <div
                                                class="post-like d-flex justify-content-start align-items-center text-muted">
                                                <div class="rank-post">
                                                    <h1 class="me-3 text-secondary">#{{ $key + 1 }}</h1>
                                                </div>
                                                <h6 class=" fz-18 title-post text-break">{{ $valPostLike->name }}</h6>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="title-post-host mt-4">
                            <h5 class="fs-5 fw-500 mb-3 text-uppercase">
                                tin mỗi ngày
                                <hr class=" border-4 border-info mb-2" style="width: 80px;">
                            </h5>
                        </div>
                        <div class="row bg-white py-3 rounded-2">
                            <div class="col-lg-9 col-md-9 col-12 ">
                                @if ($postNew != null)
                                    @foreach ($postNew as $key => $valPnew)
                                        @php
                                            $created_atPostnew = $valPnew->created_at;
                                            $nowPostnew = now();
                                            $dayDifferPostnew = date_diff($created_atPostnew, $nowPostnew)->format(
                                                '%a ngày trước',
                                            );

                                            $authorPostnew = $valPnew->users->first();
                                            $authorNamePostnew = $authorPostnew
                                                ? $authorPostnew->name
                                                : 'Unknown Author';
                                            $imageAuthorPostnew =
                                                $authorPostnew && $authorPostnew->image
                                                    ? $authorPostnew->image
                                                    : '/libaries/templates/bee-cloudy-user/libaries/images/user-default.avif';
                                        @endphp
                                        <a href="{{ route('post.detail', ['slug' => $valPnew->slug]) }}">
                                            <div
                                                class="post-flex bg-light rounded-3 d-flex justify-content-start align-items-center border-0 mb-4">
                                                <div class="image-title-flex">
                                                    <img src="{{ $valPnew->image }}" alt="post image"
                                                        style="min-width: 240px; max-height: 150px;"
                                                        class="object-fit-cover rounded-start-3 me-3">
                                                </div>
                                                <div class="content-post">
                                                    <div class="content-card-post text-muted px-2 mt-2">
                                                        <div class="text-muted">
                                                            <h5 class="fz-18 title-post overflow-hidden mb-2"
                                                                style="height: 43px;">{{ $valPnew->name }}</h5>
                                                            <p class="fz-14 w-100 overflow-hidden mb-2"
                                                                style="height: 43px;">
                                                                {{ $valPnew->description }}</p>
                                                        </div>
                                                        <span class="align-middle fz-12 me-3 fw-medium">
                                                            <img src="{{ $imageAuthorPostnew }}" alt="author post"
                                                                width="30" height="30"
                                                                class="rounded-circle mb-1 me-2">{{ $authorNamePostnew }}
                                                        </span>
                                                        <span class="align-middle fz-12">
                                                            <i class="fa-regular fa-clock fz-12 me-2"></i>
                                                            {{ $dayDifferPostnew }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                                <div class="pagination pagination-sm justify-content-center">
                                    {{ $postNew->onEachSide(3)->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-12">
                                <div class="card border-0 rounded-1 mb-4 shadow-sm">
                                    <div class="card-header">
                                        <h6 class="card-title fw-18 fw-500">Tìm kiếm</h6>
                                    </div>
                                    <div class="card-body py-2">
                                        <form action="{{ route('search') }}" method="get"
                                            class=" d-none d-md-block ">
                                            <div class="input-group input-group-sm w-100 position-relative ">
                                                <input type="text" name="keyword" class="form-control rounded-start-2"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-sm"
                                                    placeholder="tìm theo ID, tiêu đề v.v ..">
                                                <input type="hidden" name="type" value="post">

                                                <button type="submit" class="input-group-text"
                                                    id="inputGroup-sizing-sm">
                                                    <i class='bx bx-search-alt-2'></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card border-0 rounded-1 mb-4 shadow-sm">
                                    <div class="card-header">
                                        <h6 class="card-title fw-18 fw-500">Bài viết</h6>
                                    </div>
                                    <div class="card-body py-2">
                                        <ul class="p-2 mb-0 list-inline">
                                            <li class="list-inline-item mb-2">
                                                <a href="#" class="btn btn-secondary btn-sm">#banchay</a>
                                            </li>
                                            <li class="list-inline-item mb-2">
                                                <a href="#" class="btn btn-secondary btn-sm">#sale</a>
                                            </li>
                                            <li class="list-inline-item mb-2">
                                                <a href="#" class="btn btn-secondary btn-sm">#newarrival</a>
                                            </li>
                                            <li class="list-inline-item mb-2">
                                                <a href="#" class="btn btn-secondary btn-sm">#fashion</a>
                                            </li>
                                            <li class="list-inline-item mb-2">
                                                <a href="#" class="btn btn-secondary btn-sm">#trending</a>
                                            </li>
                                            <li class="list-inline-item mb-2">
                                                <a href="#" class="btn btn-secondary btn-sm">#summer</a>
                                            </li>
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
