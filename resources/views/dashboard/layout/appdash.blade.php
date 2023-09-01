<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="/" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta name="description" content="CoreUI - Bootstrap Admin Template" />
    <meta name="author" content="Łukasz Holeczek" />
    <meta name="keyword" content="Bootstrap,Admin,Template,SCSS,HTML,RWD,Dashboard" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png" /> --}}
    <link rel="manifest" href="assets/favicon/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />

    <link rel="stylesheet" href="/coreui/css/simplebar.css" />

    <link href="/coreui/css/style.css" rel="stylesheet" />

    <link href="/coreui/css/examples.css" rel="stylesheet" />
    <link href="/coreui/css/fontawesome.min.css" rel="stylesheet" />
    @vite(['resources/scss/dashboard.scss'])
    {{$styles ?? ''}}

</head>

<body>
    {{-- class="dark-theme" --}}
    @include("dashboard/parts/sidebar")

    {{-- @include("dashboard/parts/aside") --}}

    <div class="wrapper d-flex flex-column min-vh-100 bg-light dark:bg-transparent">
        @include("dashboard/parts/header")
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                
                {{-- @yield('content') --}}
                {{ $slot }}

            </div>
        </div>
        @include("dashboard/parts/footer")
    </div>

    <script src="/coreui/js/coreui.bundle.min.js"></script>
    <script src="/coreui/js/simplebar.min.js"></script>
    <script>
        if (document.body.classList.contains("dark-theme")) {
            var element = document.getElementById("btn-dark-theme");
            if (typeof element != "undefined" && element != null) {
                document.getElementById("btn-dark-theme").checked = true;
            }
        } else {
            var element = document.getElementById("btn-light-theme");
            if (typeof element != "undefined" && element != null) {
                document.getElementById("btn-light-theme").checked = true;
            }
        }

        function handleThemeChange(src) {
            var event = document.createEvent("Event");
            event.initEvent("themeChange", true, true);

            if (src.value === "light") {
                document.body.classList.remove("dark-theme");
            }
            if (src.value === "dark") {
                document.body.classList.add("dark-theme");
            }
            document.body.dispatchEvent(event);
        }
    </script>
    <script src="/coreui/js/coreui-utils.js"></script>

    {{ $scripts ?? ''}}

</body>

</html>