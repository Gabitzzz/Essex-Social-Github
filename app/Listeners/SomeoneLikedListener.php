<?php

namespace App\Listeners;

use App\Events\SomeoneLikedEvent;
use App\Notifications\SomeoneLiked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SomeoneLikedListener
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
     * @param SomeoneLikedEvent $event
     * @return void
     */
    public function handle(SomeoneLikedEvent $event)
    {
        $event->user->notify(new SomeoneLiked(auth()->user()));

    }
}
