<?php

namespace App\Console\Commands;

use App\Notifications\VoteMenuNotification;
use App\Services\MenuService;
use App\Services\SlackService;
use Illuminate\Console\Command;

class SendVoteMenuNotification extends Command
{
    protected $signature = 'slack:send-vote-menu-notification';
    protected $description = 'Send vote menu notification via slack';

    public function handle(SlackService $slackService, MenuService $menuService): int
    {
        $nextMenu = $menuService->getNextMenu();

        if (!$nextMenu) {
            return self::SUCCESS;
        }

        $users = $slackService->getNotifiableUsers();

        $users->each(function ($user) use ($slackService, $nextMenu) {
            $slackService->send($user, new VoteMenuNotification($nextMenu));
        });

        return self::SUCCESS;
    }
}
