@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <a href="{{ route('tag.index') }}"> <i class="fa-solid fa-arrow-left-long fa-2x text-info"></i></a>

        @if (Session::has('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('tag.update', $tag->id) }}" method="POST" class="mt-3" autocomplete="off">
            @csrf
            @method('PATcH')
            <div class="mb-3">
                <label for="name" class="mb-1">Tag Name</label>
                <input type="text" id="name" name="name"
                    class="form-control mb-0
                @if ($errors->has('name')) is-invalid @endif"
                    value="{{ $tag->name }}">
                @error('name')
                    <div class="text-danger invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info btn-sm float-end text-white ">Update</button>
        </form>
    </div>
@endsection
