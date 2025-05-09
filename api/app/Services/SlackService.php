<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
use JoliCode\Slack\Api\Model\ObjsUser;
use JoliCode\Slack\Client;
use JoliCode\Slack\ClientFactory;
use Throwable;

readonly class SlackService
{
    private Client $client;

    public function __construct()
    {
        $this->client = ClientFactory::create(config('services.slack.notifications.bot_user_oauth_token'));
    }

    public function getUserByEmail(string $email): ?ObjsUser
    {
        try {
            return $this->client->usersLookupByEmail(['email' => $email])?->getUser();
        } catch (Throwable) {
            return null;
        }
    }

    public function getNotifiableUsers(): Collection
    {
        return User::query()
            ->whereNotNull('slack_id')
            ->get();
    }

    public function send(User $user, Notification $notification): void
    {
        if (!$user->slack_id) {
            return;
        }

        $user->notify($notification);
    }
}
