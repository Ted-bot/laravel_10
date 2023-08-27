<x-admin-master>
    @section('content')

        <h1>Categories</h1>

        @if(session('message-category-deleted'))

            <div class="alert alert-warning">
                {{ session('message-category-deleted') }}
            </div>
        @elseif (session('message-category-created'))

            <div class="alert alert-success">
                {{ session('message-category-created') }}
            </div>

        @endif

        <div class="row">

            <div class="col-sm-3">

                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror">

                        <div>
                            @error('name')
                                <span><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Create category</button>

                </form>

            </div>


            <div class="col-sm-9">

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">categories</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Created</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($categories as $category)

                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td><a href="{{ route('categories.edit', $category->id) }}">{{ $category->name }}</a></td>
                                        <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date' }}</td>
                                        <th>
                                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </th>
                                    </tr>

                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @endsection

</x-admin-master>
