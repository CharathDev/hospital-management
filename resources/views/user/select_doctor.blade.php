<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <a href="/user/book_appointment" class="flex mr-5 font-semibold text-xl text-gray-200 bg-gray-800 hover:bg-gray-900 leading-tight rounded-full items-center justify-center p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center text-">
                {{ __('Book Appointment') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col items-center ">
            <h2 class="text-white text-center p-2 text-xl">Select Doctor</h2>
            <form method="POST" action="/user/book_appointment/{{$hospital->id}}" class="w-full flex items-center justify-center">
                @csrf
                <div class="mb-3 w-[50%]">
                    <x-input-label for="department_id" :value="__('Department')" />
                    <select required name="department_id" id="department_id" class="mt-1 bg-gray-900 border border-gray-700 placeholder-gray-400 text-gray-300 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-500 block w-full p-2.5">
                        <option {{ $selected_department == "all" ? "selected" : null }} value="all">All</option>
                        @foreach ($departments as $department)
                            <option {{ $selected_department == $department->id ? "selected" : null }} value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="mt-5 w-full mx-auto sm:px-6 lg:px-8">
                <table class="table-auto w-full bg-gray-800 shadow-sm sm:rounded-lg text-gray-100 overflow-hidden">
                    <thead>
                        <tr>
                            <th class="p-2">Name</th>
                            <th class="p-2">Department</th>
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $indiv_staff)
                            <tr class="text-center bg-gray-700">
                                <td>{{$indiv_staff->name}}</td>
                                <td>{{$indiv_staff->department_name}}</td>
                                <td class="p-2">
                                    <a href="/user/book_appointment/date/{{ $indiv_staff->id }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded block select-doctor" id="{{$indiv_staff->staff}}">Select Doctor</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let quantities = document.querySelectorAll('#department_id');
        quantities.forEach(input => {
            input.onchange = () => input.parentElement.parentElement.submit();
        });

        let select_doctors = document.querySelectorAll('.select-doctor');
        quantities.forEach(input => {
            input.onclick = () => testPrint();
        });
    </script>
</x-app-layout>
