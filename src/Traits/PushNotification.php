<?php

declare(strict_types=1);

namespace App\Traits;

use App\Service\FireBaseMessagingService;

use Kreait\Firebase\Messaging\CloudMessage;

trait PushNotification
{
    public function sendPushNotification(array $user_tokens, object $notification): mixed
    {
        $firebase = new FireBaseMessagingService();
        $messaging = $firebase->getFirebaseInstance()->createMessaging();
        $message = CloudMessage::fromArray([
            'notification' => [
                'title' => $notification->title,
                'body' => $notification->description,
            ]
        ])->withDefaultSounds(); // Any instance of Kreait\Messaging\Message
        $report = $messaging->sendMulticast($message, $user_tokens);
        $success_message = 'Successful sends: '.$report->successes()->count();
        $fail_message = 'Failed sends: '.$report->failures()->count();

        if ($report->hasFailures()) {
            foreach ($report->failures()->getItems() as $failure) {
                $error[] = $failure->error()->getMessage().PHP_EOL;
            }
        }

        // The following methods return arrays with registration token strings
        $successfulTargets = $report->validTokens(); // string[]

        // Unknown tokens are tokens that are valid but not know to the currently
        // used Firebase project. This can, for example, happen when you are
        // sending from a project on a staging environment to tokens in a
        // production environment
        $unknownTargets = $report->unknownTokens(); // string[]

        // Invalid (=malformed) tokens
        $invalidTargets = $report->invalidTokens(); // string[]

        return [
            'success' => $success_message,
            'failed' => $fail_message,
            'error' => $error,
            'successful_targets' => $successfulTargets,
            'unknown_targets' => $unknownTargets,
            'invalid_targets' => $invalidTargets
        ];

    }
}