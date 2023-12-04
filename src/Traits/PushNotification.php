<?php

declare(strict_types=1);

namespace App\Traits;

trait PushNotification
{
    public function sendPushNotification(array $user_tokens, object $notification): void
    {
        $client = new \Fcm\FcmClient(getenv('FCM_API_KEY'), getenv('FCM_SENDER_ID'));

        $fcm_notification = new \Fcm\Push\Notification();
        $fcm_notification
        //->addRecipient($deviceId1)
        //->addRecipient($deviceGroupID)
        ->addRecipient($user_tokens)
        ->setTitle($notification->title)
        ->setBody($notification->description)
        ->setColor('#20F037')
        ->setSound("default")
        ->setBadge(11);
        //->addData("key", "value");

        // Shortcut function:
        // $notification = $client->pushNotification('The title', 'The body', $deviceId);

        $response = $client->send($fcm_notification);

    }
}
