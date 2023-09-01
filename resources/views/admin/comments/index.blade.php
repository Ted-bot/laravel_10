<x-admin-master>

    @section('content')
    <h1>Comments</h1>

    <table class="table">
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

            @foreach($comments as $comment)

            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->author }}</td>
                <td>{{ $comment->email }}</td>
                <td>{{ $comment->body }}</td>
                <td>{{ $comment->created_at->diffForHumans() }}</td>
                <td><a href="{{ route('post.show', $comment->post->id) }}">View Post</a></td>
                <td>
                    @if($comment->is_active == 1)

                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                            <input type="hidden" name="is_active" value="0">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning">Unapprove</button>
                                </div>
                        </form>

                    @else ()

                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
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
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
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

    @endsection

</x-admin-master>
