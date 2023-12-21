<x-guest-layout>
    @section('title')
    Login
    @endsection
    <main class="auth layout">

        <div class="container">
            <div class="layout__box">

                <div class="layout__boxHeader">
                    <div class="layout__boxTitle">
                        <h3>Login</h3>
                    </div>
                </div>
                <div class="layout__body">
                    <h2 class="auth__tagline">Find your study partner</h2>
                    <x-validation-errors class="mb-4" style="color: red" />
                    <form class="form" action="" method="post">
                        @csrf
                        <div class="form__group form__group">
                            <label for="room_name">Email</label>
                            <input id="email" name="email" type="text" placeholder="e.g. khaled@example.com" />
                        </div>
                        <div class="form__group">
                            <label for="password">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
                        </div>

                        <button class="btn btn--main" type="submit">
                            <svg
                                version="1.1"
                                xmlns="http://www.w3.org/2000/svg"
                                width="32"
                                height="32"
                                viewBox="0 0 32 32">
                                <title>lock</title>
                                <path
                                    d="M27 12h-1v-2c0-5.514-4.486-10-10-10s-10 4.486-10 10v2h-1c-0.553 0-1 0.447-1 1v18c0 0.553 0.447 1 1 1h22c0.553 0 1-0.447 1-1v-18c0-0.553-0.447-1-1-1zM8 10c0-4.411 3.589-8 8-8s8 3.589 8 8v2h-16v-2zM26 30h-20v-16h20v16z">
                                </path>
                                <path
                                    d="M15 21.694v4.306h2v-4.306c0.587-0.348 1-0.961 1-1.694 0-1.105-0.895-2-2-2s-2 0.895-2 2c0 0.732 0.413 1.345 1 1.694z">
                                </path>
                            </svg>

                            Login
                        </button>
                    </form>

                    <div class="auth__action">
                        <p>Haven't signed up yet?</p>
                        <a href="{{route('register')}}" class="btn btn--link">Sign Up</a>
                    </div>
                    <x-notify::notify />
                </div>
            </div>
            <script src="{{ secure_asset('vendor/mckenziearts/laravel-notify/js/notify.js') }}"></script>
        </div>
    </main>
</x-guest-layout>