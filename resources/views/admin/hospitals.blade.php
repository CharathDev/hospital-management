<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hospitals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-2 shadow-sm rounded-lg ">
                <h2 class="text-white text-center p-2 text-xl">Create Hospital</h2>
                <form method="POST" action="/admin/hospitals" class="flex flex-col justify-center items-center">
                    @csrf
                    <div class="mb-3 w-[50%]">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <div class="mb-3 w-[50%]">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mb-3 w-[50%]">
                        <x-input-label for="postcode" :value="__('Postcode')" />
                        <x-text-input id="postcode" class="block mt-1 w-full" type="number" name="postcode" :value="old('postcode')" required autofocus autocomplete="postcode" />
                        <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
                    </div>
                    
                    <div class="mb-3 w-[50%]">
                        <x-input-label for="state_id" :value="__('State')" />
                        <select required name="state_id" id="state_id" class="mt-1 bg-gray-900 border border-gray-700 placeholder-gray-400 text-gray-300 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-500 block w-full p-2.5">
                            <option disbaled value="">Select an option</option>
                            @foreach ($states as $state)
                                <option value="{{$state->id}}">{{$state->state}}</option>
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
            
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-scroll">

            <table class="table-auto w-full bg-gray-800 shadow-sm sm:rounded-lg text-gray-100 overflow-hidden">
                <thead>
                    <tr>
                        <th class="p-2">Name</th>
                        <th class="p-2">Address</th>
                        <th class="p-2">Postcode</th>
                        <th class="p-2">State</th>
                        <th class="p-2"></th>
                        <th class="p-2"></th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hospitals as $hospital)
                        <tr class="text-center bg-gray-700">
                            <td>{{$hospital->name}}</td>
                            <td>{{$hospital->address}}</td>
                            <td>{{$hospital->postcode}}</td>
                            <td>{{$hospital->state->state}}</td>
                            <td class="p-2">
                                <a href="/admin/departments/create/{{ $hospital->id }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded block">Add Department</a>
                            </td>
                            <td class="p-2">
                                <a href="/admin/hospitals/{{ $hospital->id }}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block">Edit</a> <!-- Goes to the edit page-->
                            </td>
                            <td class="p-2 flex justify-center">
                                <form method="POST" action="/admin/hospitals/{{ $hospital->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                </form> 
                            </td>
                        </tr>
                        @foreach ($hospital->departments as $index=>$department)
                            @if ($index === 0)
                                <tr class="text-center bg-gray-600">
                                    <th class="px-2 py-4 text-center te">Departments: {{count($hospital->departments)}}</th>
                                    <td class="p-2"></td>
                                    <td class="p-2"></td>
                                    <td class="p-2"></td>
                                    <td class="p-2"></td>
                                    <td class="p-2"></td>
                                    <td class="p-2"></td>
                                </tr>
                            @endif
                            <tr class="text-center bg-gray-600">
                                <td class="p-2 text-center">{{ $department->name}}</td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2">
                                    <a href="/admin/departments/{{ $department->id }}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block">Edit</a> <!-- Goes to the edit page-->
                                </td>
                                <td class="p-2 flex justify-center">
                                    <form method="POST" action="/admin/departments/{{ $department->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </form> 
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
