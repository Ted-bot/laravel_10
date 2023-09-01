<x-home-master>

@section('content')

{{-- <h1>Home</h1>

<h1 class="my-4">Page Heading --}}
    <small>Secondary Text</small>
  </h1>

   <!-- Blog Post -->
  @foreach($posts as $post)

  <div class="card mb-4">
    <img class="card-img-top" src="{{ $post->post_image }}" alt="Card image cap">
    <div class="card-body">
      <h2 class="card-title">{{ $post->title }}</h2>
      <p class="card-text">{{ Str::limit($post->body, 50, '...') }}</p>
      <a href="{{ route('post', $post->id) }}" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
      Posted on {{ $post->created_at->diffForHumans() }}
      <a href="#">Start Bootstrap</a>
    </div>
  </div>

  @endforeach

  <!-- Pagination -->
  <div class="row">
    <div class="col-sm-6 col-sm-offset-5 pagination-wrapper">

        {{ $posts->links('vendor.pagination.custom') }}
    </div>
  </div>

@endsection

</x-home-master>
