@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <a href="{{ route('user.index') }}"> <i class="fa-solid fa-arrow-left-long fa-2x text-info"></i></a>

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

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="mb-1">Username</label>
                <input type="text" id="name" name="name" class="form-control mb-0 @error('name') is-invalid @enderror">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="mb-1">Email</label>
                <input type="email" id="email" name="email" class="form-control mb-0 @error('email') is-invalid @enderror">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="mb-1">Password</label>
                <input type="password" id="password" name="password" class="form-control mb-0 @error('password') is-invalid @enderror">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-info btn-sm text-white float-end">Create</button>
        </form>


    </div>
@endsection
