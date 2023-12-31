<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ secure_asset('assets/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ secure_asset('vendor/mckenziearts/laravel-notify/js/notify.js') }}" />
    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}" />
    <title>StudyBuddy - Find study partners around the world!</title>
</head>

<body>

    @include('layouts.navbar')

    @yield('index')

    @yield('room_form')

    @yield('room')

    @yield('room_edit')

    @yield('delete_room')

    @yield('topics')

    @yield('profile')


    <script src="{{ secure_asset('js/script.js') }}"></script>
    <script src="{{ secure_asset('vendor/mckenziearts/laravel-notify/js/notify.js') }}"></script>
</body>

</html>
