<x-admin-master>

    @section('content')

    <h1>All Users</h1>

    @if(session('user-delete-succes'))

        <div class="alert alert-success">
            {{ session('user-delete-succes') }}
        </div>

    @elseif(session('user-delete-fails'))

        <div class="alert alert-danger">
            {{ session('user-delete-fails') }}
        </div>

    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Registered date</th>
                            <th>Updated Profile date</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Registered date</th>
                            <th>Updated Profile date</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $user)

                        <tr>
                            <td>{{ $user->id }} </td>
                            <td>
                                <a href="{{ route('user.profile.show', $user->id) }}">
                                    {{ $user->username }}
                                </a>
                            </td>
                            <td>
                                <img height=60px src="{{ $user->avatar }}" alt="">
                            </td>
                            <td>{{ $user->name }} </td>
                            <td>{{ $user->created_at }} </td>
                            <td>{{ $user->updated_at->diffForHumans() }} </td>
                            <th>
                                <form method="POST" action="{{ route('user.destroy', $user->id) }}" enctype="multipart/form-data">
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

    @endsection

    @section('scripts')

        <!-- Page level plugins -->
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
            <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    @endsection

</x-admin-master>
