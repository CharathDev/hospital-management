<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 flex justify-center">
                <form action="/{{auth()->user()->user_type}}/dashboard">
                    <input type="hidden" name="selected_option" value="upcoming">
                    <button class="mx-2 p-2 rounded-md text-gray-50 {{$selected_option == "upcoming" ? "bg-cyan-500" : "bg-gray-800"}}">Upcoming Appointments</button>
                </form>
                <form action="/{{auth()->user()->user_type}}/dashboard">
                    <input type="hidden" name="selected_option" value="past">
                    <button class="mx-2 p-2 rounded-md text-gray-50 {{$selected_option == "past" ? "bg-cyan-500" : "bg-gray-800"}}">Past Appointments</button>
                </form>
            </div>
            @php
            $past_appointments = [];
            $upcoming_appointments = [];
            if ($appointments != null) {
                foreach ($appointments as $appointment) {
                    if ($appointment->status == 'BOOKED') {
                        $upcoming_appointments[] = $appointment;
                    } else {
                        $past_appointments[] = $appointment;
                    }
                }
            }
            @endphp
            @if ($selected_option == 'upcoming')
                @if ($appointments == null || count($upcoming_appointments) < 1)
                <div class="p-4 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-5">
                    <h2 class="text-gray-200">You have no upcoming appointments</h2>
                </div>
                @else
                <div>
                    @foreach ($upcoming_appointments as $appointment)
                        @if (auth()->user()->user_type == 'staff')
                            <a href="/staff/appointment/{{$appointment->id}}/edit">
                        @endif
                                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-5 {{auth()->user()->user_type == 'staff' ? "hover:bg-gray-700 hover:cursor-pointer" : "" }}" id="{{$appointment->id}}">
                                    <div class="p-4 grid grid-cols-10">
                                        <h1 class="col-span-2 text-gray-50">{{auth()->user()->user_type == "staff" ? $appointment->user->name : $appointment->staff->name}}</h1>
                                        <h1 class="col-span-2 text-gray-50">{{$appointment->hospital->name}}</h1>
                                        <h1 class="col-span-3 text-gray-50">{{date("d/m/Y l", strtotime($appointment->date))}}</h1>
                                        <h1 class="col-span-2 text-gray-50">{{$appointment->timeslot->time}}</h1>
                                        <h1 class="col-span-1 text-gray-50 bg-violet-500 px-2 rounded-lg text-center">{{$appointment->status}}</h1>
                                    </div>
                                </div>
                        @if (auth()->user()->user_type == 'staff')
                            </a>
                        @endif
                    @endforeach
                </div>
                @endif
            @else 
                @if ($appointments == null || count($past_appointments) < 1)
                    <div class="p-4 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-5">
                        <h2 class="text-gray-200">You have no past appointments</h2>
                    </div>
                    @else
                    <div>
                        @foreach ($past_appointments as $appointment)
                            @if (auth()->user()->user_type == 'staff')
                                <a href="/staff/appointment/{{$appointment->id}}/edit">
                            @endif
                                    <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-5 {{auth()->user()->user_type == 'staff' ? "hover:bg-gray-700 hover:cursor-pointer" : "" }}">
                                        <div class="p-4 grid grid-cols-10">
                                            <h1 class="col-span-2 text-gray-50">{{auth()->user()->user_type == "staff" ? $appointment->user->name : $appointment->staff->name}}</h1>
                                            <h1 class="col-span-2 text-gray-50">{{$appointment->hospital->name}}</h1>
                                            <h1 class="col-span-3 text-gray-50">{{date("d/m/Y l", strtotime($appointment->date))}}</h1>
                                            <h1 class="col-span-2 text-gray-50">{{$appointment->timeslot->time}}</h1>
                                            <h1 class="col-span-1 text-gray-50 bg-green-500 px-2 rounded-lg text-center">{{$appointment->status}}</h1>
                                        </div>
                                    </div>
                            @if (auth()->user()->user_type == 'staff')
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endif
            
        </div>
    </div>
</x-app-layout>
