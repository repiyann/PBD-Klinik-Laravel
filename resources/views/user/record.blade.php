@extends('user.app')

@section('content')
<div class="dark:bg-gray-800 md:min-h-[82.2vh]">
    <h2 class="my-3 text-2xl text-center md:text-start font-semibold text-gray-700 dark:text-gray-200">
        Records
    </h2>

    <div class="text-center mb-4 md:hidden">
        <a href="{{ route('addRecord') }}" class="inline-block px-4 py-2 text-base font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Add New Record
        </a>
    </div>

    <div class="mb-3 mt-1 hidden md:block">
        <a href="{{ route('addRecord') }}" class="inline-block px-4 py-2 text-base font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Add New Record
        </a>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if ($errors->any())
            <div class="bg-red-100 mb-5 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                <p>{{ $errors->first() }}</p>
            </div>
            @endif

            <table class="w-full table-auto">
                <thead class="hidden md:table-header-group">
                    <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">First Name</th>
                        <th class="px-4 py-3">Last Name</th>
                        <th class="px-4 py-3">National ID</th>
                        <th class="px-4 py-3">Birthdate</th>
                        <th class="px-4 py-3">Address</th>
                        <th class="px-4 py-3">Notes</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @if(!$records->isEmpty())
                    @foreach ($records as $record)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{ $record->firstName }}</td>
                        <td class="px-4 py-3">{{ $record->lastName }}</td>
                        <td class="px-4 py-3">{{ $record->nationalID }}</td>
                        <td class="px-4 py-3">{{ $record->birthDate }}</td>
                        <td class="px-4 py-3">{{ $record->address }}</td>
                        <td class="px-4 py-3">{{ $record->notes }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('editRecord', $record->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('deleteRecord', $record->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-2xl font-semibold text-center">No records found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection