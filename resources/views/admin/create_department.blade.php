<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <a href="/admin/hospitals" class="flex mr-5 font-semibold text-xl text-gray-200 bg-gray-800 hover:bg-gray-900 leading-tight rounded-full items-center justify-center p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center text-">
                {{ __('Create Department') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-2 shadow-sm rounded-lg ">
                <h2 class="text-white text-center p-2 text-xl">Create Department</h2>
                <form method="POST" action="/admin/departments" class="flex flex-col justify-center items-center">
                    @csrf
                    <input type="hidden" name="id" value="{{ $hospital->id }}">
                    <div class="mb-3 w-[50%]">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
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
