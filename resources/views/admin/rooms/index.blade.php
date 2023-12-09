<x-app-layout>

    @section('topics')
        <div class="details">
            <div class="topic__header">
                <div>
                    <h2>Rooms</h2>
                    <p> {{ $rooms_count }} rooms</p>
                </div>
            </div>
            <div class="topics">
                <div class="cardHeader">
                    @if ($rooms_count > 0)
                        <table>
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Participants</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rooms as $room)
                                    <tr>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->participants_count }}</td>
                                        <td>
                                            {{-- <button class="btn-edit" type="submit">Edit</button> --}}
                                            <form action="{{ route('admin.rooms.delete', $room->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-delete" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="empty">There is No rooms Yet</p>
                    @endif
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
