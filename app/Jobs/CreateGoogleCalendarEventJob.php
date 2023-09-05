<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Facades\Log;

class CreateGoogleCalendarEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $event = new Event();

        $event->name = $this->data['name'];
        $event->description = $this->data['description'];
        $event->startDateTime = $this->data['startDateTime'];
        $event->endDateTime = $this->data['endDateTime'];

        $event->save();
    }

    public function failed($e)
    {
        Log::info('Failed GoogleCalendarJob');
    }
}
