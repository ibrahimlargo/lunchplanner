<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeUser implements ShouldQueue
{
    public function handle(Registered $event): void
    {
        if (!$event->user->slack_id) {
            return;
        }

        $event->user->notify(new \App\Notifications\WelcomeUser($event->user));
    }
}
