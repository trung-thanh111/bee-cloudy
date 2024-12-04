@extends('fontend.home.layout')
@section('page_title')
    Danh mục bài viết
@endsection
@section('content')
    <section>
        <article>
            <div class="container p-0">
                <!-- breadcrumb  -->
                <nav class="pt-3 pb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-color-white pt-2 pb-2 ps-2 shadow-sm mb-0 p-3 bg-body-tertiary fz-14">
                        <li class="breadcrumb-item "><a href="{{ route('post.page') }}" class="text-decoration-none text-muted">Bài viết</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
                    </ol>
                </nav>
                <!-- end breadcrumb  -->
                <div class="posts-main">
                    <div class="main-post-category row flex-wrap mx-0 bg-main-color shadow-sm rounded-1 mb-3 p-2">
                        <div class="col-lg-4 col-md-4 col-12 position-relative" style="height: 200px">
                            <div class="title-category position-absolute top-50 w-75 translate-middle" style="left: 50%;">
                                <h3 class="text-uppercase">{{ $postCatalogue->name }}</h3>
                                <p class="fz-14 mb-0 text-break overflow-hidden" style="max-height: 40px">
                                    {{ $postCatalogue->description }}</p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-12">
                            <div id="thumbnail-carousel3" class="splide">
                                <div class="splide__track">
                                    <ul class="splide__list ">
                                        @if ($postCatalogues != null)
                                            @foreach ($postCatalogues as $key => $valPostCategory)
                                                <li class="splide__slide mx-2">
                                                    <a href="{{ route('post.category', ['id' => $valPostCategory->id]) }}">
                                                        <img src="{{ $valPostCategory->image }}" alt="product post"
                                                            width="" height="100%"
                                                            class="img-fluid rounded-3 border-info border border-3"
                                                            style="filter: brightness(70%); padding: 2px;">
                                                        <div
                                                            class="card-body title-cate-post w-100 p-1 mt-5 text-center position-absolute top-50 start-50 translate-middle">
                                                            <h5 class="fw-medium">
                                                                <a href="{{ route('post.category', ['id' => $valPostCategory->id]) }}"
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
                        <div class="title-product mb-4 col-xl-3 col-lg-3 col-8">
                            <div class="price-banner">
                                <div
                                    class="price-content border-start border-info rounded-start-3 rounded-end-5 py-1 border-5 ps-2 shadow-sm d-flex align-items-center">
                                    <div class="price-icon">
                                        <i class="fa-solid fa-tags text-white"></i>
                                    </div>
                                    <h4 class="fs-5 fw-bold text-start text-uppercase mb-0 text-info">
                                        tin mỗi ngày
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="row bg-white py-3 rounded-2" >
                            <div class="col-lg-9 col-md-9 col-12 ">
                                @if ($postInCatagories != null && count($postInCatagories) > 0)
                                    @foreach ($postInCatagories as $key => $valPnew)
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
                                        <a href="{{ route('post.detail', ['slug' => $valPnew->slug]) }}" >
                                            <div
                                                class="post-flex bg-light rounded-3 d-flex justify-content-start align-items-center border-0 mb-4" >
                                                <div class="image-title-flex" >
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
                                @else
                                    <div class="order-null p-3">
                                        <div class="img-null text-center">
                                            <img src="/libaries/upload/images/order-null.png" alt="" class=""
                                                width="300" height="200">
                                        </div>
                                        <div class="flex flex-col text-center align-items-center">
                                            <h6 class="mb-2  fw-semibold">Danh mục hiện chưa có bài viết!
                                            </h6>
                                            <p class="text-center mb-2">
                                                Chúng tôi sẽ cập nhật bài viết sớm nhất!
                                            </p>
                                            <a href="{{ route('post.page') }}"
                                                class="btn btn-info text-white rounded-pill mt-3">Khám
                                                phá ngay </a>
                                        </div>
                                    </div>
                                @endif
                                <div class="pagination pagination-sm justify-content-center">
                                    {{ $postInCatagories->onEachSide(3)->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-12">
                                <div class="card border-0 rounded-1 mb-4 shadow-sm">
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
                                        <h6 class="card-title fw-18 fw-500">Danh mục</h6>
                                    </div>
                                    <div class="card-body p-1">
                                        <div class="categoryP-item mb-3 overflow-y-auto">
                                            <ul class="list-group  list-group-flush">
                                                @if (!is_null($postCatalogues) && !empty($postCatalogues))
                                                    @foreach ($postCatalogues as $catalogueP)
                                                        <li class="list-group-item item-category">
                                                            <a href="{{ route('post.category', ['id' => $catalogueP->id]) }}"
                                                                class="text-decoration-none d-flex align-items-center">
                                                                <img src="{{ $catalogueP->image }}"
                                                                    alt="{{ $catalogueP->name }}" width="50"
                                                                    height="50"
                                                                    class="me-3 object-fit-contain bg-light rounded-3 ">
                                                                <span
                                                                    class="text-muted fw-500">{{ $catalogueP->name }}</span>
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
                                        <div class="categoryP-item mb-3 overflow-y-auto">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
