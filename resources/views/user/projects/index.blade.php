@extends('layout.user')
@section('content')
<section class="flex flex-col m-auto max-w-screen-lg grow p-2">
    <div class="p-2 flex flex-col gap-2">
        <a href="{{route('projects.create')}}" class="w-fit bg-gray-900 hover:bg-black p-2 text-white rounded-md font-medium"><i
                class="mx-1">+</i>Create new project <small class="bg-red-400 p-2 rounded-full">{{auth()->user()->projects->count()}}</small></a>
        @if (session()->has('deleted'))
            <div>
                <small class="bg-green-500 text-white p-2 rounded-md">{{session('deleted')}}</small>
            </div>
        @endif
    </div>
    <div class="p-2 flex flex-wrap gap-x-2 gap-y-2">
        @forelse (auth()->user()->projects as $project)
            <div class="flex flex-col p-2 border-2 max-w-fit relative">
                <p>{{$project->name}}</p>
                <small class="text-gray-400">{{Str::limit($project->description, 20)}}</small>
                <small class="text-gray-600 italic"><small class="font-medium">End: </small>{{date('d-m-Y', strtotime($project->end_date));}}</small>
                <div class="flex gap-2 mt-4 items-center">
                    <form action="{{route('projects.destroy', $project->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="p-2 bg-red-400 text-white rounded-sm hover:bg-red-500">Delete</button>
                    </form>
                    <a href="{{route('projects.edit', $project->id)}}"
                        class="p-2 bg-blue-400 text-white rounded-sm hover:bg-blue-500">Edit</a>
                    <a href="{{route('projects.show', $project->id)}}"
                        class="p-2 bg-orange-400 text-white rounded-sm hover:bg-orange-500">Show</a>
                        <small class="bg-red-400 p-2 rounded-full tex-white right-5 text-white font-medium">{{$project->tasks->count()}} task(s)</small>
                </div>
            </div>
        @empty
            <p>No project!</p>
        @endforelse
    </div>
</section>
@endsection