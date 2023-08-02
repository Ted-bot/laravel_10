<x-admin-master>
    @section('content')

        <h1>Edit permission</h1>

        @if(session('permission-updated'))

            <div class="alert alert-success">
                {{ session('permission-updated') }}
            </div>

        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
            <label for="permission"></label>
            @csrf
            @method('PUT')

            <div class="form-group">
                <input type="text"
                    name="name"
                    id="name"
                    class="form-control {{ $errors->has('username') ? 'is-invalid' : ''}}"
                    value="{{ $permission->name }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    @endsection
</x-admin-master>
