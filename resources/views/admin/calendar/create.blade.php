<x-admin-master>
    @section('content')

        <h1>Create Event</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('calendar.store') }}" method='POST'>
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text"
                            name="name"
                            id="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                >
                <br>
                <label for="description">Description</label>
                <br>
                <textarea name="description" id="discription" cols="30" rows="4"></textarea>
                <br>
                <label for="meeting_time">Set Time</label>
                <br>
                <input type="date" name="meeting_date">
                <input type="time" name="meeting_time">
                <br>
                <br>
            </div>
            <button type="submit" class="btn btn-primary">Create Appointment</button>

        </form>
    @endsection
</x-admin-master>
