<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\ProjectUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttachmentController extends Controller
{
    public function store(Request $request, $id)
    {
        if (!$request->hasFile('attach')) {
            return redirect()->route('project.show', $id);
        }

        $directory = 'public/attachments/' . $id;
        $file = $request->file('attach');
        $file_name = $file->getClientOriginalName();
        $path = $request->file('attach')->storeAs($directory, $file_name);

        Attachment::create([
            'project_id' => $id,
            'file_name' => $file_name,
            'file_path' => $path,
        ]);

        return redirect()->route('project.show', $id);
    }

    public function destroy(Request $request, $id, $fid): RedirectResponse
    {
        $user = ProjectUser::where('user_id', $request->user()->id)->where('project_id', $id)->first();

        if ($user->role !== 'admin') {
            return redirect()->route('project.show', $id);
        }

        $attachment = Attachment::find($fid);
        $attachment->delete();

        return redirect()->route('project.show', $id);
    }
}
