<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTopicRequest;
use App\Http\Requests\SendMessageRequest;
use App\Models\ProjectUser;
use App\Models\Topic;
use App\Models\TopicMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TopicsController extends Controller
{
    public function store(CreateTopicRequest $request, $id): RedirectResponse
    {
        $user = ProjectUser::where('project_id', $id)->where('user_id', $request->user()->id)->first();

        if ($user->role !== 'admin') {
            return redirect()->route('project.show', $id);
        }

        $topic = Topic::create([
            'project_id' => $id,
            'user_id' => $request->user()->id,
            'title' => $request->title,
        ]);

        return redirect()->route('project.show', $id);
    }

    public function edit(Request $request, $id): View|RedirectResponse
    {
        $topic = Topic::find($id);
        $user = ProjectUser::where('project_id', $topic->project_id)->where('user_id', $request->user()->id)->first();

        if ($user->role !== 'admin') {
            return redirect()->route('project.show', $id);
        }

        return view('topic.edit', compact('topic'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $topic = Topic::find($id);
        $user = ProjectUser::where('project_id', $topic->project_id)->where('user_id', $request->user()->id)->first();

        if ($user->role !== 'admin') {
            return redirect()->route('project.show', $topic->project_id);
        }

        $topic->update($request->only(['title']));

        return redirect()->route('project.show', $topic->project_id);
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $topic = Topic::find($id);
        $user = ProjectUser::where('project_id', $topic->project_id)->where('user_id', $request->user()->id)->first();

        if ($user->role !== 'admin') {
            return redirect()->route('project.show', $topic->project_id);
        }

        $messages = TopicMessage::all()->where('topic_id', $id);
        if ($messages) {
            foreach ($messages as $message) {
                $message->delete();
            }
        }
        $topic->delete();

        return redirect()->route('project.show', $topic->project_id);
    }

    public function message(SendMessageRequest $request, $id): RedirectResponse
    {
        $topic = Topic::find($id);

        $message = TopicMessage::create([
            'topic_id' => $id,
            'user_id' => $request->user()->id,
            'message' => $request->message,
        ]);

        return redirect()->route('project.show', [$topic->project_id, '#topic-' . $id]);
    }

    public function editMessage(Request $request, $id, $mid): View|RedirectResponse
    {
        $message = TopicMessage::where('id', $mid)->where('user_id', $request->user()->id)->first();
        $topic = Topic::find($id);

        if (!$message) {
            return redirect()->route('project.show', [$id, '#topic-' . $topic->id]);
        }

        $user = ProjectUser::where('project_id', $topic->project_id)->where('user_id', $request->user()->id)->first();

        if ($user->role !== 'admin' || $message->user_id !== $request->user()->id) {
            return redirect()->route('project.show', [$topic->project_id, '#topic-' . $topic->id]);
        }

        return view('topic.message.edit', compact('topic','message'));
    }

    public function updateMessage(Request $request, $id, $mid): RedirectResponse
    {
        $message = TopicMessage::where('id', $mid)->where('user_id', $request->user()->id)->first();
        $topic = Topic::find($id);

        if (!$message) {
            return redirect()->route('project.show', [$id, '#topic-' . $topic->id]);
        }

        $user = ProjectUser::where('project_id', $topic->project_id)->where('user_id', $request->user()->id)->first();

        if ($user->role !== 'admin' || $message->user_id !== $request->user()->id) {
            return redirect()->route('project.show', [$topic->project_id, '#topic-' . $topic->id]);
        }

        $message->update($request->only(['message']));

        return redirect()->route('project.show', [$topic->project_id, '#topic-' . $id]);
    }

    public function deleteMessage(Request $request, $id, $mid): RedirectResponse
    {
        $message = TopicMessage::where('id', $mid)->where('user_id', $request->user()->id)->first();

        if (!$message) {
            return redirect()->route('project.show', $id);
        }

        $topic = Topic::find($id);
        $user = ProjectUser::where('project_id', $topic->project_id)->where('user_id', $request->user()->id)->first();

        if ($user->role !== 'admin' || $message->user_id !== $request->user()->id) {
            return redirect()->route('project.show', $topic->project_id);
        }

        $message->delete();

        return redirect()->route('project.show', [$topic->project_id, '#topic-' . $id]);
    }
}
