@extends('layouts.app')

@section('content')
    <div class="card p-3">
        <a href="{{ route('category.index') }}"> <i class="fa-solid fa-arrow-left-long fa-2x text-info"></i></a>
        <form action="{{route('category.update', $category->id)}}" method="POST" class="mt-3" autocomplete="off">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name" class="mb-1">Category Name</label>
                <input type="text" id="name" name="name" class="form-control mb-0
                @if($errors->has('category')) is-invalid @endif" value="{{$category->name}}">
                @error('name')
                    <div class="text-danger invalid-feedback"> {{$message}} </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info btn-sm float-end text-white">Update</button>
        </form>
    </div>
@endsection
