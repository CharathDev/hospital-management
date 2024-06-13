<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-scroll">
            <table class="table-auto w-full bg-gray-800 shadow-sm sm:rounded-lg text-gray-100 overflow-hidden">
                <thead>
                    <tr>
                        <th class="p-2">Name</th>
                        <th class="p-2">Email</th>
                        <th class="p-2">User Type</th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @if ($user->id != auth()->user()->id)
                            <tr class="text-center bg-gray-700">
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{ucfirst($user->user_type)}}</td>
                                <td class="p-2 flex justify-around">
                                    <a href="/admin/users/{{ $user->id }}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block">Edit</a> <!-- Goes to the edit page-->
                                    <form method="POST" action="/admin/users/{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </form> 
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
