<x-admin-master>
    @section('content')

        <h1>Name category: {{ $category->name }}</h1>

        @if(session('categories-delete-succes'))

            <div class="alert alert-warning">
                {{ session('categories-delete-succes') }}
            </div>

        @elseif(session('categories-delete-fails'))

            <div class="alert alert-danger">
                {{ session('categories-delete-fails') }}
            </div>

        @endif

            <div class="col-sm-3">

                <form method="POST" action="{{ route('categories.update', compact('category')) }}">
                    <label for="category"></label>
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <input type="text"
                            name="name"
                            id="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                            value="{{ $category->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update name</button>
                </form>
        </div>

    @endsection

</x-admin-master>
