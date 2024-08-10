<?php

namespace App\Listeners;

use App\Events\ServiceBroken;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBrokenServiceNotification
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
    public function handle(ServiceBroken $event): void
    {
        // Send notification to the service owner
        $data = $event->data;
        $service = $event->service;
        // Telegram API Shit

    }
}
