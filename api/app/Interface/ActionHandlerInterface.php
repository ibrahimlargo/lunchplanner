<?php

declare(strict_types=1);

namespace App\Interface;

interface ActionHandlerInterface
{
    public function handle(string $payloadWithoutAction): void;
}
