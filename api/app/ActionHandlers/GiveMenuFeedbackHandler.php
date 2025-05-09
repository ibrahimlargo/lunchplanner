<?php

declare(strict_types=1);

namespace App\ActionHandlers;

use App\Interface\ActionHandlerInterface;

class GiveMenuFeedbackHandler implements ActionHandlerInterface
{
    public function handle(string $payloadWithoutAction): void
    {
        logger('MenuFeedbackHandler');
    }
}
