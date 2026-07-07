<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
    public function seedDefaults()
{
    $departments = [
        ['name' => 'Information Technology (IT)', 'description' => 'Software, systems, networks, and technical support'],
        ['name' => 'Human Resources (HR)', 'description' => 'Recruitment, employees, attendance, and HR operations'],
        ['name' => 'Finance', 'description' => 'Accounting, income, expenses, and financial reports'],
        ['name' => 'Operations', 'description' => 'Daily business operations and workflow management'],
        ['name' => 'Project Management Office (PMO)', 'description' => 'Projects planning, tracking, and delivery'],
        ['name' => 'Sales', 'description' => 'Sales activities and client relationships'],
        ['name' => 'Marketing', 'description' => 'Marketing campaigns, branding, and promotion'],
        ['name' => 'Customer Support', 'description' => 'Customer service and support requests'],
        ['name' => 'Procurement', 'description' => 'Purchasing, suppliers, and procurement processes'],
        ['name' => 'Administration', 'description' => 'General administration and office management'],
    ];

    foreach ($departments as $department) {
        Department::firstOrCreate(
            ['name' => $department['name']],
            [
                'description' => $department['description'],
                'status' => 'active',
            ]
        );
    }

    return redirect()
        ->route('departments.index')
        ->with('success', 'Default departments created successfully.');
}
}