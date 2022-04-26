@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <h4 class="text-center text-muted">All Users</h4>
        <div>
            <a href="{{ route('user.create') }}" class="btn btn-info btn-sm mb-4 text-white">
                <i class="fa fa-plus"></i>
                Create New User
            </a>
        </div>
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


        <table class="table ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Set Permission</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if ($user->is_admin != 0)
                                <a href="" class="badge badge-info bg-info text-decoration-none text-white">Set User</a>
                            @else
                                <a href="" class="badge badge-warning bg-warning text-decoration-none text-white">Set
                                    Admin</a>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
