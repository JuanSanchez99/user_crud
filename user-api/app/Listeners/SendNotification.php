<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\Admin;
use App\Mail\Customers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Handle the event.
     *
     * @param \App\Events\UserCreated $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Mail::send(new Customers($event->customer));
        Mail::send(new Admin());
    }
}
