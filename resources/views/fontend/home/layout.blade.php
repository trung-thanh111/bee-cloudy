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
            style="bottom: 90px; right: 25px;">
            <button class="button">
                <svg class="svgIcon" viewBox="0 0 384 512">
                    <path
                        d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z">
                    </path>
                </svg>
            </button>
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
