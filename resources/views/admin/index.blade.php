@inject('carbon','Carbon\Carbon')
<x-admin-master>

    @section('content')

        @if(auth()->user()->userHasRole('Admin'))

        @if(session()->has('message-delete-event'))
            <div class="alert alert-danger" role="alert">{{ session()->get('message-delete-event') }}</div>
        @endif

        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        <hr>
        <h2>Upcoming Planned Events</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Time</th>
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
                    </tr>
                </tbody>
                @endif
            @endforeach
        </table>
        <br>
        <hr>

        @endif

    @endsection

</x-admin-master>
