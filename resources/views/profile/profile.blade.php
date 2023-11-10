@extends('layouts.main')
@section('profile')
<main class="profile-page layout layout--3">
  <div class="container">
    <!-- Topics Start -->
    @include('rooms.tobics_component')
    <!-- Topics End -->

    <!-- Room List Start -->
    <div class="roomList">
      <div class="profile">
        <div class="profile__avatar">
          <div class="avatar avatar--large active">
            <img src="https://randomuser.me/api/portraits/men/11.jpg" />
          </div>
        </div>
        <div class="profile__info">
          <h3>{{$user->name}}</h3>
          <p><span>@</span>{{$user->name}}</p>
          @if (request()->user() ==$user)
          <a href="{{route('profile.edit')}}" class="btn btn--main btn--pill">Edit Profile</a>
          <a href="{{route('profile.delete')}}" class="btn btn--main btn--pill" style="color: red;">Delete Profile</a>
          @endif
        </div>
        <div class="profile__about">
          <h3>About</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur illo tenetur
            facilis sunt nemo debitis quisquam hic atque aut? Ducimus alias placeat optio
            accusamus repudiandae quis ab ex exercitationem rem?
          </p>
        </div>
      </div>

      <div class="roomList__header">
        <div>
          <h2>Study Rooms Hosted by {{$user->name}}</a>
          </h2>
        </div>
      </div>
      @include('rooms.room_component')
    </div>
    <!-- Room List End -->

    <!-- Activities Start -->
    @include('rooms.active_component')  
    <!-- Activities End -->
  </div>
</main>
@endsection