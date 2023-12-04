<?php

declare(strict_types=1);

namespace App\Controller\Notifications;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use App\Traits\ConfigData;
use App\Traits\PushNotification;

final class Create extends Base
{
    use DataResponse, ConfigData, PushNotification;
    private $config = [];
    private $church_id = 1;
    public function __construct()
    {
        $this->config = $this->getConfigData();
    }
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $notifications = $this->getNotificationsService()->create($input);

        $church_users_device_tokens = $this->getUsersService()->churchUserDeviceToken($this->church_id, '`device_token`');
        // after create you need to send notification to firebase messaging if push notification one
        if($this->config->pushnotification === 'on') {
            // get all church users and notification object
            $this->sendPushNotification($church_users_device_tokens, $notifications);
        }
        // then create user notification log in user_notification table broadcast on
        if($this->config->broadcastmessaging === 'on') {
            // as its bulk insert so we are prepare those data first then send to insert function
            $users_id = $this->getUsersService()->getChurchUserIds($this->church_id, '`id`');
            $insert_data = [];
            foreach($users_id as $id) {
                $insert_data[] = [
                    'user_id' => $id,
                    'church_id' => $this->church_id,
                    'notification_id' => $notifications->id,
                    'read' => 0,
                    'created_at' => date('Y-m-d h:i:s', time())
                ];
            }
            $this->getUserNotificationService()->createUserNotifications($insert_data);
        }

        return $response->withJson($this->updateDataBeforeSendToResponse($notifications), StatusCodeInterface::STATUS_CREATED);
    }
}