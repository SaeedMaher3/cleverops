<?php

namespace App\Http\Controllers;

use App\Models\ProjectTask;
use App\Models\TaskNotification;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id'  => 'required|exists:projects,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|string',
            'priority'    => 'required|string',
            'assigned_to' => 'nullable|exists:employees,id',
            'due_date'    => 'nullable|date',
        ]);

        $data['assigned_by'] = auth()->id();

        $data['position'] = ProjectTask::where('project_id', $data['project_id'])
            ->where('status', $data['status'])
            ->max('position') + 1;

        $task = ProjectTask::create($data);

        if ($task->assigned_to) {
            TaskNotification::create([
                'project_task_id' => $task->id,
                'employee_id'     => $task->assigned_to,
                'title'           => 'New Task Assigned',
                'message'         => 'You have been assigned a new task: "' . $task->title . '"',
            ]);
        }

        return back()->with('success', 'Task assigned successfully.');
    }

    public function update(Request $request, ProjectTask $projectTask)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|string',
            'priority'    => 'required|string',
            'assigned_to' => 'nullable|exists:employees,id',
            'due_date'    => 'nullable|date',
        ]);

        $projectTask->update($data);

        return back()->with('success', 'Task updated successfully.');
    }

    public function updateStatus(Request $request, ProjectTask $projectTask)
    {
        $data = $request->validate([
            'status' => 'required|string',
        ]);

        $projectTask->update([
            'status' => $data['status'],
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(ProjectTask $projectTask)
    {
        $projectTask->delete();

        return back()->with('success', 'Task deleted successfully.');
    }
}