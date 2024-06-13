@use('Illuminate\Support\Facades\Vite')
@use('App\Models\Timeslot')
@use('App\Models\Appointment')
<x-app-layout>

    <x-slot name="header">
        <div class="flex">
            <a href="/user/book_appointment/{{$hospital->id}}" class="flex mr-5 font-semibold text-xl text-gray-200 bg-gray-800 hover:bg-gray-900 leading-tight rounded-full items-center justify-center p-2">
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
            <h2 class="text-white text-center p-2 text-xl mb-5">Select Date</h2>
            <table class="table-auto w-full max-w-md bg-gray-800 shadow-sm sm:rounded-lg text-gray-100 overflow-hidden mb-5">
                <thead>
                    <tr>
                        <th class="p-2">SUN</th>
                        <th class="p-2">MON</th>
                        <th class="p-2">TUE</th>
                        <th class="p-2">WED</th>
                        <th class="p-2">THU</th>
                        <th class="p-2">FRI</th>
                        <th class="p-2">SAT</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $days = array(
                        "Sunday" => 0,
                        "Monday" => 1, 
                        "Tuesday" => 2, 
                        "Wednesday" => 3, 
                        "Thursday" => 4, 
                        "Friday" => 5, 
                        "Saturday" => 6,  
                    );
                    $month_length = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($date)), 2024);
                    $firstDayOfTheMonth = date('y', strtotime($date)) . '-' . date('m', strtotime($date)) . '-01';
                    $day = date('l', strtotime(date('y', strtotime($date)) . '-' . date('m', strtotime($date)) . '-01'));
                    $currentDateDay = date('l', strtotime(date('y', strtotime($date)) . '-' . date('m', strtotime($date)) . '-' . date('d', strtotime($date))));
                    $currentSelectedDay = date('y', strtotime($date)) . '-' . date('m', strtotime($date)) . '-' . $selected_date;
                    @endphp
                    @for ($i = 0; $i < 6; $i++)
                    <tr>

                        @for ($j = 1; $j <= 7; $j++)
                        @php
                        $currentDay = ($i * 7) + $j - $days[$day];
                        $all_timeslots = Timeslot::all();
                        $appointments = Appointment::where('user_id', "=", auth()->user()->id)->where('date', "=", "2024-06-" . $currentDay)->orWhere('staff_id', "=", $staff->id)->where('date', "=", "2024-06-" . $currentDay)->get();

                        $all_timeslots_array = [];
                        foreach($all_timeslots as $timeslot) {
                            $all_timeslots_array[] = $timeslot;
                        }

                        $not_timeslots = [];

                        foreach ($appointments as $appointment) {
                            $not_timeslots[] = $appointment->timeslot;
                        }

                        $currentDayTimeslots = array_diff($all_timeslots_array, $not_timeslots);
                        @endphp
                        <td class="text-center p-2 {{date('d', strtotime($currentDateDay)) - $currentDay + 1 <= 0 && count($currentDayTimeslots) != 0 ? "text-white hover:cursor-pointer group" :  "text-gray-600"}}">
                            <div class="{{date('d', strtotime($currentDateDay)) - $currentDay + 1 <= 0 && count($currentDayTimeslots) != 0 ? "date_options" : ""}} {{$selected_date == $currentDay ? "bg-cyan-500" : "group-hover:bg-gray-700" }} hover:bg-gray rounded-sm">
                                @if (date('d', strtotime($currentDateDay)) - $currentDay + 1 <= 0 && count($currentDayTimeslots) != 0)
                                <form action="/user/book_appointment/date/{{$staff->id}}">
                                    <input type="hidden" name="selected_date" value="{{$currentDay}}">
                                </form>
                                @endif
                                {{$currentDay <= 0 || $currentDay > $month_length ? "" : $currentDay}}
                            </div>
                        </td>
                        @endfor
                    </tr>
                    @endfor
                </tbody>
            </table>
            <h2 class="text-white text-center p-2 text-xl mb-5">Select Time Slot</h2>
            <div class="grid grid-cols-4 gap-4">
                @foreach ($timeslots as $timeslot)
                <div class="flex items-center justify-center">
                    <button class="bg-gray-800 hover:bg-gray-700 px-3 py-2 text-center text-white rounded-md timeslot_buttons w-full" id="{{$timeslot->id}}">
                        {{$timeslot->time}}
                    </button>
                </div>
                @endforeach
            </div>

            <form action="/user/booked_appointment" method="POST" class="timeslot_form mt-4">
                @csrf
                <input type="hidden" name="staff_id" value="{{$staff->id}}">
                <input type="hidden" name="selected_date" value="{{date($currentSelectedDay)}}">
                <input type="hidden" name="hospital_id" value="{{$hospital->id}}">
                <input required type="hidden" name="timeslot_id" id="timeslot_input">
                <button class="hidden px-3 py-2 bg-cyan-500 rounded-md text-white" id="submit_btn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        let date_options = document.querySelectorAll('.date_options');
        date_options.forEach(input => {
            input.onclick = () => input.children[0].submit();
        });

        let timeslot_form = document.querySelector('.timeslot_form');
        let timeslot_input = document.querySelector('#timeslot_input');
        let timeslot_buttons = document.querySelectorAll('.timeslot_buttons');
        let submit_btn = document.querySelector("#submit_btn");
        timeslot_buttons.forEach(button => {
            button.onclick = () => {
                submit_btn.classList.remove("hidden");
                timeslot_input.setAttribute('value', button.getAttribute('id'));
                timeslot_buttons.forEach(button => {
                    button.classList.remove("bg-cyan-500");
                    button.classList.add("bg-gray-800")
                });
                button.classList.remove("bg-gray-800");
                button.classList.add("bg-cyan-500");
            };
        });
    </script>
</x-app-layout>
