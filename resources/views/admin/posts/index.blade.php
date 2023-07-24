<x-admin-master>
    @section('content')

        <h1>All Posts</h1>

        @if(session()->has('message-post-deleted'))
           <div class="alert alert-danger" role="alert">{{ session()->get('message-post-deleted') }}</div>
        @elseif (session()->has('message-post-created'))
           <div class="alert alert-success" role="alert">{{ session()->get('message-post-created') }}</div>
@elseif (session()->has('message-post-updated'))
           <div class="alert alert-success" role="alert">{{ session()->get('message-post-updated') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Owner</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Posted at</th>
                      <th>Updated at</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Owner</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Posted at</th>
                        <th>Updated at</th>
                        <th>Delete</th>
                    </tr>
                  </tfoot>

                  <tbody>

                    @foreach($posts as $post)

                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->user->{"name"} ?? '' }}</td>
                            <td><a href="{{ route('post.edit', $post->id) }}">{{ $post->title }}</a></td>
                            <td>
                                <img height="40px" width="60px" src="{{ $post->post_image }}" alt="">
                            </td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>{{ $post->updated_at->diffForHumans() }}</td>
                            <td>
                                @can('view', $post)

                                    <form method="POST" action="{{ route('post.destroy', $post->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

                                @endcan
                            </td>
                        <tr>

                    @endforeach
                  </tbody>

                </table>
              </div>
            </div>
          </div>

          {{-- {{ $posts->links(); }} --}}

    @endsection

    @section('scripts')

        <!-- Page level plugins -->
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
            {{-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> --}}

    @endsection
</x-admin-master>
