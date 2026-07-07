<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectEvent;
use Illuminate\Http\Request;

class ProjectEventController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $colors = [
            'meeting' => '#0ea5e9',
            'deadline' => '#ef4444',
            'milestone' => '#f59e0b',
            'task' => '#7c3aed',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'nullable',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $project->projectEvents()->create([
            'title' => $request->title,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'type' => $request->type,
            'description' => $request->description,
            'color' => $colors[$request->type] ?? '#64748b',
        ]);

        return back()->with('activeTab', 'calendar');
    }

    public function destroy(ProjectEvent $event)
    {
        $event->delete();

        return back()->with('activeTab', 'calendar');
    }
}