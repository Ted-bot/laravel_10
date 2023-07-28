<x-admin-master>

    @section('content')

    <h1>{{ $user->name }} User Profile</h1>

    @if(session()->has('profile-updated'))
           <div class="alert alert-success" role="alert">{{ session()->get('profile-updated') }}</div>
    @endif

    @if(session('user-attach-succes'))

        <div class="alert alert-success">
            {{ session('user-attach-succes') }}
        </div>

    @elseif(session('user-attach-failure'))

        <div class="alert alert-danger">
            {{ session('user-attach-failure') }}
        </div>

    @endif

    @if(session('user-detach-succes'))

        <div class="alert alert-warning">
            {{ session('user-detach-succes') }}
        </div>

    @elseif(session('user-detach-failure'))

        <div class="alert alert-danger">
            {{ session('user-detach-failure') }}
        </div>

    @endif

    <div class="row">
        <div class="col-sm-6">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form   action="{{ route('user.profile.update', $user) }}"
                    method="POST"
                    enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <img    height=80px
                            class="img-profile rounded-circle"
                            src="{{ Str::after($user->avatar, 'localhost/') ? $user->avatar : 'https://source.unsplash.com/QAB-WJcbgJk/60x60' }}">
                </div>

                <div class="form-group">
                    <input type="file" name="avatar">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input  type="text"
                            class="form-control {{ $errors->has('username') ? 'is-invalid' : ''}}"
                            name="username"
                            id="username"
                            value="{{ $user->username }}"
                    >
                    @foreach($errors->get('username') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input  type="text"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                            name="name"
                            id="name"
                            value="{{ $user->name }}"
                    >
                    @foreach($errors->get('name') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input  type="text"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}"
                            name="email"
                            id="email"
                            value={{ $user->email }}
                    >
                    @foreach($errors->get('email') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input  type="password"
                            class="form-control"
                            name="password {{ $errors->has('password') ? 'is-invalid' : ''}}"
                            id="password"
                    >
                    @foreach($errors->get('password') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="password-confirmation">Confirm Password</label>
                    <input  type="password"
                            class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : ''}}"
                            name="password_confirmation"
                            id="password-confirmation"
                    >
                    @foreach($errors->get('password_confirmation') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <br><hr>

    <div class="row">
        <div class="col-sm-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
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
                                @foreach($roles as $role)

                                <tr>
                                    <td>
                                        <input type="checkbox"
                                            @foreach ($user->roles as $user_role)
                                                @if ($user_role->slug == $role->slug)
                                                    checked
                                                @endif
                                            @endforeach
                                        >
                                    </td>
                                    <td>{{ $role->id }} </td>
                                    <td>{{ $role->name }} </td>
                                    <td>{{ $role->slug }} </td>
                                    <td>
                                        <form method="POST" action="{{ route('user.role.attach', $user) }}">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="role" value="{{ $role->id }}">
                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                                @if ($user->roles->contains($role))
                                                disabled
                                                @endif
                                                >
                                                Attach
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('user.role.detach', $user) }}">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="role" value="{{ $role->id }}">
                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                                @if (!$user->roles->contains($role))
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

        </div>
    </div>

    @endsection

</x-admin-master>
