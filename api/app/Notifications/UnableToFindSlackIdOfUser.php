<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class UnableToFindSlackIdOfUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private User $user,
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSlack($notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->content(
                "Fehler: Wir konnten die Slack ID nicht finden für den Benutzer {$this->user->name} ({$this->user->email}) nicht finden!",
            );
    }
}
