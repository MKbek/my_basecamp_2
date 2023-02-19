<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $projects = $request->user()->projectUser;

        foreach ($projects as $project) {
            $project->users = ProjectUser::where('project_id', $project->project_id);
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
