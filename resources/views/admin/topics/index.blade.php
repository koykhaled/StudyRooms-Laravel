<x-app-layout>

    @section('topics')
        <div class="details">
            <div class="topic__header">
                <div>
                    <h2>Topics</h2>
                    <p> {{ $topics_count }} Topics</p>
                </div>
                <a class="btn btn--main" href="{{ route('admin.topics.create') }}">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <title>add</title>
                        <path
                            d="M16.943 0.943h-1.885v14.115h-14.115v1.885h14.115v14.115h1.885v-14.115h14.115v-1.885h-14.115v-14.115z">
                        </path>
                    </svg>
                    Create Topic
                </a>
            </div>
            <div class="topics">
                <div class="cardHeader">
                    @if ($topics_count > 0)
                        <table>
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topics as $topic)
                                    <tr>
                                        <td>{{ $topic->name }}</td>
                                        <td>
                                            {{-- <button class="btn-edit" type="submit">Edit</button> --}}
                                            <form action="{{ route('admin.topics.delete', $topic->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-delete" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <p>EMpty</p>
                                @endforelse
                            </tbody>
                        </table>
                    @else
                        <p class="empty">There is No Topics Yet</p>
                    @endif
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
