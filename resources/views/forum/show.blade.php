{{-- resources/views/forum/show.blade.php --}}
@extends('layouts.show_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Main Post -->
            <div class="card mb-3 main-post">
                <div class="card-body">
                    @if(is_null($post->parent))
                        <h3 class="card-title">{{ $post->title }}</h3>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-0 text-muted">{{ $post->user->name }}</h6>
                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                        <small class="card-subtitle text-muted">{{ $post->user->email }}</small>
                    </div>
                    <p class="card-text mt-3">{{ $post->content }}</p>

                    <!-- Display Images -->
                    @if($post->images->isNotEmpty())
                        <div class="row mt-3">
                            @foreach($post->images->take(4) as $image)
                                <div class="col-6 mb-2">
                                    <img src="{{ $image->url }}" class="img-fluid rounded border image-grid" alt="Image">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Comments Section -->
            @include('forum.comments', ['comments' => $post->comments, 'indent' => 0])

            <!-- Add Comment Form -->
            <div class="card mt-3">
                <div class="card-body">
                    <form action="{{ route('forum.storeReply') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="content">Add a Comment</label>
                            <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
                        </div>
                        <input type="hidden" name="parent" value="{{ $post->id_post }}">
                        <button type="submit" class="btn btn-primary mt-3">Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection