@extends('layout.app')
@section('content')
<section class="flex m-auto max-w-screen-lg grow p-2">
    <form method="post" class="mx-auto p-4 bg-white rounded-sm shadow-sm flex flex-col gap-2 w-full max-w-[500px]">
        <h3 class="uppercase border-b p-1 font-medium text-center">RESET your password</h3>
        @if (session()->has('error'))
            <small class="bg-red-400 text-white p-2 rounded-md">{{session('error')}}</small>
        @endif
        @csrf
        @if (session()->has(key: 'success'))
            <div class="flex flex-col">
                <small class="bg-green-500 text-white w-fit p-1">{{session('success')}}</small>
                <p>Go to open your mail</p>
            </div>
        @endif
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">New Password</label>
            <input type="password" class="border p-2 rounded-sm" placeholder="Enter your password" name="password">
            @error('password')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="" class="font-medium capitalize">Confirm New Password</label>
            <input type="password" class="border p-2 rounded-sm" placeholder="Enter your password again" name="password_confirmation">
            @error('password_confirmation')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        </div>
        <button class="bg-gray-900 hover:bg-black text-white p-2 rounded-md font-medium" @if(session()->has(key: 'success')) disabled @endif>Update Password</button>
    </form>
</section>
@endsection