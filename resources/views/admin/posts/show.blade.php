<x-home-master>
    @section('content')

        <!-- Title -->
        <h1 class="mt-4">{{ $post->title }}</h1>

        <!-- Author -->
        <p class="lead">
        by
        <a href="#">{{ $post->user->name ?? 'unknown' }}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on {{ $post->created_at->diffForHumans() }}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{ $post->post_image }}" alt="">

        <hr>

        <!-- Post Content -->
        <p>{{ $post->body }}</p>
        <hr>

        @if (session()->has('message-post-created'))
            <div class="alert alert-success" role="alert">{{ session()->get('message-post-created') }}</div>
        @endif

        <!-- Comments Form -->
        <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
            <form action="{{ route('comments.store')}}" method="POST">
                @csrf
                @method('POST')

                <input type="hidden" name="post_id" value={{ $post->id }}>

                <div class="form-group">
                    <textarea
                        id="body"
                        class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
                        rows="3"
                        name="body"
                        ></textarea>

                        @foreach($errors->get('body') as $message)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

        @if(count($comments) > 0)
            @foreach ($comments as $comment )
                <!-- Single Comment -->
                @if ($comment->is_active === 1)
                    <div class="media mb-4">
                        <img class="d-flex mr-3 rounded-circle" height="50" src="{{ $comment->photo }}" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">{{ $comment->author }}
                                <small class="text-secondary">{{ $comment->created_at->diffForHumans() }}</small>
                            </h5>
                            <p>{{ $comment->body }}</p>

                            <div class="comment-reply-container">
                                <button class="toggle-comment-reply btn btn-primary float-right">Reply</button>

                                <div class="comment-reply col-sm-10">
                                    <!--  nested comment form  -->
                                    <form action="{{ route('replies.createReply') }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <input type="hidden" name="comment_id" value={{ $post->id }}>

                                        <div class="form-group">
                                            <textarea
                                            id="body"
                                            class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
                                            rows="1"
                                            name="body"
                                            ></textarea>

                                            @foreach($errors->get('body') as $message)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @endforeach
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>

                                </div>
                            </div>
                            <hr>

                            <!-- Comment with nested comments -->
                            @if (count($comment->replies) > 0)

                                @foreach ($comment->replies as $reply)

                                    @if ($reply->is_active === 1)

                                        <div class="media mt-2">
                                            <img class="d-flex mr-3 rounded-circle" height="50" src="{{ $reply->photo }}" alt="">
                                            <div class="media-body">
                                                <h5 class="mt-0">{{ $reply->author }}
                                                    <small class="text-secondary">{{ $reply->created_at->diffForHumans() }}</small>
                                                </h5>
                                                {{ $reply->body }}
                                            </div>

                                        </div>
                                        <hr>

                                        <div class="reply-container">
                                            <button class="toggle-reply btn btn-primary float-right">Reply</button>

                                            <div class="reply col-sm-10">
                                                <!--  nested comment form  -->
                                                <form action="{{ route('replies.createReply') }}" method="POST">
                                                    @csrf
                                                    @method('POST')

                                                    <input type="hidden" name="comment_id" value={{ $post->id }}>

                                                    <div class="form-group">
                                                        <textarea
                                                        id="body"
                                                        class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
                                                        rows="1"
                                                        name="body"
                                                        ></textarea>

                                                        @foreach($errors->get('body') as $message)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @endforeach
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>

                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    @endsection

    @section('scripts')
        <script>
            $(".reply-container .toggle-reply").click(function() {
                $(this).next().slideToggle("slow");
            });
        </script>
        <script>
            $(".comment-reply-container .toggle-comment-reply").click(function() {
                $(this).next().slideToggle("slow");
            });
        </script>
    @endsection

</x-home-master>
