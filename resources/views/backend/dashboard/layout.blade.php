<!doctype html>
<html lang="vn">
<head>
    @include('backend.dashboard.components.head')
</head>

<body>
    <div id="layout-wrapper">
        <!-- navbar header  -->
        @include('backend.dashboard.components.header')
        <!-- sidebar -->
        @include('backend.dashboard.components.sidebar')
        <!-- main content -->
        @include($template)
        <!-- footer  -->
        @include('backend.dashboard.components.footer')
        
    </div>
    <!-- footer  -->
    @include('backend.dashboard.components.script')
    @yield('js')
</body>

</html>