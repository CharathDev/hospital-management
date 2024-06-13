<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-2 shadow-sm rounded-lg">
                <h2 class="text-white text-center p-2 text-xl">Edit Department</h2>
                <form method="POST" action="/admin/hospitals/{{$deparment->id}}" class="flex flex-col justify-center items-center">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 w-[50%]">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $department->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-3 w-[50%] flex items-center justify-center">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
