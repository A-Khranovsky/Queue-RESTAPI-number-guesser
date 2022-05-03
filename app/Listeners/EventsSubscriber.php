<?php

namespace App\Listeners;

use App\Events\FailedJobEvent;
use App\Events\SuccessJobEvent;
use App\Events\TryJobEvent;
use App\Models\Log;

class EventsSubscriber
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
     * @param  object  $event
     * @return void
     */
    public function handleSuccessJob($event)
    {
        Log::create([
            'transaction' => $event->transaction,
            'guessNumber' => $event->guessNumber,
            'randNumber' => $event->randNumber,
            'status' => 'OK'
        ]);
    }

    public function handleFailedJob($event)
    {
        Log::create([
            'transaction' => $event->transaction,
            'guessNumber' => $event->guessNumber,
            'randNumber' => $event->randNumber,
            'status' => $event->message
        ]);
    }

    public function handleTryJob($event)
    {
        Log::create([
            'transaction' => $event->transaction,
            'guessNumber' => $event->guessNumber,
            'randNumber' => $event->randNumber,
            'status' => 'Tried'
        ]);
    }

    public function subscribe($events)
    {
        $events->listen(
            SuccessJobEvent::class,
            [EventsSubscriber::class, 'handleSuccessJob']
        );

        $events->listen(
            FailedJobEvent::class,
            [EventsSubscriber::class, 'handleFailedJob']
        );

        $events->listen(
            TryJobEvent::class,
            [EventsSubscriber::class, 'handleTryJob']
        );
    }
}
