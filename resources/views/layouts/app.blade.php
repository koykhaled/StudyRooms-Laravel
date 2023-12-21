<!DOCTYPE html>
<html lang="en">

<head>
    {{-- @notifyCss --}}
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ secure_asset('assets/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ secure_asset('vendor/mckenziearts/laravel-notify/js/notify.js') }}" />
    <link rel="stylesheet" href="{{ secure_asset('css/dashboard/style.css') }}" />
    <title>@yield('title')</title>
</head>

<body>

    <div class="main">
        @include('admin.navbar')
        @yield('index')
        @yield('topics')
        @yield('create_topics')
    </div>
    <div class="container">
        @include('admin.navigation')
    </div>



    <script src="{{ asset('js/script.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('js/dashboard/main.js') }}"></script>
    @notifyJs
</body>

</html>
