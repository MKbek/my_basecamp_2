<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function create(Request $request): View
    {
        return view('project.create', [
            'user' => $request->user(),
        ]);
    }

    public function store(CreateProjectRequest $request)
    {
        $project = Project::create($request->only(["name", "description"]));
        $user = ProjectUser::create([
            'user_id' => $request->user()->id,
            'project_id' => $project->id,
            'role' => 'admin'
        ]);

        return redirect()->route('dashboard');
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        $project->update($request->only(["name", "description"]));

        return redirect()->route('dashboard');
    }

    public function delete(Request $request, $project_id) {
        $user = $request->user();
        $project = Project::find($project_id);
        $projectUser = ProjectUser::where('user_id', $user->id)->where('project_id', $project_id);

        if ($projectUser->role != 'admin') {
            return response()->json(
                ['error' => 'Your role not admin']
            );
        }
    }

    public function edit(Request $request, $id) {
        $project = Project::find($id);

        return view('project.edit', compact('project'));
    }

    public function show(Request $request, $id) {
        $project = Project::find($id);
        $project->users = ProjectUser::where('project_id', $id);

        return view('project.show', compact('project'));
    }
}
