<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use App\Service\NotificationsService;
use App\Service\ChurchesService;
use App\Service\User_notificationsService;
use App\Service\UsersService;
use Pimple\Psr11\Container;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\ConfigData;
use App\Traits\DataResponse;
use App\Traits\PushNotification;
use stdClass;

final class Home
{
    use ConfigData;
    use DataResponse;
    use PushNotification;
    private const API_NAME = 'slim4-api-skeleton';

    private const API_VERSION = '0.41.0';
    private $church_id = 1;

    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getChurchesService(): ChurchesService
    {
        return $this->container->get('churches_service');
    }

    protected function getNotificationsService(): NotificationsService {
        return $this->container->get('notifications_service');
    }

    protected function getUsersService(): UsersService {
        return $this->container->get('users_service');
    }

    protected function getUserNotificationsService(): User_notificationsService {
        return $this->container->get('user_notifications_service');
    }

    public function getJsonData(Request $request, Response $response): Response {

        return $response->withJson($this->getConfigData());
    }

    public function getCfc2JsonData(Request $request, Response $response): Response {

        return $response->withJson($this->getCfc1ConfigData());
    }

    public function getCfc3JsonData(Request $request, Response $response): Response {

        return $response->withJson($this->getCfc2ConfigData());
    }

    public function getHelp(Request $request, Response $response): Response
    {
        $message = [
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $response->withJson($message);
    }

    public function getStatus(Request $request, Response $response): Response
    {
        $this->container->get('db');
        $status = [
            'status' => [
                'database' => 'OK',
            ],
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $response->withJson($status);
    }

    public function removeOldNotification(Request $request, Response $response) : Response {
        // fine the settings how many days older message should be deleted.

        $church = $this->getChurchesService()->getOne(1);
        $older_date = date('Y-m-d h:i:s',strtotime('today - ' .$church->notification_delete_cycle .  ' days'));
        // then update those notification and user notification table entry updated with deleted_at
        $this->getNotificationsService()->deleteByDate($older_date);
        $this->getUserNotificationsService()->deleteByDate($older_date);

        return $response->withJson($this->updateDataBeforeSendToResponse([]));
    }

    function testPushNotification(Request $request, Response $response): Response {
        $church_users_device_tokens = $this->getUsersService()->churchUserDeviceToken($this->church_id, '`device_token`');
        $tokens = [];
        foreach ($church_users_device_tokens as $k => $v){
            array_push($tokens, $v['device_token']);
        }
        $notification = new stdClass();
        $notification->title = "Notification from script";
        $notification->description = "This is new app notification system. We are sending notification from script. We will send it automatically";
        // get all church users and notification object
        $result = $this->sendPushNotification($tokens, $notification);
        return $response->withJson($result);
        
    }

    public function getAllQrCodes(Request $request, Response $response): Response {
        $configs = $this->getConfigData();

        if(array_key_exists('qrcode', $configs)) {
            return $response->withJson($this->updateDataBeforeSendToResponse($configs['qrcode']));
        }
        return $response->withJson($this->updateDataBeforeSendToResponse([]));
    }




}