@extends('layout')

@section('content')
    <div class="container my-4">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4">
                    <div class=" mb-3 card bg-light">
                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                            <img src="{{ asset('/uploads/' . $post->featured) }}" width="100" height="100"
                                class="img-fluid mx-auto d-block" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                            </a>
                        </div>
                        <div class="card-body">
                            <span class="badge badge-success">{{ $post->category->name }}</span>
                            @foreach ($post->tags as $tag)
                                <span class="badge badge-secondary">{{ $tag->name }}</span>
                            @endforeach
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::words($post->content, 20, '...') }}</p>
                            <a href="{{ route('postdetail', $post->slug) }}" class="btn btn-info btn-sm shadow mx-auto">See Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 mx-auto">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
