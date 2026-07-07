<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
 public function index()
{
    $employees = Employee::with(['department', 'user.role'])
        ->latest()
        ->paginate(10);

    $roles = Role::where('status', 'active')->get();

    return view('employees.index', compact('employees', 'roles'));
}

    public function create()
    {
        $departments = Department::all();

        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|max:30',
            'job_title' => 'required|max:255',
            'department_id' => 'required|exists:departments,id',
            'hire_date' => 'nullable|date',
            'status' => 'required',
        ]);

        Employee::create($request->only([
            'full_name',
            'email',
            'phone',
            'job_title',
            'department_id',
            'hire_date',
            'status',
        ]));

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        $employee->load(['department', 'user.role']);

        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();

        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'full_name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|max:30',
            'job_title' => 'required|max:255',
            'department_id' => 'required|exists:departments,id',
            'hire_date' => 'nullable|date',
            'status' => 'required',
        ]);

        $employee->update($request->only([
            'full_name',
            'email',
            'phone',
            'job_title',
            'department_id',
            'hire_date',
            'status',
        ]));

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}