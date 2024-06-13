<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/staff/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'access-level:staff'])->name('staff.dashboard');

Route::middleware(['auth', 'access-level:user'])->group(function () {
    // dashbaord
    Route::get('/user/dashboard', [ProfileController::class, 'index'])->name('user.dashboard');

    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');

    Route::get('/user/book_appointment', [AppointmentController::class, 'create'])->name('user.appointment.create');
    Route::post('/user/book_appointment', [AppointmentController::class, 'create'])->name('user.appointment.create');

    Route::get('/user/book_appointment/{hospital}', [AppointmentController::class, 'select_doctor'])->name('user.appointment.select_doctor');
    Route::post('/user/book_appointment/{hospital}', [AppointmentController::class, 'select_doctor'])->name('user.appointment.select_doctor');

    Route::get('/user/book_appointment/date/{user}', [AppointmentController::class, 'select_date'])->name('user.appointment.select_date');

    Route::post('/user/booked_appointment', [AppointmentController::class, 'book_appointment'])->name('user.appointment.book');
});

Route::middleware(['auth', 'access-level:staff'])->group(function () {
    // dashboard
    Route::get('/staff/dashboard', [ProfileController::class, 'index'])->name('staff.dashboard');

    Route::get('/staff/appointment/{appointment}/edit', [AppointmentController::class, 'edit'])->name('staff.appointment.edit');
    Route::put('/staff/appointment/{appointment}', [AppointmentController::class, 'update'])->name('staff.appointment.update');

    Route::get('/staff/profile', [ProfileController::class, 'edit'])->name('staff.profile.edit');
    Route::patch('/staff/profile', [ProfileController::class, 'update'])->name('staff.profile.update');
    Route::put('/staff/profile', [ProfileController::class, 'select_hospital'])->name('staff.profile.select_hospital');
    Route::put('/staff/profile/department', [ProfileController::class, 'update_department'])->name('staff.profile.update_department');
    Route::delete('/staff/profile', [ProfileController::class, 'destroy'])->name('staff.profile.destroy');
});

Route::middleware(['auth', 'access-level:admin'])->group(function () {
    // admin dashboard
    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.destroy');
    
    // admin hospitals
    Route::get('/admin/hospitals', [HospitalController::class, 'index'])->name('admin.hospitals');
    Route::post('/admin/hospitals', [HospitalController::class, 'store'])->name('admin.create_hospital');
    Route::get('/admin/hospitals/{hospital}/edit', [HospitalController::class, 'edit'])->name('admin.edit_hospital');
    Route::put('/admin/hospitals/{hospital}', [HospitalController::class, 'update'])->name('admin.update_hospital');
    Route::delete('/admin/hospitals/{hospital}', [HospitalController::class, 'destroy'])->name('admin.destroy_hospital');

    // admin departments
    Route::get('/admin/departments/create/{hospital}', [DepartmentController::class, 'create'])->name('admin.create_department');
    Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('admin.store_department');
    Route::get('/admin/departments/{department}/edit', [DepartmentController::class,'edit'])->name('admin.edit_department');
    Route::put('/admin/departments/{department}', [DepartmentController::class,'update'])->name('admin.update_department');
    Route::delete('/admin/departments/{department}', [DepartmentController::class, 'destroy'])->name('admin.destroy_department');
});

require __DIR__.'/auth.php';
