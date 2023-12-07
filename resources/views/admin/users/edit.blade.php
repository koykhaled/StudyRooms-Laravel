<x-app-layout>
    @section('create_topics')
        <div class="layout__box">
            <div class="layout__boxHeader">
                <div class="layout__boxTitle">
                    <a href="{{ route('admin.topics') }}">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                            <title>arrow-left</title>
                            <path
                                d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z">
                            </path>
                        </svg>
                    </a>
                    <h3>Edit User Role</h3>
                </div>
            </div>
            <div class="layout__body">
                <form class="form" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @error('role')
                        {{ $message }}
                    @enderror

                    <div class="user__role">
                        <label class="title" for="room_topic">Role</label>

                        <label for="admin">
                            Admin <input class="inp" @if ($user->role == 'admin') checked @endif type="radio"
                                value="admin" name="role" />
                        </label>
                        <label for="admin">
                            User <input class="inp" @if ($user->role == 'user') checked @endif type="radio"
                                value="user" name="role" />
                        </label>

                    </div>

                    <div class="form__action">
                        <a class="btn btn--dark" href="{{ route('admin.users') }}">Cancel</a>
                        <button class="btn btn--main" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-app-layout>
