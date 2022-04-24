@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <a href="{{ route('post.index') }}"> <i class="fa-solid fa-arrow-left-long fa-2x text-info"></i></a>


        @if (Session::has('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('post.store') }}" method="POST" class="mt-3" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="mb-1">Post Title</label>
                <input type="text" id="name" name="title" class="form-control mb-0 @error('title') is-invalid @enderror">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="mb-1">Post Content</label>
                <textarea name="content" id="content" cols="30" rows="5"
                    class="form-control mb-0 @error('content') is-invalid @enderror"></textarea>
                @error('content')
                    <div class="text-danger"> {{ $message }} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="featured" class="mb-1">Featured</label>
                <input type="file" id="featured" name="image"
                    class="form-control mb-0
                @error('image') is-invalid @enderror">
                @error('image')
                    <div class="text-danger"> {{ $message }} </div>
                @enderror
            </div>
            <div class="mb-3">
                <p class="mb-0">Choose Tag</p>
                <div class="mb-3 d-flex">
                    @foreach ($tags as $tag)
                        <div class="d-flex me-3">
                            <label for="{{ $tag->name }}">{{ $tag->name }}</label>
                            <input type="checkbox" name="tags[]" class="form-check ms-1" value="{{ $tag->id }}"
                                id="{{ $tag->name }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label for="category" class="mb-1">Category</label>
                <select class="form-select" name="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-info btn-sm float-end text-white ">Create</button>
        </form>
    </div>
@endsection
