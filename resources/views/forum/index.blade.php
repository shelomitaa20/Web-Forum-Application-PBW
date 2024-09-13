{{-- resources/views/forum/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Forum</h1>
            <a href="{{ route('forum.create') }}" class="btn btn-primary">Add New Post</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($posts->isEmpty())
                <div class="alert alert-warning text-center">No posts yet</div>
            @else
                @foreach($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    Posted by {{ $post->user->name }} ({{ $post->user->email }})
                                    <br>
                                    {{ $post->created_at->diffForHumans() }}
                                </small>
                                <div class="d-flex align-items-center">
                                    <!-- Like Button -->
                                    <form action="{{ route('forum.like') }}" method="POST" class="me-2 text-center">
                                        @csrf
                                        <input type="hidden" name="id_post" value="{{ $post->id_post }}">
                                        <button type="submit" class="btn btn-sm btn-outline-primary d-flex flex-column align-items-center">
                                            <i class="far fa-thumbs-up"></i>
                                        </button>
                                        <span class="text-muted">{{ $post->total_likes }}</span>
                                    </form>
                                    <!-- Share Button -->
                                    <form action="{{ route('forum.share') }}" method="POST" class="text-center">
                                        @csrf
                                        <input type="hidden" name="id_post" value="{{ $post->id_post }}">
                                        <button type="submit" class="btn btn-sm btn-outline-success d-flex flex-column align-items-center">
                                            <i class="fas fa-share"></i>
                                        </button>
                                        <span class="text-muted">{{ $post->total_shares }}</span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div>
                                <!-- View Comments Button -->
                                <a href="{{ route('forum.show', $post->id_post) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-comments"></i> View Comments
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
