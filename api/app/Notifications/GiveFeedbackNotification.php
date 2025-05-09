<?php

namespace App\Notifications;

use App\Models\Menu;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\SlackMessage;

class GiveFeedbackNotification extends Notification
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
            ->usingBlockKitTemplate(
                <<<JSON
{
	"blocks": [
		{
			"type": "section",
			"text": {
				"type": "mrkdwn",
				"text": "*Wie fandest du dein Essen heute?*"
			}
		},
		{
			"type": "actions",
			"elements": [
				{
					"type": "button",
					"text": {
						"type": "plain_text",
						"text": ":star:"
					},
					"value": "giveMenuFeedback:asfsdf"
				},
				{
					"type": "button",
					"text": {
						"type": "plain_text",
						"text": ":star::star:"
					},
					"value": "giveMenuFeedback:asfsdf"
				},
				{
					"type": "button",
					"text": {
						"type": "plain_text",
						"text": ":star::star::star:"
					},
					"value": "giveMenuFeedback:asfsdf"
				},
				{
					"type": "button",
					"text": {
						"type": "plain_text",
						"text": ":star::star::star::star:"
					},
					"value": "giveMenuFeedback:asfsdf"
				},
				{
					"type": "button",
					"text": {
						"type": "plain_text",
						"text": ":star::star::star::star::star:"
					},
					"value": "giveMenuFeedback:asfsdf"
				}
			]
		},
		{
			"type": "context",
			"elements": [
				{
					"type": "mrkdwn",
					"text": "Klick auf eine Option – deine Auswahl wird automatisch gespeichert."
				}
			]
		}
	]
}
JSON

            );
    }
}
