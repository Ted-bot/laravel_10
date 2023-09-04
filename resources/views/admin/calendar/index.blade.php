<x-admin-master>
    @section('content')

        <form action="route('calendar.store')" method='POST'>
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
        <hr>
        <br>


        <iframe src="https://calendar.google.com/calendar/embed?src=33168eb407dda1a92b661d4b50e9bae4f93e356f668d769a05f3d030a84edd2e%40group.calendar.google.com&ctz=Europe%2FAmsterdam" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    @endsection
</x-admin-master>
