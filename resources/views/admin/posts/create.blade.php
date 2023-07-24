<x-admin-master>
    @section('content')

    <h1>Create Post</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('post.store') }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text"
                    name="title"
                    class="form-control"
                    placeholder="Enter ..">
        </div>
        <div class="form-group">
            <label for="file">Image</label>
            <input type="file"
                    name="post_image"
                    class="file"
                    id="post_image">
        </div>
        <div class="form-group">
            <label for="body">Text</label>
            <textarea type="text"
                    name="body"
                    class="form-control"
                    id="body"
                    cols="30"
                    rows="10">
            </textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @endsection
</x-admin-master>
