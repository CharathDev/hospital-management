<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index() {
        $users = User::all();
        return view("admin.dashboard", compact("users"));
    }

    function edit(User $user) {
        return view("admin.edit_user", compact("user"));
    }

    function update(Request $request, User $user) { 
        $user->user_type = $request->user_type;
        $user->save();
        return redirect('/admin/dashboard');
    }

    function destroy(User $user) { 
        $user->appointments()->delete();
        $user->delete();
        return redirect('/admin/dashboard');
    }
}
