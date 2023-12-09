@extends('layouts.main')
@section('profile')
<main class="profile-page layout layout--3">
    <div class="container">
        <!-- Topics Start -->
        @include('rooms.tobics_component')
        <!-- Topics End -->

        <!-- Room List Start -->

        <div class="roomList">
            <x-notify::notify />
            <div class="profile">

                <div class="profile__avatar">
                    <div class="avatar avatar--large active">
                        @if ($user->photo == null)
                        <img src="{{asset('assets/avatar.svg')}}" />
                        @else
                        <img src="{{asset($user->photo)}}" />
                        @endif
                    </div>
                </div>
                <div class="profile__info">
                    <h3>{{$user->name}}</h3>
                    <p><span>@</span>{{$user->name}}</p>
                    @if (request()->user() ==$user)
                    <a href="{{route('profile.edit',$user->uuid)}}" class="btn btn--main btn--pill">Edit Profile</a>
                    <a href="{{route('profile.delete',$user->uuid)}}" class="btn btn--main btn--pill btn--delete">Delete
                        Profile</a>
                    @endif
                </div>
                <div class=" profile__about">
                    <h3>About</h3>
                    <p>
                        {{$user->description}}
                    </p>
                </div>
            </div>
            @if (count($rooms))
            <div class="roomList__header">
                <div>
                    <h2>Study Rooms Hosted by {{$user->name}}</a>
                    </h2>
                </div>
            </div>
            @include('rooms.room_component')
            @endif
        </div>
        <!-- Room List End -->

        <!-- Activities Start -->
        @include('rooms.active_component')
        <!-- Activities End -->
    </div>
</main>
@endsection