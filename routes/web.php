<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeAccountController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\TeamTaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\MyTaskController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectMessageController;
use App\Http\Controllers\ProjectEventController;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Role;
use App\Models\Task;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'employeesCount'   => Employee::count(),
        'departmentsCount' => Department::count(),
        'rolesCount'       => Role::count(),
        'tasksCount'       => Task::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // My Tasks
    Route::get('/my-tasks', [MyTaskController::class, 'index'])->name('my-tasks.index');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Core Modules
    Route::resource('departments', DepartmentController::class);

    Route::post('/departments/defaults', [DepartmentController::class, 'seedDefaults'])
    ->name('departments.defaults');

    Route::resource('roles', RoleController::class)
        ->middleware('permission:roles.view');

        Route::post('/roles/defaults', [RoleController::class, 'seedDefaults'])
    ->name('roles.defaults');

    Route::resource('users', UserController::class);

    Route::resource('employees', EmployeeController::class);

    Route::post('/employees/{employee}/account', [EmployeeAccountController::class, 'store'])
        ->name('employees.account.store');

    Route::resource('tasks', TaskController::class);

    // Projects
    Route::resource('projects', ProjectController::class);

    Route::post('/projects/{project}/members', [ProjectController::class, 'addMember'])
    ->name('projects.members.add');

Route::delete('/projects/{project}/members/{user}', [ProjectController::class, 'removeMember'])
    ->name('projects.members.remove');

    // Project Chat
    Route::post('/projects/{project}/messages', [ProjectMessageController::class, 'store'])->name('projects.messages.store');

    // Project Files
    Route::post('/projects/{project}/files', [ProjectController::class, 'uploadFile'])->name('projects.files.upload');
    Route::get('/project-files/{projectFile}/download', [ProjectController::class, 'downloadFile'])->name('projects.files.download');

    // Project Calendar Events
    Route::post('/projects/{project}/events', [ProjectEventController::class, 'store'])->name('projects.events.store');
    Route::delete('/project-events/{event}', [ProjectEventController::class, 'destroy'])->name('project-events.destroy');

    // Project Kanban Tasks
    Route::post('/project-tasks', [ProjectTaskController::class, 'store'])->name('project-tasks.store');
    Route::patch('/project-tasks/{projectTask}/status', [ProjectTaskController::class, 'updateStatus'])->name('project-tasks.updateStatus');
    Route::delete('/project-tasks/{projectTask}', [ProjectTaskController::class, 'destroy'])->name('project-tasks.destroy');

    // Teams
    Route::resource('teams', TeamController::class);

    // Team Members
    Route::post('/team-members', [TeamMemberController::class, 'store'])->name('team-members.store');
    Route::delete('/team-members/{teamMember}', [TeamMemberController::class, 'destroy'])->name('team-members.destroy');

    // Team Tasks
    Route::resource('team-tasks', TeamTaskController::class);

    // Finance
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::resource('incomes', IncomeController::class);
    Route::resource('expenses', ExpenseController::class);

    // Documents
    Route::resource('documents', DocumentController::class);
});

require __DIR__.'/auth.php';