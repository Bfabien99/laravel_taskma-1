@extends('layout.user')
@section('content')
<section class="flex flex-col m-auto max-w-screen-lg grow p-2">
    <div class="p-2 flex flex-col gap-2">
        <a href="{{route('tasks.create')}}" class="w-fit bg-gray-900 hover:bg-black p-2 text-white rounded-md font-medium"><i
                class="mx-1">+</i>Create new task <small class="bg-red-400 p-2 rounded-full">{{auth()->user()->tasks->count()}}</small></a>
        @if (session()->has('deleted'))
            <div>
                <small class="bg-green-500 text-white p-2 rounded-md">{{session('deleted')}}</small>
            </div>
        @endif
    </div>
    <div class="p-2 flex flex-wrap gap-x-2 gap-y-2">
        @forelse (auth()->user()->tasks as $task)
            <div class="flex flex-col p-2 border-2 max-w-fit">
                <p>{{$task->name}}</p>
                <small class="text-gray-400">{{Str::limit($task->description, 20)}}</small>
                <small class="text-gray-600 italic"><small class="font-medium">End: </small>{{date('d-m-Y', strtotime($task->end_date))}}</small>
                <div class="flex gap-2 mt-4">
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
</section>
@endsection