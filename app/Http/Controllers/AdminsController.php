<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class AdminsController extends Controller
{
    public function index()
    {
        $events = Event::get();

        return view('admin.index', compact('events'));
    }

}
