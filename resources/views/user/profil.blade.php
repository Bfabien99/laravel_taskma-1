@extends('layout.user')
@section('content')
<section class="flex flex-col mx-auto max-w-screen-lg grow p-2 gap-4">
    <h1 class="text-4xl w-fit mx-auto">my profil</h1>
    <form action="{{route('profil.info')}}" method="post" class="mx-auto p-4 bg-white rounded-sm shadow-sm flex flex-col gap-2 w-full max-w-[500px] my-3">
        <h3 class="uppercase border-b p-1 font-medium text-center">Update information Form</h3>
        @if (session()->has('success-info'))
            <small class="bg-green-500 text-white p-2 rounded-md">{{session('success-info')}}</small>
        @endif
        @if (session()->has('error-info'))
            <small class="bg-red-500 text-white p-2 rounded-md">{{session('error-info')}}</small>
        @endif
        @csrf
        @method('PUT')
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">Fullname</label>
            <input type="text" class="border p-2 rounded-sm" name="name" placeholder="Enter your fullname" value="{{old('name', auth()->user()->name)}}">
            @error('name')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">Email</label>
            <input type="email" class="border p-2 rounded-sm" name="email" placeholder="Enter your email" value="{{old('email', auth()->user()->email)}}">
            @error('email')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <button class="bg-gray-900 hover:bg-black text-white p-2 rounded-md font-medium">Update information</button>
    </form>
    <form action="{{route('profil.pass')}}" method="post" class="mx-auto p-4 bg-white rounded-sm shadow-sm flex flex-col gap-2 w-full max-w-[500px] my-3">
        <h3 class="uppercase border-b p-1 font-medium text-center">Update Password Form</h3>
        @if (session()->has('success-pass'))
            <small class="bg-green-500 text-white p-2 rounded-md">{{session('success-pass')}}</small>
        @endif
        @if (session()->has('error-pass'))
            <small class="bg-red-500 text-white p-2 rounded-md">{{session('error-pass')}}</small>
        @endif
        @csrf
        @method('PUT')
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">Password</label>
            <input type="password" class="border p-2 rounded-sm" placeholder="Enter your password" name="password">
            @error('password')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">Confirm Password</label>
            <input type="password" class="border p-2 rounded-sm" placeholder="Enter your password again" name="password_confirmation">
            @error('password_confirmation')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <button class="bg-gray-900 hover:bg-black text-white p-2 rounded-md font-medium">Update password</button>
    </form>
</section>
@endsection