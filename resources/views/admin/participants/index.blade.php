<x-app-layout>

    @section('topics')
        <div class="details">
            <div class="topic__header">
                <div>
                    <h2>Participants</h2>
                    <p> {{ count($participants) }} participants</p>
                </div>
            </div>
            <div class="topics">
                <div class="cardHeader">
                    <x-notify::notify />
                    @if (count($participants) > 0)
                        <table>
                            <thead>
                                <tr>
                                    <td>Participant</td>
                                    <td>Room</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($participants as $participant)
                                    <tr>
                                        <td>{{ $participant->user->name }}</td>
                                        <td>{{ $participant->room->name }}</td>
                                        <td>
                                            {{-- <button class="btn-edit" type="submit">Edit</button> --}}
                                            <form action="{{ route('admin.participants.delete', $participant->id) }}"
                                                method="post">
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
                        <p class="empty">There is No Participants Yet</p>
                    @endif
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
