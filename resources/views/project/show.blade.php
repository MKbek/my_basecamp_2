<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($project)
                {{ $project->name }}
            @else
                {{ __('Project not found') }}
            @endif
        </h2>
    </x-slot>

    {{--<pre>
        {{ $project }}
    </pre>--}}
    @if($project)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between gap-10">
                <div class="w-full">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl ring-1 ring-cyan-500 flex flex-col p-6">
                    <div class="text-2xl">
                            {{ $project->name }}
                        </div>
                        <div class="mt-5 text-gray-500">
                            {{ $project->description }}
                        </div>
                    </div>

                    <section id="members" class="flex flex-col gap-2 mt-7">
                        <h2 class="text-2xl ml-4">Members</h2>
                        <div class="w-fit text-gray-500 flex gap-4">
                            @foreach($project->users as $user)
                                <div class="pointer-events-auto w-[20em] rounded-lg bg-white py-2 px-5 text-[0.8125rem] leading-5 shadow-xl shadow-black/5 hover:bg-slate-50 ring-1 ring-cyan-500 cursor-default">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-1 font-medium text-slate-900 text-lg">
                                            @if($user['role'] === 'admin')
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-yellow-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                            </svg>
                                            @endif
                                            {{ $user['name'] }}
                                        </div>
                                        @if($authUser['role'] === 'admin')
                                        <form action="{{ route('project.delete', [$project->id, $user['id']]) }}" method="POST">
                                            @csrf
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-600 cursor-pointer">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="text-slate-700 text-xs">{{ $user['email'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                    <section id="topics" class="flex flex-col gap-2 mt-7">
                        <h2 class="text-2xl ml-4">Topics</h2>
                        @if($authUser['role'] === 'admin')
                        <form action="{{ route('topic.store', $project->id) }}" method="POST">
                            @csrf
                            <div class="shadow-lg sm:overflow-hidden rounded-xl ring-1 ring-cyan-500">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3">
                                            <label for="title" class="block text-sm font-medium text-gray-700">Add new topic</label>
                                            <div class="mt-1 flex gap-5 rounded-md">
                                                <input type="text" name="title" id="title" class="block w-full flex-1 rounded-md border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="Discussion">
                                                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-cyan-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">Add topic</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endif
                        @if ($project->topics)
                            <div class="text-gray-500 flex gap-4 mt-5 flex-row flex-wrap">
                            @foreach($project->topics as $topic)
                                <div class="relative pointer-events-auto w-[20.95rem] h-96 rounded-xl bg-white overflow-hidden text-[0.8125rem] leading-5 shadow-xl shadow-black/5 hover:bg-slate-50 ring-1 ring-cyan-500 cursor-default">
                                    <div class="flex justify-between items-center py-2 px-5 bg-gray-200/50 border-b border-gray-500">
                                        <div class="font-medium text-slate-900 text-lg">{{ $topic['title'] }}</div>
                                        @if($authUser['role'] === 'admin')
                                        <form action="{{ route('topic.destroy', $topic['id']) }}" method="POST">
                                            <div class="flex items-center gap-2">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('topic.edit', $topic['id']) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 stroke-current">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </a>
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-600 cursor-pointer">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                            </div>
                                        </form>
                                        @endif
                                    </div>
                                    <div id="topic-{{ $topic['id'] }}" class="w-full h-[23em] bg-white shadow-lg p-5 flex flex-col gap-3 overflow-y-scroll">
                                        @foreach($topic['messages'] as $message)
                                            @if ($message['user']['id'] === $authUser['user_id'])
                                            <div class="flex justify-end gap-2">
                                                <div class="flex flex-col p-2 bg-cyan-50 rounded-md ring-1 ring-cyan-400 ">
                                                    <div class="text-cyan-500 text-xs">{{ $message['user']['email'] }}</div>
                                                    <div class="text-gray-900">{{ $message['message'] }}</div>
                                                </div>
                                                <div class="flex flex-col justify-center items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-cyan-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                                    </svg>
                                                    <a href="{{ route('topic.message.edit', [$topic['id'], $message['id']]) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            @else
                                            <div class="flex justify-start gap-2 w-fit">
                                                <div class="flex flex-col justify-center items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                                    </svg>
                                                    @if ($authUser['role'] === 'admin')
                                                    <a href="{{ route('topic.message.edit', [$topic['id'], $message['id']]) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </a>
                                                    @endif
                                                </div>
                                                <div class="flex flex-col p-2 bg-gray-50 rounded-md ring-1 ring-gray-400 ">
                                                    <div class="text-gray-500 text-xs">{{ $message['user']['email'] }}</div>
                                                    <div class="text-gray-900">{{ $message['message'] }}</div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <form action="{{ route('topic.message', $topic['id']) }}" method="POST" class="absolute left-0 right-0 bottom-0">
                                        @csrf
                                        <div class="flex gap-1 w-full bg-gray-100 border-t border-gray-500">
                                            <input type="text" name="message" id="message" class="block w-full bg-transparent flex-1 border-none focus:ring-cyan-500 sm:text-sm" placeholder="Message...">
                                            <button type="submit" class="inline-flex justify-center rounded-full border border-transparent bg-cyan-600 my-1 mx-2 py-1 px-1 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </section>
                    <section id="attachments" class="flex flex-col gap-2 mt-7">
                        <h2 class="text-2xl ml-4">Attachments</h2>
                        @if($project->attachments)
                            <div class="flex flex-row flex-wrap items-center gap-3">
                                @foreach($project->attachments as $attach)
                                    <div class="pointer-events-auto w-[39em] rounded-lg bg-white py-2 px-5 text-[0.8125rem] leading-5 shadow-xl shadow-black/5 hover:bg-slate-50 ring-1 ring-cyan-500 cursor-default">
                                        <div class="flex justify-between items-center">
                                            <a href="{{$attach['file_path']}}" target="_blank" class="flex items-center gap-1 font-medium text-slate-900 text-md">
                                                {{ $attach['file_name'] }}
                                            </a>
                                            @if($authUser['role'] === 'admin')
                                                <form action="{{ route('attachment.destroy', [$project->id, $attach['id']]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-600 cursor-pointer">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('attachment.store', $project->id) }}" method="POST" enctype="multipart/form-data" class="mt-5">
                            @csrf
                            <div class="shadow-md sm:overflow-hidden rounded-xl ring-1 ring-cyan-500">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3">
                                            <label class="block mb-2 text-sm font-medium text-gray-900">Add new attachment</label>
                                            <div class="mt-1 flex gap-5 rounded-md">
                                                <input type="file" name="attach" class="block py-2 px-5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-cyan-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 whitespace-nowrap">Add attachment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-[0.9px] rounded-md shadow border border-gray-900 bg-gray-900 overflow-hidden" role="group">
                        @if($authUser['role'] === 'admin')
                        <a href="{{ route('project.edit', $project->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Edit Project
                        </a>
                        @endif
                        <a href="#members" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            Members
                        </a>
                        <a href="#topics" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                            </svg>
                            Topics
                        </a>
                        <a class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            Tasks
                        </a>
                        <a href="#attachments" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                            </svg>
                            Attachments
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
