<?php

namespace App\Listeners;

use App\Events\DropPointEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DropPointEventListener
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
     * @param  DropPointEvent  $event
     * @return void
     */
    public function handle(DropPointEvent $event)
    {
        //
    }
}
