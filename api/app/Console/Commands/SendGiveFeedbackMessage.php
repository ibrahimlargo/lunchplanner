<?php

namespace App\Console\Commands;

use App\Notifications\GiveFeedbackNotification;
use App\Services\MenuService;
use App\Services\SlackService;
use Illuminate\Console\Command;

class SendGiveFeedbackMessage extends Command
{
    protected $signature = 'slack:send-give-feedback-message';
    protected $description = 'Send give Feedback Message via slack';

    public function handle(SlackService $slackService, MenuService $menuService): int
    {
        $menuOfTheDay = $menuService->getMenuOfTheDay();

        if (!$menuOfTheDay) {
            return self::SUCCESS;
        }

        $users = $slackService->getNotifiableUsers();

        $users->each(function ($user) use ($slackService, $menuService, $menuOfTheDay) {
            if (!$menuService->hasVoted($user, $menuOfTheDay)) {
                return;
            }

            $slackService->send($user, new GiveFeedbackNotification($menuOfTheDay));
        });

        return self::SUCCESS;
    }
}
