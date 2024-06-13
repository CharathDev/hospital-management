<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\State;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    //
    function index() {
        $hospitals = Hospital::all();
        $states = State::all();
        return view("admin.hospitals", compact("hospitals", "states"));
    }

    function store(Request $request) { 
        $hospital = new Hospital();
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->postcode = $request->postcode;
        $hospital->state_id = $request->state_id;
        $hospital->save();
        return redirect('/admin/hospitals');
    }
    
    function edit(Hospital $hospital) { 
        $states = State::all();
        return view('admin.edit_hospital', compact('hospital', 'states'));
    }

    function update(Request $request, Hospital $hospital) {
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->postcode = $request->postcode;
        $hospital->state_id = $request->state_id;
        $hospital->save();
        return redirect('/admin/hospitals');
    }

    function destroy(Hospital $hospital) {
        $hospital->delete();
        return redirect("/admin/hospitals");
    }
}
