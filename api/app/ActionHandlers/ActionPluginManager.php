<?php

declare(strict_types=1);

namespace App\ActionHandlers;

use App\Interface\ActionHandlerInterface;

class ActionPluginManager
{
    private array $plugins;

    public function __construct()
    {
        $this->plugins = config('service.actionPlugins');

        foreach ($this->plugins as $action => $handler) {
            $this->plugins[$action] = new $handler;
        }
    }

    public function getHandler(string $action): ActionHandlerInterface
    {
        return new $this->plugins[$action];
    }
}
