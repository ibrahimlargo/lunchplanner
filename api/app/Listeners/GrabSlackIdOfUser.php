<?php

namespace App\Listeners;

use App\Notifications\UnableToFindSlackIdOfUser;
use App\Services\SlackService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

class GrabSlackIdOfUser
{
    public function __construct(
        private SlackService $slackService,
    ) {}

    public function handle(Registered $event): void
    {
        $user = $event->user;
        $slack_user = $this->slackService->getUserByEmail($user->email);

        if (!$slack_user) {
            Notification::route('slack', config('services.slack.notifications.channel_webhook'))->notify(new UnableToFindSlackIdOfUser($user));
            return;
        }

        $user->slack_id = $slack_user->getId();
        $user->save();
    }
}
