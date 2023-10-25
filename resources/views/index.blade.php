
    @extends('layouts.main')
    @section('index')
    <main class="layout layout--3">
      <div class="container">
        {{--  Topics Start --}}
          @include('rooms.tobics_component')
        {{-- <!-- Topics End --> --}}

        {{-- <!-- Room List Start --> --}}
          @include('rooms.room_component')
        {{-- <!-- Room List End -- --}}

        {{-- <!-- Activities Start -->         --}}
          @include('rooms.active_component')
        {{-- <!-- Activities End -->  --}}
      </div>
    </main>
    @endsection
