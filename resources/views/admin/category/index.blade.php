@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ route('category.create') }}" class="btn btn-info text-white btn-sm mb-4">Create New <i
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
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{route('category.edit', $category->id)}}" class="btn btn-sm btn-info" title="edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{route('category.destroy', $category->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
