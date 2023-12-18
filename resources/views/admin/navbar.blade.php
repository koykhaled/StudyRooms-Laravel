<div class="topbar">

    <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>
    <!-- ========== Admin Profile ========= -->
    <div class="user">

        @auth
        <div class="avatar avatar--medium active">
            @if (auth()->user()->photo == null)
            <img src="{{ asset('assets/avatar.svg') }}" />
            @else
            <img src="{{ asset(auth()->user()->photo) }}" />
            @endif
        </div>
        <p>{{ auth()->user()->name }}<span>{{ auth()->user()->email }}</span></p>
        @endauth
    </div>
</div>