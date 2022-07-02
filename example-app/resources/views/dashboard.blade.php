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
                    <table>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Birthday</th>
                            <th>Gender</th>
                            <th>Place of birth</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($authors as $author)
                                <tr>
                                    <td><a href="{{ route('author', $author->id) }}">{{ $author->id }}</a></td>
                                    <td>{{ $author->firstName }}</td>
                                    <td>{{ $author->lastName }}</td>
                                    <td>{{ $author->birthday->format('Y-m-d') }}</td>
                                    <td>{{ $author->gender }}</td>
                                    <td>{{ $author->placeOfBirth }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
