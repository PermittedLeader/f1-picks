<?php

namespace App\Listeners;

use App\Mail\WelcomeEmail;
use App\Models\League;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
       Mail::to($event->user)->send(new WelcomeEmail());
    }
}
