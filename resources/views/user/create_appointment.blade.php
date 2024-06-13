<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center text-">
                {{ __('Book Appointment') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col items-center ">
            <h2 class="text-white text-center p-2 text-xl">Select Hospital</h2>
            <form method="POST" action="/user/book_appointment" class="w-full flex items-center justify-center">
                @csrf
                <div class="mb-3 w-[50%]">
                    <x-input-label for="state_id" :value="__('State')" />
                    <select required name="state_id" id="state_id" class="mt-1 bg-gray-900 border border-gray-700 placeholder-gray-400 text-gray-300 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-500 block w-full p-2.5">
                        <option {{ $selected_state == "all" ? "selected" : null }} value="all">All</option>
                        @foreach ($states as $state)
                            <option {{ $selected_state == $state->id ? "selected" : null }} value="{{$state->id}}">{{$state->state}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="mt-5 w-full mx-auto sm:px-6 lg:px-8">
                <table class="table-auto w-full bg-gray-800 shadow-sm sm:rounded-lg text-gray-100 overflow-hidden">
                    <thead>
                        <tr>
                            <th class="p-2">Name</th>
                            <th class="p-2">Address</th>
                            <th class="p-2">Postcode</th>
                            <th class="p-2">State</th>
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
                                    <a href="/user/book_appointment/{{ $hospital->id }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded block">Select Hospital</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let quantities = document.querySelectorAll('#state_id');
        quantities.forEach(input => {
            input.onchange = () => input.parentElement.parentElement.submit();
        });
    </script>
</x-app-layout>
