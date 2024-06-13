<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="/admin/users/{{$user->id}}" class="mx-auto max-w-sm">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="block text-white mb-3 text-sm font-medium">Name</label>
                    <h2 class="block text-gray-500 mb-3 font-medium bg-gray-700 border border-gray-600 rounded-lg p-2.5">{{$user->name}}</h2>
                </div>

                <div class="mb-3">
                    <label for="email" class="block text-white mb-3 text-sm font-medium">Email</label>
                    <h2 class="block text-gray-500 mb-3 font-medium bg-gray-700 border border-gray-600 rounded-lg p-2.5">{{$user->email}}</h2>
                </div>

                <div class="mb-3">
                    <label for="type" class="block text-white mb-3 text-sm font-medium">User Type</label>
                    <select name="user_type" id="type" class="mb-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option {{ $user->user_type == "user" ? "selected" : null }} value="user">User</option>
                        <option {{ $user->user_type == "staff" ? "selected" : null }} value="staff">Staff</option>
                        <option {{ $user->user_type == "admin" ? "selected" : null }} value="admin">Admin</option>
                    </select>
                </div>

                <button class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
