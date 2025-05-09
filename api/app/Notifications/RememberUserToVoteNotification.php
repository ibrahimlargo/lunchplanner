<?php

namespace App\Notifications;

use App\Models\Menu;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\SlackMessage;

class RememberUserToVoteNotification extends Notification
{
    public function __construct(
        private Menu $menu,
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->text("Du hast vergessen für den {$this->menu->date->translatedFormat('d\\t\\e\\n M')} abzustimmen!");
    }
}
