<?php

namespace App\Notifications;

use App\Models\Menu;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\SlackMessage;

class VoteMenuNotification extends Notification
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
        $finalMessage = json_decode(
            <<<JSON
                {
                	"blocks": [
                		{
                			"type": "section",
                			"text": {
                				"type": "mrkdwn",
                                "text": "*Was willst du am {$this->menu->date->translatedFormat('l, \\d\\e\\n d. M')} essen?*"
                			}
                		},
                		{
                			"type": "actions",
                			"elements": []
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
                JSON,
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        $menu = $this->menu;
        $menu->dishes->each(function ($dish) use (&$finalMessage, $menu) {
            $finalMessage['blocks'][1]['elements'][] = [
                'type' => 'button',
                'text' => [
                    'type' => 'plain_text',
                    'text' => ":{$dish->slack_icon}:" . $dish->name,
                    'emoji' => true,
                ],
                'value' => "giveMenuVote:$menu->id:$dish->id",
            ];
        });

        return (new SlackMessage)
            ->usingBlockKitTemplate(json_encode($finalMessage, JSON_THROW_ON_ERROR));
    }
}
