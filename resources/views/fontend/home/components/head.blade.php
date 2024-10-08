<meta charset="UTF-8">
{{-- token  --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('page_title')</title>
<!-- css  -->
<link rel="stylesheet" href="/libaries/templates/bee-cloudy-user/libaries/css/style.css">
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
<!-- bootstrap5 css  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- animation  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<!-- select2 css  -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@vite(['resources/css/app.css'])
