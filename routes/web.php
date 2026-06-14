<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    return view('dashboard', [
        'employeesCount' => Employee::count(),
        'departmentsCount' => Department::count(),
        'rolesCount' => Role::count(),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('departments', DepartmentController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('employees', EmployeeController::class);

});

require __DIR__.'/auth.php';