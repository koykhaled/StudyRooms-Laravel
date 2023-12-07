<x-app-layout>

    @section('topics')
        <div class="details">
            <x-notify::notify />
            <div class="topic__header">
                <div>
                    <h2>Users</h2>
                    <p> {{ $users_count }} Users</p>
                </div>
            </div>
            <div class="topics">
                <div class="cardHeader">
                    @if ($users_count > 0)
                        <Table>
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Role</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a class="btn-edit" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                                            <a class="btn-delete" title="logout"
                                                href="{{ route('admin.users.delete', $user->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-user').submit();">Delete</a>
                                            <form id="delete-user" action="{{ route('admin.users.delete', $user->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </Table>
                    @else
                        <p class="empty">There is No Users Yet</p>
                    @endif
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
