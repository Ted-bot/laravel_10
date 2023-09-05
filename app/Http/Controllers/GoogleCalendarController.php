<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GoogleCalendarCreateEventRequest;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use App\Jobs\CreateGoogleCalendarEventJob;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Services\GoogleCalendarService;

class GoogleCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::get();

        return view('admin.calendar.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GoogleCalendarCreateEventRequest $request)
    {
        $startTime = (new GoogleCalendarService)->parseMeeting($request->input('meeting_date'),$request->input('meeting_time') );

        $endTime = (clone $startTime)->addhour();

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'startDateTime' => $startTime,
            'endDateTime' => $endTime,
        ];

        dispatch(new CreateGoogleCalendarEventJob($data));

        session()->flash('message-post-calendar', "A new appointment has been created on");

        return redirect()->route('calendar.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::find($id);
        return view('admin.calendar.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'nullable',
            'meeting_date' => 'required',
            'meeting_time' => 'required'
        ]);

        $startTime = Carbon::parse($request->input('meeting_date'). ' ' . $request->input('meeting_time'), 'Europe/Amsterdam');

        $endTime = (clone $startTime)->addhour();

        $event = Event::find($id);

        $event->name = $request->name;
        $event->description = $request->description;
        $event->startDateTime = $startTime;
        $event->endDateTime = $endTime;

        $event->save();

        session()->flash('message-post-calendar', "A appointment has been updated");

        return redirect()->route('calendar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::find($id)->delete();

        session()->flash('message-delete-event', "Event has been deleted");

        return back();
    }
}
