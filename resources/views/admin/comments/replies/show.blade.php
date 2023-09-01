<x-admin-master>
    @section('content')

     @if(session()->has('message-post-deleted'))
           <div class="alert alert-danger" role="alert">{{ session()->get('message-post-deleted') }}</div>
    @endif

        @if ($replies->isEmpty())
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">No replies</h6>
            </div>
        </div>
        @else
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Replies</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th>Body</th>
                                    <th>Created At</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($replies as $reply)

                                    <tr>
                                        <td>{{ $reply->id }}</td>
                                        <td>{{ $reply->author }}</td>
                                        <td>{{ $reply->email }}</td>
                                        <td>{{ $reply->body }}</td>
                                        <td>{{ $reply->created_at->diffForHumans() }}</td>
                                        <td><a href="{{ route('post.show', $reply->comment->post->id) }}">View Post</a></td>
                                        <td>
                                            @if($reply->is_active == 1)

                                                <form action="{{ route('replies.update', $reply->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                    <input type="hidden" name="is_active" value="0">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-warning">Unapprove</button>
                                                        </div>
                                                </form>

                                            @else

                                                <form action="{{ route('replies.update', $reply->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                        <input type="hidden" name="is_active" value="1">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Approve</button>
                                                            </div>
                                                    </form>

                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('replies.destroy', $reply->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                </form>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    @endsection

</x-admin-master>
