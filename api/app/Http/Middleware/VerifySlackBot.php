<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifySlackBot
{
    public function handle(Request $request, Closure $next): Response
    {
        $timestamp = $request->header('X-Slack-Request-Timestamp');
        $slackSignature = $request->header('X-Slack-Signature');

        if (abs(time() - $timestamp) > 60 * 5) {
            return response('Request too old.', 403);
        }

        $sigBaseString = "v0:$timestamp:" . $request->getContent();
        $mySignature = 'v0=' . hash_hmac('sha256', $sigBaseString, env('SLACK_SIGNING_SECRET'));

        if (!hash_equals($mySignature, $slackSignature)) {
            return response('Invalid signature.', 403);
        }

        return $next($request);
    }
}
