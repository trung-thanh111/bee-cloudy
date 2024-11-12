<!DOCTYPE html>
<html lang="en">

<head>
    {{-- head  --}}
    @include('fontend.home.components.head')

</head>

<body>
    <!-- header  -->
    @include('fontend.home.components.header')
    <!-- end header  -->
    <div class="container-fluid p-0" id="app">
        @yield('content')
    </div>
    <!-- back to top  -->
    <!-- footer  -->
    @include('fontend.home.components.footer')

    <!-- end footer  -->
    @yield('js')

</body>
{{-- script  --}}
@include('fontend.home.components.script')

</html>
