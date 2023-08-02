<x-admin-master>
    @section('content')

        <h1>Roles</h1>

        @if(session('role-delete-succes'))

            <div class="alert alert-warning">
                {{ session('role-delete-succes') }}
            </div>

        @elseif(session('role-delete-fails'))

            <div class="alert alert-danger">
                {{ session('role-delete-fails') }}
            </div>

        @endif

        <div class="row">

            <div class="col-sm-3">

                <form method="POST" action="{{ route('role.store') }}">
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

                    <button class="btn btn-primary" type="submit">Create Role</button>

                </form>

            </div>


            <div class="col-sm-9">

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    @foreach ($roles as $role)

                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td><a href="{{ route('role.edit', $role->id) }}">{{ $role->name }}</a></td>
                                        <td>{{ $role->slug }}</td>
                                        <th>
                                            <form method="POST" action="{{ route('role.destroy', $role->id) }}">
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
