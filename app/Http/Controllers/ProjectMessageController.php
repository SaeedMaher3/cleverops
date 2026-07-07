<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMessage;
use Illuminate\Http\Request;

class ProjectMessageController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'message' => 'nullable|string',
            'attachment' => 'nullable|file|max:20480',
        ]);

        $path = null;
        $name = null;
        $type = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            $path = $file->store('project-chat', 'public');
            $name = $file->getClientOriginalName();
            $type = $file->getClientMimeType();
        }

        $message = ProjectMessage::create([
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'attachment_path' => $path,
            'attachment_name' => $name,
            'attachment_type' => $type,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message->load('user')
        ]);
    }
}