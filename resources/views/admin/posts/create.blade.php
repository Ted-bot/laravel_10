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
                    class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}"
                    placeholder="Enter ..">

                    @foreach($errors->get('title') as $message)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @endforeach
        </div>
        <div class="form-group">
            <label for="file">Image</label>
            <input type="file"
                    name="post_image"
                    class="file {{ $errors->has('post_image') ? 'is-invalid' : ''}}"
                    id="post_image">

                    @foreach($errors->get('post_image') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @endforeach
        </div>

        <div class="form-group">
            <label for="category_id">Choose Category:</label><br>
            <select name="category_id" id="category_id">
                <option value="">None</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="body">Text</label>
            <textarea type="text"
                    name="body"
                    class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
                    id="body"
                    cols="30"
                    rows="10">
            </textarea>

            @foreach($errors->get('body') as $message)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @endforeach
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @endsection
</x-admin-master>
