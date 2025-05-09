<?php

namespace App\Console\Commands;

use App\Notifications\RememberUserToVoteNotification;
use App\Services\MenuService;
use App\Services\SlackService;
use Illuminate\Console\Command;

class RememberUserToVote extends Command
{
    protected $signature = 'slack:remember-user-to-vote';
    protected $description = 'Remember user to vote via slack';

    public function handle(SlackService $slackService, MenuService $menuService): int
    {
        $nextMenu = $menuService->getNextMenu();

        if (!$nextMenu) {
            return self::SUCCESS;
        }

        $users = $slackService->getNotifiableUsers();

        $users->each(function ($user) use ($slackService, $menuService, $nextMenu) {
            if ($menuService->hasVoted($user, $menuService->getNextMenu())) {
                return;
            }

            $slackService->send($user, new RememberUserToVoteNotification($nextMenu));
        });

        return self::SUCCESS;
    }
}
