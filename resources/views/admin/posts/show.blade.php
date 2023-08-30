<x-home-master>
    @section('content')

    @if (session()->has('message-post-created'))
           <div class="alert alert-success" role="alert">{{ session()->get('message-post-created') }}</div>
     @endif

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
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" width="50" height="50" src="{{ $comment->photo }}" alt="">
                    <div class="media-body">

                        <h5 class="mt-0">{{ $comment->author }}</h5>
                        {{ $comment->body }}

                        <!-- Comment with nested comments -->
                            {{-- <div class="media mt-4">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">Commenter Name</h5>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                </div>
                            </div> --}}
                    </div>
                </div>
            @endforeach




        @endif
    @endsection

</x-home-master>
