<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('create-book-action') }}">
                        @csrf
                        <div>
                            <label>Title</label><br/>
                            <input type="text" name="title" required>
                        </div>
                        <div>
                            <label>Release date</label><br/>
                            <input type="date" name="releaseDate" required>
                        </div>
                        <div>
                            <label>Description</label><br/>
                            <textarea name="description" required></textarea>
                        </div>
                        <div>
                            <label>ISBN</label><br/>
                            <input type="text" name="isbn" required>
                        </div>
                        <div>
                            <label>Format</label><br/>
                            <input type="text" name="bookFormat" required>
                        </div>
                        <div>
                            <label>Number of pages</label><br/>
                            <input type="number" name="numberOfPages" required>
                        </div>
                        <div>
                            <label>Author</label><br/>
                            <select name="authorId">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">
                                        {{ $author->getFullName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
