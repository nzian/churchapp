<?php

declare(strict_types=1);

namespace App\Controller\Notifications;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use App\Traits\ConfigData;
use App\Traits\PushNotification;
use Valitron\Validator;

final class Create extends Base
{
    use DataResponse, ConfigData, PushNotification;
    private $config = [];
    private $church_id = 1;
    public function __invoke(Request $request, Response $response): Response
    {
        $this->config = $this->getConfigData();
        $input = (array) $request->getParsedBody();

$validation = new Validator($input);
$validation->rule('required', ['title','description','created_by', 'church_id']);
if(!$validation->validate()) {
    return $response->withJson($this->updateDataBeforeSendToResponse($validation->errors(), 500, 'Validation error'), StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
}

        $notifications = $this->getNotificationsService()->create($input);

        $church_users_device_tokens = $this->getUsersService()->churchUserDeviceToken($this->church_id, '`device_token`');
        // after create you need to send notification to firebase messaging if push notification one
        if($this->config['pushnotification'] === 'on') {
            // get all church users and notification object

$tokens = [];
foreach ($church_users_device_tokens as $k => $v) {
    array_push($tokens, $v['device_token']);
}
$notifications->push_notification_report = $this->sendPushNotification($tokens, $notifications);



        }
        // then create user notification log in user_notification table broadcast on
        if($this->config['broadcastmessaging'] === 'on') {
            // as its bulk insert so we are prepare those data first then send to insert function
            $users_id = $this->getUsersService()->getChurchUserIds($this->church_id, '`id`');
            $insert_data = [];
            if(count($users_id) > 0) : 
                foreach($users_id as $user_id) {
                    $insert_data[] = [
                        'user_id' => $user_id['id'],
                        'church_id' => $this->church_id,
                        'notification_id' => $notifications->id,
                        'read' => 0,
                        'created_at' => date('Y-m-d h:i:s', time())
                    ];
                }

                $this->getUserNotificationService()->createUserNotifications($insert_data);
            endif;
        }

        return $response->withJson($this->updateDataBeforeSendToResponse($notifications), StatusCodeInterface::STATUS_CREATED);
    }
}