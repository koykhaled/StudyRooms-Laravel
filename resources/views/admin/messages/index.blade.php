<x-app-layout>

    @section('topics')
        <div class="details">
            <div class="topic__header">
                <div>
                    <h2>Messages</h2>
                    <p> {{ count($messages) }} Messages</p>
                </div>
            </div>
            <div class="topics">
                <div class="cardHeader">
                    <x-notify::notify />
                    @if (count($messages) > 0)
                        <table>
                            <thead>
                                <tr>
                                    <td>User</td>
                                    <td>Message</td>
                                    <td>Room</td>
                                    <td>Created_at</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($messages as $message)
                                    <tr>
                                        <td>{{ $message->user->name }}</td>
                                        <td>{{ $message->message }}</td>
                                        <td>{{ $message->room->name }}</td>
                                        <td>{{ $message->created_at }}</td>
                                        <td>
                                            {{-- <button class="btn-edit" type="submit">Edit</button> --}}
                                            <form action="{{ route('admin.messages.delete', $message->id) }}" method="post">
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
                        <p class="empty">There is No Messages Yet</p>
                    @endif
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
