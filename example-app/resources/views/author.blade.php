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
                    Id: {{ $author->id }}
                    <form action="{{ route('delete-author', $author->id) }}" method="POST" class="delete-action">
                        @method('DELETE')
                        @csrf
                        <button type="submit"
                            @if(!empty($author->books))
                                disabled
                                title="Author has books and can't be deleted"
                            @endif
                        >[Delete author]</button>
                    </form><br/>
                    First name: {{ $author->firstName }}<br/>
                    Last name: {{ $author->lastName }}<br/>
                    Birthday: {{ $author->birthday->format('Y-m-d') }}<br/>
                    Gender: {{ $author->gender }}<br/>
                    Place of birth: {{ $author->placeOfBirth }}<br/>
                    Books:
                    @if(empty($author->books))
                        None
                    @else
                        <table>
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Release date</th>
                                <th>Description</th>
                                <th>ISBN</th>
                                <th>Format</th>
                                <th>No. of pages</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($author->books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->releaseDate->format('Y-m-d') }}</td>
                                        <td>{{ $book->description }}</td>
                                        <td>{{ $book->isbn }}</td>
                                        <td>{{ $book->format }}</td>
                                        <td>{{ $book->numberOfPages }}</td>
                                        <td>
                                            <form action="{{ route('delete-book', $book->id) }}" method="POST" class="delete-action">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit">[Delete book]</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
