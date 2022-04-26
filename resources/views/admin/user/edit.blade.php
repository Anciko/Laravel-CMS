@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <a href="{{ route('home') }}"> <i class="fa-solid fa-arrow-left-long fa-2x text-info"></i></a>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="text-center">
            <img src="{{ asset("profile/". $user->profile->profile_image) }}" alt="User Profile" width="200" class="img-fluid">
        </div>
        <form action="{{ url('/admin/user/' . auth()->user()->id) }}" method="POST" class="mt-3"
            autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name" class="mb-1">Name</label>
                <input type="text" id="name" name="name" class="form-control mb-0" value="{{ auth()->user()->name }}">
            </div>
            <div class="mb-3">
                <label for="name" class="mb-1">Email</label>
                <input type="email" id="email" name="email" class="form-control mb-0" value="{{ auth()->user()->email }}">
            </div>
            <div class="mb-3">
                <label for="name" class="mb-1">Password</label>
                <input type="password" id="password" name="password" class="form-control mb-0">
            </div>
            <div class="mb-3">
                <label for="about" class="mb-1">About</label>
                <textarea name="about" id="about" cols="30" rows="5" class="form-control">
                    {{ $user->profile->about }}
                </textarea>
            </div>
            <div class="mb-3">
                <label for="fb_link" class="mb-1">Facebook Link</label>
                <input type="text" id="fb_link" name="facebook_link" class="form-control mb-0"
                    value="{{ $user->profile->facebook_link }}">
            </div>
            <div class="mb-3">
                <label for="yt_link" class="mb-1">Youtube Link</label>
                <input type="text" id="yt_link" name="youtube_link" class="form-control mb-0"
                    value="{{ $user->profile->youtube_link }}">
            </div>
            <div class="mb-3">
                <label for="image" class="mb-1">Upload Image</label>
                <input type="file" id="image" name="image" class="form-control mb-0">
            </div>
            <button type="submit" class="btn btn-info btn-sm float-end text-white">Update</button>
        </form>
    </div>
@endsection
