<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="/staff/appointment/{{$appointment->id}}" class="mx-auto max-w-sm">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="block text-white mb-3 text-sm font-medium">Patient Name</label>
                    <h2 class="block text-gray-500 mb-3 font-medium bg-gray-700 border border-gray-600 rounded-lg p-2.5">{{$appointment->user->name}}</h2>
                </div>

                <div class="mb-3">
                    <label for="email" class="block text-white mb-3 text-sm font-medium">Hospital</label>
                    <h2 class="block text-gray-500 mb-3 font-medium bg-gray-700 border border-gray-600 rounded-lg p-2.5">{{$appointment->hospital->name}}</h2>
                </div>

                <div class="mb-3">
                    <label for="email" class="block text-white mb-3 text-sm font-medium">Date</label>
                    <h2 class="block text-gray-500 mb-3 font-medium bg-gray-700 border border-gray-600 rounded-lg p-2.5">{{date("d/m/Y l", strtotime($appointment->date))}}</h2>
                </div>

                <div class="mb-3">
                    <label for="email" class="block text-white mb-3 text-sm font-medium">Timeslot</label>
                    <h2 class="block text-gray-500 mb-3 font-medium bg-gray-700 border border-gray-600 rounded-lg p-2.5">{{$appointment->timeslot->time}}</h2>
                </div>

                <div class="mb-3">
                    <label for="status" class="block text-white mb-3 text-sm font-medium">Status</label>
                    <select name="status" id="status" class="mb-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option {{ $appointment->status == "BOOKED" ? "selected" : null }} value="BOOKED">BOOKED</option>
                        <option {{ $appointment->status == "DONE" ? "selected" : null }} value="DONE">DONE</option>
                    </select>
                </div>

                <button class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
