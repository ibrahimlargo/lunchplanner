<?php

namespace App\Http\Controllers;

use App\ActionHandlers\ActionPluginManager;
use Illuminate\Http\Request;
use JsonException;

class SlackActionsController extends Controller
{
    public function __construct(private ActionPluginManager $actionPluginManager) {}

    public function __invoke(Request $request)
    {
        $rawPayload = $request->input('payload');

        if (!$rawPayload) {
            abort(400, 'No payload received');
        }

        try {
            $payload = json_decode($rawPayload, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            abort(400, 'Invalid JSON payload');
        }

        if ($payload['type'] !== 'block_actions') {
            abort(400, 'Invalid payload');
        }

        $splitPayload = explode(':', $payload['actions'][0]['value']);
        $actionType = $splitPayload[0];

        unset($splitPayload[0]);

        $this->actionPluginManager->getHandler($actionType)->handle(implode($splitPayload));
    }
}

