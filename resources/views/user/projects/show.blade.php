@extends('layout.user')
@section('content')
<section class="flex flex-col gap-2 m-auto max-w-screen-lg grow p-2">
    <div class="flex flex-col p-4 items-center gap-1">
        <h2>{{$project->name}}</h2>
        <small class="text-gray-400">{{$project->description}}</small>
        <div class="flex gap-4 p-2">
            <p class="text-gray-500"><small class="font-medium">Start:</small> {{date('d-m-Y', strtotime($project->start_date));}}</p>
            <p class="text-gray-500"><small class="font-medium">End:</small> {{date('d-m-Y', strtotime($project->end_date));}}</p>
        </div>
    </div>
    <div class="flex flex-col gap-2 my-2">
        <a href="{{route('tasks.create', ['project_id' => $project->id])}}" class="w-fit bg-gray-900 hover:bg-black p-2 text-white rounded-md font-medium"><i class="mx-1">+</i>Add new task <small class="bg-red-400 p-2 rounded-full">{{$project->tasks->count()}}</small></a>
        <div class="flex flex-wrap gap-x-2 gap-y-2">
            @forelse ($project->tasks as $task)
                <div class="flex flex-col p-2 border-2 max-w-fit">
                    <p>{{$task->name}}</p>
                    <small class="text-gray-400">{{$task->description}}</small>
                    <small class="text-gray-600 italic"><small class="font-medium">End: </small>{{date('d-m-Y', strtotime($task->end_date))}}</small>
                    <div class="flex gap-2 mt-4">
                        <form action="{{route('tasks.destroy', $task->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 bg-red-400 text-white rounded-sm hover:bg-red-500">Delete</button>
                        </form>
                        <a href="{{route('tasks.edit', ['task' => $task->id])}}"
                            class="p-2 bg-blue-400 text-white rounded-sm hover:bg-blue-500">Edit</a>
                    </div>
                </div>
            @empty
                <p>No Task!</p>
            @endforelse
        </div>
    </div>
</section>
@endsection