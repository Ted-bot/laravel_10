<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class GoogleCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.calendar.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validat([
            'name' => 'required|min:2',
            'description' => 'nullable',
            'startDateTime' => 'required',
            'endDateTime' => 'required'
        ]);

        $startTime = Carbon::parse($request->input('meeting_date'). ' ' . $request->input('meeting_time'));
        $endTime = (clone $startTime)->addhour();

        $event = new Event();

        $event->name = 'A new event';
        $event->description = 'Event description';
        $event->startDateTime = $startTime;
        $event->endDateTime = $endTime;

        $event->save();

        session()->flash('message-post-calendar', "A new appointment has been created on");

        return back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
