@extends('layout.user')
@section('content')
<section>
    <div>
        <a href="{{route('tasks.create')}}">Create new task</a>
    </div>
    <div class="p-2 flex flex-wrap">
        @if (session()->has('deleted'))
            <small class="bg-green-500 text-white p-2 rounded-md">{{session('deleted')}}</small>
        @endif
        @forelse ($tasks as $task)
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
                    <a href="{{route('tasks.edit', $task->id)}}" class="p-2 bg-blue-400 text-white rounded-sm hover:bg-blue-500">Edit</a>
                </div>
            </div>
        @empty
            <p>No Task!</p>
        @endforelse
    </div>
</section>
@endsection