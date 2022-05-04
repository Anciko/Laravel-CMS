@extends('layouts.app')

@section('content')
    <div class="card p-4">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('post.index') }}" class="text-decoration-none">
                    <div class="card bg-warning border-0 text-white p-3">
                        <div>
                            <i class="fa-solid fa-earth-oceania fa-2x"></i>
                            <span class="float-end">{{$postcount}}</span>
                        </div>
                        <span>Posts</span>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('category.index') }}" class="text-decoration-none">
                    <div class="card bg-success border-0 text-white p-3">
                        <div>
                            <i class="fa-solid fa-earth-oceania fa-2x"></i>
                            <span class="float-end">{{ $catcount }}</span>
                        </div>
                        <span>Category</span>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('tag.index') }}" class="text-decoration-none">
                    <div class="card bg-info border-0 text-white p-3">
                        <div>
                            <i class="fa-solid fa-earth-oceania fa-2x"></i>
                            <span class="float-end">4</span>
                        </div>
                        <span>{{$tagcount}}</span>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('user.index') }}" class="text-decoration-none">
                    <div class="card bg-secondary border-0 text-white p-3">
                        <div>
                            <i class="fa-solid fa-earth-oceania fa-2x"></i>
                            <span class="float-end">4</span>
                        </div>
                        <span>{{$usercount}}</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
