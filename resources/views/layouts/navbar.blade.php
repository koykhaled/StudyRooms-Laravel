<header class="header header--loggedIn">
    <div class="container">
        <a href="/" class="header__logo">
            <img src="{{asset('assets/logo.svg')}}" />
            <h1>Study Rooms</h1>
        </a>
        <form class="header__search" method="get" action="{{route('rooms.index')}}">
            <label>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                    <title>search</title>
                    <path
                        d="M32 30.586l-10.845-10.845c1.771-2.092 2.845-4.791 2.845-7.741 0-6.617-5.383-12-12-12s-12 5.383-12 12c0 6.617 5.383 12 12 12 2.949 0 5.649-1.074 7.741-2.845l10.845 10.845 1.414-1.414zM12 22c-5.514 0-10-4.486-10-10s4.486-10 10-10c5.514 0 10 4.486 10 10s-4.486 10-10 10z">
                    </path>
                </svg>
                <input name="q" placeholder="Search for rooms..." />
            </label>
        </form>
        <nav class="header__menu">


            <!-- Logged In -->

            <div class="header__user">
                @auth
                <a href="#">Notifications</a>
                <a href="{{route('profile.show',auth()->user()->uuid)}}">
                    <div class="avatar avatar--medium active">
                        @if (auth()->user()->photo == null)
                        <img src="{{asset('assets/avatar.svg')}}" />
                        @else
                        <img src="{{asset(auth()->user()->photo)}}" />
                        @endif
                    </div>
                    <p>{{auth()->user()->name}}<span>{{auth()->user()->email}}</span></p>
                    @endauth
                </a>
                <button class="dropdown-button">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <title>chevron-down</title>
                        <path d="M16 21l-13-13h-3l16 16 16-16h-3l-13 13z"></path>
                    </svg>
                </button>
            </div>

            <div class="dropdown-menu">
                <a href="{{route('profile.show',auth()->user()->uuid)}}" class="dropdown-link"><svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                        width="32" height="32" viewBox="0 0 32 32">
                        <title>tools</title>
                        <path
                            d="M27.465 32c-1.211 0-2.35-0.471-3.207-1.328l-9.392-9.391c-2.369 0.898-4.898 0.951-7.355 0.15-3.274-1.074-5.869-3.67-6.943-6.942-0.879-2.682-0.734-5.45 0.419-8.004 0.135-0.299 0.408-0.512 0.731-0.572 0.32-0.051 0.654 0.045 0.887 0.277l5.394 5.395 3.586-3.586-5.394-5.395c-0.232-0.232-0.336-0.564-0.276-0.887s0.272-0.596 0.572-0.732c2.552-1.152 5.318-1.295 8.001-0.418 3.274 1.074 5.869 3.67 6.943 6.942 0.806 2.457 0.752 4.987-0.15 7.358l9.392 9.391c0.844 0.842 1.328 2.012 1.328 3.207-0 2.5-2.034 4.535-4.535 4.535zM15.101 19.102c0.26 0 0.516 0.102 0.707 0.293l9.864 9.863c0.479 0.479 1.116 0.742 1.793 0.742 1.398 0 2.535-1.137 2.535-2.535 0-0.668-0.27-1.322-0.742-1.793l-9.864-9.863c-0.294-0.295-0.376-0.74-0.204-1.119 0.943-2.090 1.061-4.357 0.341-6.555-0.863-2.631-3.034-4.801-5.665-5.666-1.713-0.561-3.468-0.609-5.145-0.164l4.986 4.988c0.391 0.391 0.391 1.023 0 1.414l-5 5c-0.188 0.188-0.441 0.293-0.707 0.293s-0.52-0.105-0.707-0.293l-4.987-4.988c-0.45 1.682-0.397 3.436 0.164 5.146 0.863 2.631 3.034 4.801 5.665 5.666 2.2 0.721 4.466 0.604 6.555-0.342 0.132-0.059 0.271-0.088 0.411-0.088z">
                        </path>
                    </svg>
                    Settings</a>
                <a title="logout" href="{{route('logout')}}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{route('logout')}}" method="post">
                    @csrf
            </div>
            </form>

        </nav>
    </div>
</header>