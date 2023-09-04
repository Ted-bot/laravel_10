@inject('carbon', 'Carbon\Carbon')
<x-admin-master>
    @section('content')

        <h1>Edit Event</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('calendar.update', $event->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text"
                            name="name"
                            id="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                            value="{{ $event->name }}"
                >
                <br>
                <label for="description">Description</label>
                <br>
                <textarea name="description" id="discription" cols="30" rows="4">{{ $event->description }}</textarea>
                <br>
                <label for="meeting_time">Set Time</label>
                <br>
                <input type="date" name="meeting_date" value="{{ $carbon->parse($event->start->dateTime)->toDateString() }}">
                <input type="time" name="meeting_time" value="{{ $carbon->parse($event->start->dateTime)->toTimeString() }}">
                <br>
                <br>
            </div>
            <button type="submit" class="btn btn-primary">Update Appointment</button>

        </form>
    @endsection
</x-admin-master>
