<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang không tồn tại</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="/libaries/images/app_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide.min.css">
    <!-- bootstrap5 css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <section>
        <div class="bg-dark text-center" style="padding: 141px 0" >
            <img src="/libaries/templates/bee-cloudy-user/libaries/images/error404.png" alt="" class="img-fluid "
                width="600" height="230">
            <div class="mt-3 text-white">
                <h4 class="text-uppercase">Trang không tồn tại! 😭</h4>
                <p class="text-white mb-4">Trang mà bạn tìm kiếm hiện chúng tôi chưa phát triển!</p>
                <a href="{{ route('home.index') }}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Về trang chủ</a>
            </div>
        </div>
    </section>
</body>

</html>

