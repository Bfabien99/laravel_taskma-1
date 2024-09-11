@extends('layout.user')
@section('content')
<section class="flex m-auto max-w-screen-lg grow p-2">
    <form action="{{route('projects.update', $project->id)}}" method="post" class="mx-auto p-4 bg-white rounded-sm shadow-sm flex flex-col gap-2 w-full max-w-[500px]">
        <h3 class="uppercase border-b p-1 font-medium text-center">Project Form</h3>
        @if (session()->has('error'))
            <small class="bg-red-400 text-white p-2 rounded-md">{{session('error')}}</small>
        @endif
        @if (session()->has('updated'))
            <small class="bg-green-500 text-white p-2 rounded-md">{{session('updated')}}</small>
        @endif
        @csrf
        @method('PUT')
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">Name</label>
            <input type="text" class="border p-2 rounded-sm" name="name" value="{{old('name', $project->name)}}" placeholder="Enter project name">
            @error('name')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">Description</label>
            <textarea name="description" id="" class="border p-2 rounded-sm" placeholder="Enter description">{{old('description', $project->description)}}</textarea>
            @error('description')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">Start Date</label>
            <input type="date" class="border p-2 rounded-sm" name="start_date" value="{{old('start_date', $project->start_date)}}" placeholder="Enter project start_date">
            @error('start_date')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">End Date</label>
            <input type="date" class="border p-2 rounded-sm" name="end_date" value="{{old('end_date', $project->end_date)}}" placeholder="Enter project end_date">
            @error('end_date')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <button class="bg-gray-900 hover:bg-black text-white p-2 rounded-md font-medium">Edit Project</button>
    </form>
</section>
@endsection