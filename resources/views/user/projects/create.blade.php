@extends('layout.user')
@section('content')
<section>
    <form action="{{route('projects.store')}}" method="post"class="p-4 bg-white rounded-sm shadow-sm flex flex-col gap-2 w-[500px]">
        <h3 class="uppercase border-b p-1">Project Form</h3>
        @if (session()->has('error'))
            <small class="bg-red-400 text-white p-2 rounded-md">{{session('error')}}</small>
        @endif
        @if (session()->has('success'))
            <small class="bg-green-500 text-white p-2 rounded-md">{{session('success')}}</small>
        @endif
        @csrf
        <div class="flex flex-col">
            <label for="">Name</label>
            <input type="name" class="border p-2 rounded-sm" name="name" value="{{old('name')}}" placeholder="Enter project name">
            @error('name')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="">Description</label>
            <textarea name="description" id="" class="border p-2 rounded-sm" placeholder="Enter description">{{old('description')}}</textarea>
            @error('description')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="">Start Date</label>
            <input type="date" class="border p-2 rounded-sm" name="start_date" value="{{old('start_date')}}" placeholder="Enter project start_date">
            @error('start_date')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="">End Date</label>
            <input type="date" class="border p-2 rounded-sm" name="end_date" value="{{old('end_date')}}" placeholder="Enter project end_date">
            @error('end_date')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <button class="bg-black text-white p-2 rounded-md hover:bg-gray-900">Login</button>
    </form>
</section>
@endsection