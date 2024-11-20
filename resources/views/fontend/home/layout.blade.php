<!DOCTYPE html>
<html lang="en">

<head>
    {{-- head  --}}
    @include('fontend.home.components.head')
    @stack('styles')
</head>

<body>
    <!-- header  -->
    @include('fontend.home.components.header')
    <!-- end header  -->
    <div class="container-fluid p-0" id="app">
        <div class="loader-overlay" id="loader-overlay">
            <span class="loader"></span>
        </div>
        @yield('content')
    </div>
    <!-- back to top  -->
    <!-- footer  -->
    @include('fontend.home.components.footer')
    <div class="bg-white shadow-sm">
        <a href="#" class="text-decoration-none back-to-top text-end position-fixed z-3 d-none"
            style="bottom: 90px; right: 30px;">
            <div class=" border-2 rounded-circle">
                <i class="fa-solid fa-chevron-up fs-5 border-1 border-danger text-bg-secondary rounded-circle p-2"></i>
            </div>
        </a>
    </div>
</body>
{{-- script  --}}
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger intent="WELCOME" chat-title="BeeCloud_ChatBot" agent-id="26f51831-93bb-4eae-bccc-27b7f6d33532"
        language-code="vi"></df-messenger>
<!-- end footer  -->
@yield('js')
@include('fontend.home.components.script')
</html>
