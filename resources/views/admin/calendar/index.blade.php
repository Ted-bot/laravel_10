@inject('carbon', 'Carbon\Carbon')
<x-admin-master>
    @section('content')

        @if(session()->has('message-post-calendar'))
            <div class="alert alert-success" role="alert">{{ session()->get('message-post-calendar') }}</div>
        @endif

        <h1>Upcoming Planned Events</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Description</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            @foreach($events as $event)
            @if($event->startDateTime == $carbon->now() || $event->endDateTime > $carbon->now())
            <tbody>
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->startDateTime }}</td>
                    <td>{{ $event->endDateTime }}</td>
                    <td>
                        <form action="{{ route('calendar.edit', $event->id) }}">
                            <input type="submit" class="btn btn-warning" value="Edit">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('calendar.destroy', $event->id) }}">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <hr>
        <a href="{{ route('calendar.create') }}">
            <button type="button" class="btn btn-primary btn-lg btn-block">Add new Event</button>
        </a>
        <br>

        <h2>Calendar</h2>
        <iframe src="https://calendar.google.com/calendar/embed?src=33168eb407dda1a92b661d4b50e9bae4f93e356f668d769a05f3d030a84edd2e%40group.calendar.google.com&ctz=Europe%2FAmsterdam" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    @endsection
</x-admin-master>
