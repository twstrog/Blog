<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Favicon --}}
    @php
        $setting = App\Models\Setting::find(1);
    @endphp
    <link rel="icon" href="{{ asset('uploads/settings/' . $setting->favicon) }}" />

    <title>@yield('title')</title>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- FontAwesome --}}
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    {{-- Styles --}}
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    {{-- DataTables --}}
    <link href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    {{-- Summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    @yield('styles')
</head>

<body class="{{ session('theme', 'light') === 'dark' ? 'dark-mode' : '' }}">
    @include('layouts.inc.admin-navbar')

    <div id="layoutSidenav">
        @include('layouts.inc.admin-sidebar')
        <div id="layoutSidenav_content">
            <div id="loading-screen">
                <div class="spinner">
                    <img src="https://nmc.id.vn/assets/images/apple-touch-icon.png" alt="Logo">
                </div>
            </div>

            <main style="display: none;" id="main-content">
                @yield('content')
            </main>
            @include('layouts.inc.admin-footer')
        </div>
    </div>

    <script>
        window.addEventListener("load", function() {
            const loadingScreen = document.getElementById("loading-screen");
            loadingScreen.style.display = "none";

            const mainContent = document.getElementById("main-content");
            mainContent.style.display = "block";
        });
    </script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/theme-toggle.js') }}"></script>

    {{-- CDN Link Summernote JS --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        new DataTable('#myDataTable');
    </script>

    <script>
        $(document).ready(function() {
            $("#summernote").summernote({
                height: 250
            });
            $("#summernote").dropdown();
        });
    </script>
    @yield('scripts')
</body>

</html>
