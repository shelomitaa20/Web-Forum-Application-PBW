{{-- resources/views/forum/comments.blade.php --}}
@foreach($comments as $comment)
    <div class="card mb-3" style="margin-left: {{ ($indent + 1) * 30 }}px;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-subtitle mb-2 text-muted">{{ $comment->user->name }}</h5>
                    <p class="card-text">{{ $comment->content }}</p>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <div class="ml-auto d-flex flex-column align-items-center">
                    <!-- Like and Share buttons -->
                    <div class="d-flex">
                        <div class="tex-center">
                            <form action="{{ route('forum.like') }}" method="POST" class="me-2">
                                @csrf
                                <input type="hidden" name="id_post" value="{{ $comment->id_post }}">
                                <button type="submit" class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                    <i class="far fa-thumbs-up"></i>
                                </button>
                            </form>
                            <span class="text-muted ms-2">{{ $comment->total_likes }}</span>
                        </div>
                        <div class="tex-center">
                            <form action="{{ route('forum.share') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_post" value="{{ $comment->id_post }}">
                                <button type="submit" class="btn btn-sm btn-outline-success d-flex align-items-center">
                                    <i class="fas fa-share"></i>
                                </button>
                            </form>
                            <span class="text-muted ms-2">{{ $comment->total_shares }}</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        
                        
                    </div>
                </div>
            </div>

            <!-- Reply form for each comment -->
            <div class="mt-3">
                <button class="btn btn-sm btn-link" data-bs-toggle="collapse" data-bs-target="#replyForm{{ $comment->id_post }}" aria-expanded="false" aria-controls="replyForm{{ $comment->id_post }}">
                    Reply
                </button>
                <div class="collapse mt-2" id="replyForm{{ $comment->id_post }}">
                    <form action="{{ route('forum.storeReply') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" rows="2" class="form-control" required></textarea>
                        </div>
                        <input type="hidden" name="parent" value="{{ $comment->id_post }}">
                        <button type="submit" class="btn btn-primary btn-sm">Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($comment->comments->isNotEmpty())
        @include('forum.comments', ['comments' => $comment->comments, 'indent' => $indent + 1])
    @endif
@endforeach
