@extends('layout')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card rounded-0 shadow p-3">
                    <img src="{{ asset('uploads/' . $post->featured) }}" class="card-img-top img-fluid d-block mx-auto"
                        alt="{{ $post->title }}" style="width: 200px">
                    <div class="card-body">
                        <p>Author: Name</p>
                        Category: <span class="badge bg-success me-2">{{ $post->category->name }}</span>
                        @foreach ($post->tags as $tag)
                            Tag: <span class="badge bg-secondary">{{ $tag->name }}</span>
                        @endforeach
                        <h5 class="card-title mt-3">{{ $post->title }}</h5>
                        <p class="card-text">
                            {{ $post->content }}
                        </p>
                        <p class="card-text">
                            <small class="text-muted"> {{ $post->updated_at->diffForHumans() }} </small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-5">
                    <div class="card-title bg-light text-center py-2">All Tags</div>
                    <div class="card-body p-1 text-center">
                        @foreach ($tags as $tag)
                            <a href="{{ route('postbytag', $tag->slug) }}" class="badge badge-secondary">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                {{-- Related posts --}}
                <div>
                    <div class="card">
                        <div class="card-header bg-light text-center">
                            Related Posts
                        </div>
                    </div>
                    @foreach ($relatedPosts as $repost)
                        <a href="{{ route('postdetail', $repost->slug)}}">
                            {{--  --}}
                            <div class="card mb-3 shadow">
                                <div class="row g-0">

                                    <div class="col-md-4 pt-3">
                                        <img src="{{ asset('uploads/' . $repost->featured) }}"
                                            class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $repost->title }}</h5>
                                            <p class="card-text"> {{ Str::of($repost->content)->words(10, '....') }}
                                            </p>
                                            <p class="card-text"><small class="text-muted">Last updated
                                                    {{ $repost->updated_at->diffForHumans() }}</small>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>


            </div>

        </div>
    </div>
@endsection
