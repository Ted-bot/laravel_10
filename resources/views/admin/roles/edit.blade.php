<x-admin-master>
    @section('content')

        <h1>Edit Role</h1>

        @if(session('role-updated'))

            <div class="alert alert-success">
                {{ session('role-updated') }}
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

        <form method="POST" action="{{ route('role.update', $role->id) }}">
            <label for="role"></label>
            @csrf
            @method('PUT')

            <div class="form-group">
                <input type="text"
                    name="name"
                    id="name"
                    class="form-control {{ $errors->has('username') ? 'is-invalid' : ''}}"
                    value="{{ $role->name }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <div class="row">
            <div class="col-lg-12">

                @if ($permissions->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Attach</th>
                                            <th>Detach</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Options</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Attach</th>
                                            <th>Detach</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                            @foreach ($permissions as $permission)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox"
                                                            @foreach($role->permissions as $role_permission)
                                                                @if($role_permission->slug == $permission->slug)
                                                                    checked
                                                                @endif
                                                            @endforeach
                                                        >
                                                    </td>
                                                    <td>{{ $permission->id }}</td>
                                                    <td>{{ $permission->name }}</td>
                                                    <td>{{ $permission->slug }}</td>
                                                    <td>
                                                        <form method="POST" action="{{ route('role.permission.attach', $role) }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <input type="hidden" name="permission" value="{{ $permission->id }}">
                                                            <button
                                                                type="submit"
                                                                class="btn btn-primary"
                                                                @if ($role->permissions->contains($permission))
                                                                disabled
                                                                @endif
                                                                >
                                                                Attach
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="{{ route('role.permission.detach', $role) }}">
                                                            @csrf
                                                            @method('PUT')
                                                        <input type="hidden" name="permission" value="{{ $permission->id }}">

                                                        <button type="submit"
                                                                class="btn btn-danger"

                                                                @if(!$role->permissions->contains($permission))
                                                                    disabled
                                                                @endif
                                                                >
                                                                Detach
                                                        </button>
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


            </div>
        </div>


    @endsection
</x-admin-master>
