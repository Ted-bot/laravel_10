<x-admin-master>

    @section('content')

    <h1>{{ $user->name }} User Profile</h1>

    @if(session()->has('message-post-deleted'))
           <div class="alert alert-success" role="alert">{{ session()->get('profile-updated') }}</div>
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

            <form action="{{ route('user.profile.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <img height=80px class="img-profile rounded-circle" src="{{ $user->avatar === true ? $user->avatar : 'https://source.unsplash.com/QAB-WJcbgJk/60x60' }}">
                </div>

                <div class="form-group">
                    <input type="file" name="avatar">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input  type="text"
                            class="form-control"
                            name="username"
                            id="username"
                            value="{{ $user->username }}"
                    >
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input  type="text"
                            class="form-control"
                            name="name"
                            id="name"
                            value="{{ $user->name }}"
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input  type="text"
                            class="form-control"
                            name="email"
                            id="email"
                            value={{ $user->email }}
                    >
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input  type="password"
                            class="form-control"
                            name="password"
                            id="password"
                            {{-- value={{ $user->password }} --}}
                    >
                </div>

                <div class="form-group">
                    <label for="password-confirmation">Confirm Password</label>
                    <input  type="password"
                            class="form-control"
                            name="password_confirmation"
                            id="password-confirmation"
                            {{-- value={{ $user->password }} --}}
                    >
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    @endsection

</x-admin-master>
