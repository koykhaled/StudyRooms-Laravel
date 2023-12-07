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
                    <h3>Create Topic</h3>
                </div>
            </div>
            <div class="layout__body">
                <form class="form" action="{{ route('admin.topics.store') }}" method="POST">
                    @csrf
                    @error('name')
                        {{ $message }}
                    @enderror
                    <div class="form__group">
                        <label for="name">Topic Name</label>
                        <input id="name" name="name" type="text" placeholder="E.g. Backend Frontend" />
                    </div>
                    <div class="form__action">
                        <a class="btn btn--dark" href="{{ route('admin.topics') }}">Cancel</a>
                        <button class="btn btn--main" type="submit">Create Topic</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-app-layout>
