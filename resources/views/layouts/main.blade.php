<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{asset('assets/favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>StudyBuddy - Find study partners around the world!</title>
</head>
<body>


    @include('layouts.navbar')

    @yield('dashboard')

    @yield('index')

    @yield('room_form')

    {{-- @yield('room_component') --}}

    @yield('room')

    @yield('room_edit')

    @yield('delete_room')

    @yield('topics')


    <script src="{{asset('js/script.js') }}"></script>
</body>

</html>