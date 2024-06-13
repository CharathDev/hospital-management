<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Hospital;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function create(Hospital $hospital) {
        return view("admin.create_department", compact("hospital"));
    }

    public function store(Request $request) { 
        $department = new Department();
        $department->name = $request->name;
        $department->hospital_id = $request->id;
        $department->save();
        return redirect("/admin/hospitals");
    }

    public function edit(Department $department) {
        return view("admin.edit_department", compact("department"));
    }

    public function update(Request $request, Department $department) {
        $department->name = $request->name;
        $department->save();
        return redirect("/admin/hospitals");
    }

    public function destroy(Department $department) {
        if (count($department->staff) >= 1) {
            return redirect("/admin/hospitals")->with("error", "There are staff with this department");
        }
        $department->delete();
        return redirect("/admin/hospitals");
    }
}
