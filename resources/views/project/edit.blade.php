<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="block max-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow">
                <form action="{{route('projects.update', $project->id)}}" method="POST">
                    @csrf
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3">
                                    <label for="company-website" class="block text-sm font-medium text-gray-700">Name</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="text" name="name" value="{{$project->name}}" id="company-website" class="block w-full flex-1 rounded-md border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="My Basecamp">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="about" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea id="about" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="Project Description">{{$project->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-cyan-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">Update Project</button>
                        </div>
                    </div>
                    @method('PATCH')
                </form>
            </div>
        </div>
        <div class="max-w-7xl mt-5 mx-auto sm:px-6 lg:px-8">
            <div class="block max-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow">
                <form action="{{ route('project.invite', $project->id )}}" method="POST">
                    @csrf
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3">
                                    <label for="company-website" class="block text-sm font-medium text-gray-700">Add Member</label>
                                    <div class="mt-1 flex gap-5 rounded-md">
                                        <input type="text" name="email" id="company-website" class="block w-full flex-1 rounded-md border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="useremail@eample.com">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="admin" class="sr-only peer" checked>
                                            <div class="w-11 h-[1.55rem] bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-cyan-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[0.55rem] after:left-[0.12rem] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-cyan-600"></div>
                                            <span class="ml-3 text-sm font-medium text-gray-900">Admin permission</span>
                                        </label>
                                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-cyan-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">Add member</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
