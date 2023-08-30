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
            </tr>

            @endforeach

        </tbody>
    </table>

    @endsection

</x-admin-master>
