@extends('layout.user')
@section('content')
<section>
    <div>
        <a href="{{route('projects.create')}}">Create new project</a>
    </div>
    <div class="p-2 flex flex-wrap">
        @if (session()->has('deleted'))
            <small class="bg-green-500 text-white p-2 rounded-md">{{session('deleted')}}</small>
        @endif
        @forelse ($projects as $project)
            <div class="flex flex-col p-2 border-2 max-w-fit">
                <p>{{$project->name}}</p>
                <small class="text-gray-400">{{Str::limit($project->description, 20)}}</small>
                <small class="text-gray-600 italic">{{$project->end_date}}</small>
                <div class="flex">
                    <form action="{{route('projects.destroy', $project->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="p-2 bg-red-400 text-white rounded-sm hover:bg-red-500">Delete</button>
                    </form>
                    <a href="{{route('projects.edit', $project->id)}}" class="p-2 bg-blue-400 text-white rounded-sm hover:bg-blue-500">Edit</a>
                    <a href="{{route('projects.show', $project->id)}}" class="p-2 bg-orange-400 text-white rounded-sm hover:bg-orange-500">Show</a>
                </div>
            </div>
        @empty
            <p>No project!</p>
        @endforelse
    </div>
</section>
@endsection