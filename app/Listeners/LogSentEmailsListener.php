<?php

namespace App\Listeners;

use App\Events\LogSentEmails;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogSentEmailsListener
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
     * @param  LogSentEmail  $event
     * @return void
     */
    public function handle(LogSentEmails $event)
    {

        if ($event->person->status) {
            $status = 'sent';
        } else {
            $status = 'failed';
        }

        Log::info('Sent Email', [
            'to' => $event->person->email,
            'subject' => $event->person->name,
            'content' => $event->person->content,
            'status' => $event->person->status
        ]);

        DB::table('emails_log')->insert([
            'to' => $event->person->email,
            'name' => $event->person->name,
            'content' => $event->person->message,
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
