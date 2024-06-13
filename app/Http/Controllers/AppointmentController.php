<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Hospital;
use App\Models\State;
use App\Models\Timeslot;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AppointmentController extends Controller
{
    //
    public function create(Request $request) {
        $states = State::all();

        if (isset($request->state_id) && $request->state_id != "all") {
            $hospitals = Hospital::where("state_id", $request->state_id)->get();
            $selected_state = $request->state_id;
            return view("user.create_appointment", compact("hospitals", "states", "selected_state"));
        }

        $hospitals = Hospital::all();
        $selected_state = "all";
        return view("user.create_appointment", compact("hospitals", "states", "selected_state"));
    }

    public function select_doctor(Request $request, Hospital $hospital) {

        $departments = $hospital->departments;
        
        if (isset($request->department_id) && $request->department_id != "all") {
            $selected_department = $request->department_id;

            $staff = [];

            foreach ($departments as $department) {
                if ($department->id == $selected_department) {
                    foreach ($department->staff as $indiv_staff) {
                        $indiv_staff->department_name = $department->name;
                        $staff[] = $indiv_staff;
                    }
                }
            }

            return view("user.select_doctor", compact("hospital", "departments", "selected_department", "staff"));
        }

        foreach ($departments as $department) {
            foreach ($department->staff as $indiv_staff) {
                $indiv_staff->department_name = $department->name;
                $staff[] = $indiv_staff;
            }
        }

        $selected_department = "all";

        return view("user.select_doctor", compact("hospital", "departments", "selected_department", "staff"));
    }

    public function select_date(Int $staffInfo, Request $request) {
        $staff = User::find($staffInfo);
        $department = $staff->department;
        $hospital = $department->hospital;

        $date = date("Y/m/d/l");

        
        isset($request->selected_date) ? $selected_date = $request->selected_date : $selected_date = date("d") + 1;

        $all_timeslots = Timeslot::all();

        $all_timeslots_array = [];
        foreach($all_timeslots as $timeslot) {
            $all_timeslots_array[] = $timeslot;
        }
        $appointments = Appointment::where('user_id', "=", auth()->user()->id)->where('date', "=", "2024-06-" . $selected_date)->orWhere('staff_id', "=", $staff->id)->where('date', "=", "2024-06-" . $selected_date)->get();
        $not_timeslots = [];

        foreach ($appointments as $appointment) {
            $not_timeslots[] = $appointment->timeslot;
        }

        $timeslots = array_diff($all_timeslots_array, $not_timeslots);

        return view("user.select_date", compact("staff", "department", "hospital", "date", "selected_date", "timeslots"));
    }

    public function book_appointment(Request $request) {
        $appointment = new Appointment();
        $appointment->user_id = auth()->user()->id;
        $appointment->staff_id = $request->staff_id;
        $appointment->date = "20" . $request->selected_date;
        $appointment->timeslot_id = $request->timeslot_id;
        $appointment->hospital_id = $request->hospital_id;
        $appointment->status = 'BOOKED';
        $appointment->save();
        return redirect('/user/dashboard');
    }

    public function edit(Appointment $appointment) {
        return view("staff.edit_appointment_status", compact("appointment"));
    }

    public function update(Appointment $appointment, Request $request) {
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/staff/dashboard');
    }
}
