<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
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

        return redirect()->route('project.show', $id);
    }

    public function destroy(Request $request, $id) {
        $user = $request->user();
        $project = Project::find($id);
        $projectUser = ProjectUser::where('user_id', $user->id)->where('project_id', $id)->first();

        if ($projectUser->role != 'admin') {
            return response()->json(
                ['error' => 'Your role not admin']
            );
        }

        $projectUsers = ProjectUser::all()->where('project_id', $id);
        foreach ($projectUsers as $projectUser) {
            $projectUser->delete();
        }

        $project->delete();

        return redirect()->route('dashboard');
    }

    public function edit(Request $request, $id) {
        $project = Project::find($id);

        return view('project.edit', compact('project'));
    }

    public function show(Request $request, $id) {
        $project = Project::find($id);
        $projectUsers = ProjectUser::all()->where('project_id', $id);

        $users = [];
        foreach ($projectUsers as $projectUser) {
            $user = User::find($projectUser->user_id);
            $users[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $projectUser->role,
            ];
        }
        $project->users = $users;

        return view('project.show', compact('project'));
    }

    public function invite(Request $request, $id) {
        $project = Project::find($id);
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $projectUser = ProjectUser::create([
                'user_id' => $user->id,
                'project_id' => $project->id,
                'role' => $request->admin ? 'admin' : 'user'
            ]);
        }

        return redirect()->route('project.show', $id);
    }

    public function leave(Request $request, $id) {
        $project = Project::find($id);
        $user = $request->user_id;

        $projectUser = ProjectUser::where('user_id', $user->id)->where('project_id', $project->id)->first();
        $projectUser->delete();

        return redirect()->route('dashboard');
    }

    public function delete(Request $request, $id, $uid) {
        $user = ProjectUser::where('user_id', $request->user()->id)->first();

        if ($user->role != 'admin') {
            return response()->json(
                ['error' => 'Your role not admin'],
                403
            );
        }

        if ($request->user()->id == $uid) {
            return response()->json(
                ['error' => 'You can not delete yourself'],
                403
            );
        }

        $projectUser = ProjectUser::where('user_id', $uid)->where('project_id', $id)->first();
        $projectUser->delete();

        return redirect()->route('project.show', $id);
    }
}
