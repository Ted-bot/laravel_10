<x-admin-master>
    @section('content')

    <h1>Edit Post</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('post.update', $post->id) }}"  method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text"
                    name="title"
                    class="form-control"
                    placeholder="Enter .."
                    value="{{ $post->title }}">
        </div>
        <div class="form-group">

            @if ($post->post_image)
                <img height="250em" src="{{ $post->post_image }}" alt="">
                <br>
            @endif

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
                    rows="10">{{ $post->body }}
            </textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @endsection
</x-admin-master>
