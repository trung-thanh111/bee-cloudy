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
    @include($template)
    <!-- back to top  -->
    <!-- footer  -->
    @include('fontend.home.components.footer')

    <!-- end footer  -->
</body>
{{-- script  --}}
@include('fontend.home.components.script')

</html>
