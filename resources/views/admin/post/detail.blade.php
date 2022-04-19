@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ route('post.index') }}"> <i class="fa-solid fa-arrow-left-long fa-2x text-info"></i></a>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

       <div class="text-center mb-2">
           <img src="{{ asset("uploads/$post->featured") }}" alt="" width="150" class="img-fluid">
       </div>
       <h4 class="text-secondary">Title : {{ $post->title }}</h4>
       <h4 class="text-secondary">Category : {{ $post->category->name }}</h4>
       <h4 class="text-secondary">Content : {{ $post->content }} </h4>
       <i class="text-end">{{ $post->updated_at }}</i>


    </div>
@endsection
