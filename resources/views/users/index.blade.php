<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('users.export') }}" class="bg-green-700 dark:bg-gray-200 hover:bg-green-500 dark:hover:bg-white text-white font-bold py-2 px-4 rounded leading-tight">
                Export Users
            </a>
        </div>
    </x-slot>

    @if(session()->has('message'))
        @include('components.custom.flash', ['message' => session('message')])
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead>
                            <tr class="bg-gray-200 dark:bg-gray-800">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Role</th>
                                <th class="px-4 py-2">Actions</th>
                                <th class="px-4 py-2">!</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="{{ $loop->even ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2 font-bold text-green-600">{{ $user->role->name }}</td>
                                    <td class="border px-4 py-2 flex justify-around">
                                        <a href="{{ route('users.edit', $user) }}" class="text-blue-800 hover:text-blue-400 dark:text-blue-500 dark:hover:text-blue-300">Edit</a>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('users.delete', $user) }}" class="text-red-500 hover:text-red-800 dark:text-red-500 dark:hover:text-red-300 px-2">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
