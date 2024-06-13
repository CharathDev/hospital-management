<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $appointments = Appointment::where(auth()->user()->user_type . '_id', "=", auth()->user()->id)->get();
        isset($request->selected_option) ? $selected_option = $request->selected_option  : $selected_option = 'upcoming';
        return view('dashboard', compact("appointments", "selected_option"));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if ($request->user()->department_id != null) {
            $department = Department::find($request->user()->department_id);

            return view('profile.edit', [
                'user' => $request->user(),
                'hospitals' => Hospital::orderBy('state_id', 'asc')->get(),
                'selected_hospital' => $department->hospital,
                'selected_department' => $department
            ]);
        }

        return view('profile.edit', [
            'user' => $request->user(),
            'hospitals' => Hospital::orderBy('state_id', 'asc')->get(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route(auth()->user()->user_type . '.profile.edit')->with('status', 'profile-updated');
    }

    public function select_hospital(Request $request) {
        return view(auth()->user()->user_type . '.profile.edit', [
            'user' => $request->user(),
            'hospitals' => Hospital::orderBy('state_id', 'asc')->get(),
            'selected_hospital' => Hospital::find($request->hospital),
        ]);
    }

    public function update_department(Request $request) {
        $request->user()->department_id = $request->department;
        $request->user()->save();
        return redirect("/" . auth()->user()->user_type . "/profile");
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
