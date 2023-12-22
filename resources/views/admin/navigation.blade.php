<div class="navigation">
    <ul>
        <li>
            <a href="{{ route('rooms.index') }}" class="header__logo">
                <img src="{{ secure_asset('assets/logo.svg') }}" />
                <h2>Study Rooms</h2>
            </a>
        </li>
        <li>
            <a href="{{ route('dashboard') }}">
                <span class="icon">
                    <ion-icon name="home-outline"></ion-icon>
                </span>
                <span class="title">Home</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}">
                <span class="icon">
                    <ion-icon name="person-outline"></ion-icon>
                </span>
                <span class="title">Users</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.rooms') }}">
                <span class="icon">
                    <ion-icon name="book-outline"></ion-icon>
                </span>
                <span class="title">Rooms</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.participants') }}">
                <span class="icon">
                    <ion-icon name="people-outline"></ion-icon>
                </span>
                <span class="title">Participants</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.topics') }}">
                <span class="icon">
                    <ion-icon name="grid-outline"></ion-icon>
                </span>
                <span class="title">Topics</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.messages') }}">
                <span class="icon">
                    <ion-icon name="chatbubbles-outline"></ion-icon>
                </span>
                <span class="title">Messages</span>
            </a>
        </li>
        <li>
            <a title="logout" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span
                    class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                </span>
                <span class="title">Logout</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="post">
                @csrf
            </form>
        </li>
    </ul>
</div>