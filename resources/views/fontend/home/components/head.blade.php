<meta charset="UTF-8">
{{-- token  --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('page_title')</title>
<!-- Thẻ meta Open Graph -->
@if(isset($product))
    <meta property="og:title" content="{{$product ? $product->name : 'Tên sản phẩm mặc định'}}" />
    <meta property="og:info" content="{{$product ? $product->info : 'Mô tả mặc định'}}" />
    <meta property="og:image" content="{{$product ? asset($product->image) : asset('default-image.jpg')}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:type" content="product" />
    <meta property="og:price:amount" content="{{$product->del != 0 ? $product->del : $product->price}}" />
    <meta property="og:price:currency" content="VND" />
    <meta property="og:site_name" content="BeeCloudy" />
@endif

<!-- css  -->
<link rel="stylesheet" href="/libaries/templates/bee-cloudy-user/libaries/css/style.css">
<link rel="stylesheet" href="/libaries/templates/bee-cloudy-user/libaries/css/uiverse.css">
<link rel="stylesheet" href="/libaries/templates/bee-cloudy-user/libaries/css/custom_reponsive.css">
<!-- icon  -->
<!-- App favicon -->
<link rel="shortcut icon" href="/libaries/upload/images/logo/logo_index.png">
<!-- font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<!-- box-icon  -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<!-- splidejs css  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- bootstrap5 css  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- animation  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!-- select2 css  -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js"
    integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.5.12/vue.cjs.js"
    integrity="sha512-iytOXrJii6S43MWPla8yHP4Jt1CTor4HyilK2OOpKthWYBMZdce/L4izaniMAzZD7JVJrNr9tWc9w/spDJJ8Yw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    var BASE_URL = '{{ config('app.url') }}'
</script>
{{-- @vite(['resources/css/app.css']) --}}
