@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <h3 class="text-muted text-center">All Posts</h3>
        <div>
            <a href="{{ route('post.create') }}" class="btn btn-info text-white btn-sm mb-4">Create New <i
                class="fa fa-plus"></i> </a>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::of($post->content)->words(4, '....') }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            <img src="{{ asset("uploads/$post->featured")  }}" alt="{{ $post->title }}" width="80" >
                        </td>
                        <td>
                            <a href="{{ route('post.show',$post->id) }}" class="btn btn-sm btn-secondary" title="details">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-info" title="edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                <div class="mx-auto">
                    {{ $posts->links() }}
                </div>

            </tbody>

        </table>
    </div>
@endsection
