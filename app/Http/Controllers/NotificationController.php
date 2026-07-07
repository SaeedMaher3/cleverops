<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TaskNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $employee = Employee::where('email', auth()->user()->email)->first();

        $notifications = collect();

        if ($employee) {
            $notifications = TaskNotification::with('task.project')
                ->where('employee_id', $employee->id)
                ->latest()
                ->get();
        }

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(TaskNotification $notification)
    {
        $notification->update([
            'is_read' => true,
        ]);

        return back();
    }
}