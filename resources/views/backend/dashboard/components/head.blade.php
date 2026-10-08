<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<base href="{{ config('app.app.url') }}">
<title>Bee Cloudy</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="/libaries/upload/images/logo/logo_index.png">
<!-- jsvectormap css -->
<link href="/libaries/templates/bee-cloudy-admin/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
<link href="/libaries/templates/bee-cloudy-user/libaries/css/style.css" rel="stylesheet" type="text/css" />
<link href="/libaries/css/custom.css" rel="stylesheet" type="text/css" />
<!--Swiper slider css-->
<link href="/libaries/templates/bee-cloudy-admin/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
<!-- Layout config Js -->
<script src="/libaries/templates/bee-cloudy-admin/assets/js/layout.js"></script>
<!-- Bootstrap Css -->
<link href="/libaries/templates/bee-cloudy-admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="/libaries/templates/bee-cloudy-admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="/libaries/templates/bee-cloudy-admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />
<!-- select2 css  -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
{{-- niceSelect  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css">
{{-- switchery css  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.css">
<!-- custom Css-->
<link href="/libaries/templates/bee-cloudy-admin/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
{{-- khai báo base_url để conect ckfinder vs ckeditor  --}}
<script>
    var BASE_URL = '{{ config('app.url') }}'
</script>
