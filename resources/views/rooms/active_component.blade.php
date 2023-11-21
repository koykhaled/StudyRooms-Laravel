<div class="activities">
    <div class="activities__header">
        <h2>Recent Activities</h2>
    </div>
    @foreach ($messages as $message)
        <div class="activities__box">
            <div class="activities__boxHeader roomListRoom__header">
                <a href="profile.html" class="roomListRoom__author">
                    <div class="avatar avatar--small">
                        <img src="https://randomuser.me/api/portraits/women/11.jpg" />
                    </div>
                    <p>
                        {{$message->user->name}}
                        <span>{{$message->created_at}}</span>
                    </p>
                </a>
                @if (Auth::id() == $message->user_id)
                <div class="roomListRoom__actions">
                    <a href="{{route('message.destroy',$message->id)}}"
                        onclick="event.preventDefault(); document.getElementById('delete_message').submit();"
                        title="delete_message">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            viewBox="0 0 32 32">
                            <title>remove</title>
                            <path
                                d="M27.314 6.019l-1.333-1.333-9.98 9.981-9.981-9.981-1.333 1.333 9.981 9.981-9.981 9.98 1.333 1.333 9.981-9.98 9.98 9.98 1.333-1.333-9.98-9.98 9.98-9.981z">
                            </path>
                        </svg>
                    </a>
                    <form id="delete_message" method="post" action="{{route('message.destroy',$message->id)}}">
                        @csrf
                    </form>
                </div>
                @endif
            </div>
            <div class="activities__boxContent">
                <p>replied to post “<a href="room.html">{{$message->room->name}}</a>”</p>
                <div class="activities__boxRoomContent">
                    {{$message->message}}
                </div>
            </div>
        </div>
    @endforeach
   
</div>