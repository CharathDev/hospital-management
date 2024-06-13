<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Hospital') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-2 shadow-sm rounded-lg">
                <h2 class="text-white text-center p-2 text-xl">Edit Hospital</h2>
                <form method="POST" action="/admin/hospitals/{{$hospital->id}}" class="flex flex-col justify-center items-center">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 w-[50%]">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $hospital->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <div class="mb-3 w-[50%]">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $hospital->address)" required autofocus autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mb-3 w-[50%]">
                        <x-input-label for="postcode" :value="__('Postcode')" />
                        <x-text-input id="postcode" class="block mt-1 w-full" type="number" name="postcode" :value="old('postcode', $hospital->postcode)" required autofocus autocomplete="postcode"/>
                        <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
                    </div>
                    
                    <div class="mb-3 w-[50%]">
                        <x-input-label for="state_id" :value="__('State')" />
                        <select required name="state_id" id="state_id" class="mt-1 bg-gray-900 border border-gray-700 placeholder-gray-400 text-gray-300 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-500 block w-full p-2.5">
                            @foreach ($states as $state)
                                <option {{$hospital->state->id == $state->id ? "selected" : null }} value="{{$state->id}}">{{$state->state}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('State')" class="mt-2" />
                    </div>

                    <div class="mb-3 w-[50%] flex items-center justify-center">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
