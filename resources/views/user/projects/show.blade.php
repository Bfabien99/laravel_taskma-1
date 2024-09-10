@extends('layout.user')
@section('content')
<section>
    <div>
        <h2>{{$project->name}}</h2>
        <small class="text-gray-400">{{$project->description}}</small>
        <div>
            <small class="text-gray-500">from {{$project->start_date}}</small>
            <small class="text-gray-500">to {{$project->end_date}}</small>
        </div>
    </div>
    <div>
        <div>
            <a href="{{route('tasks.create', ['project_id' => $project->id])}}">Create new task</a>
        </div>
        <div>
            @forelse ($project->tasks as $task)
                <div class="flex flex-col p-2 border-2 max-w-fit">
                    <p>{{$task->name}}</p>
                    <small class="text-gray-400">{{Str::limit($task->description, 20)}}</small>
                    <small class="text-gray-600 italic">{{$task->end_date}}</small>
                    <div class="flex">
                        <form action="{{route('tasks.destroy', $task->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 bg-red-400 text-white rounded-sm hover:bg-red-500">Delete</button>
                        </form>
                        <a href="{{route('tasks.edit', $task->id)}}"
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