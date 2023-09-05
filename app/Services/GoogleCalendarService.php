<?php

namespace App\Services;

use Carbon\Carbon;

Class GoogleCalendarService
{

    public function parseMeeting(string $startDate, string $endDateTime)
    {
        return Carbon::parse($startDate. ' ' . $endDateTime, 'Europe/Amsterdam');
    }

}
