<?php

namespace App\Listeners;

use App\Events\NoteCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\NoteLog;

class CreatLogEntry
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NoteCreated  $event
     * @return void
     */
    public function handle(NoteCreated $event)
    {
        $author = $event->author;
        $log_entry = new NoteLog(); // NoteLog is the model created for our logs hence interacting with the table
        $log_entry->author = $author; // ->author here is the name of the column created for the notelog table, thus assigning the author from the event
        $log_entry->save();
    }
}
