@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <a href="{{ route('post.index', $post->id) }}"> <i class="fa-solid fa-arrow-left-long fa-2x text-info"></i></a>
        <form action="{{ route('post.update', $post->id) }}" method="POST" class="mt-3" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="title" class="mb-1">Title</label>
                <input type="text" id="name" name="title"
                    class="form-control mb-0
                @if ($errors->has('title')) is-invalid @endif"
                    value="{{ $post->title }}">
                @error('title')
                    <div class="text-danger invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="mb-1">Content</label>
                <textarea name="content" id="content" cols="30" rows="5"
                    class="form-control @error('content') is-invalid @enderror mb-0">
                    {{ $post->content }}
                </textarea>
                @error('content')
                    <div class="text-danger invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="mb-1">Choose Category</label>
                <select class="form-select" name="category" id="category">
                    @foreach ($categories as $category )
                        <option value="{{ $category->id }}" @if($post->category_id == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                  </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="featured" class="form-control" id="image">
                <p>Current Image =>
                    <a href="{{ url("uploads/$post->featured") }}">{{ $post->featured }}</a>
                </p>
            </div>
            <button type="submit" class="btn btn-info btn-sm float-end text-white">Update</button>
        </form>
    </div>
@endsection
