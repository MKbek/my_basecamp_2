<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $projects = $request->user()->projectUser;

        foreach ($projects as $project) {
            $projectUsers = ProjectUser::all()->where('project_id', $project->project_id);

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
            $project->meta = Project::find($project->project_id);
        }

        return view('dashboard', [
            'projects' => $projects,
        ]);
    }

    public function welcome(Request $request)
    {
        if (!$request->user()) {
            return view('welcome');
        } else {
            return redirect()->route('dashboard');
        }
    }
}
