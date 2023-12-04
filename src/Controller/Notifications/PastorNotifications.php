<?php

declare(strict_types=1);

namespace App\Controller\Notifications;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use stdClass;

final class PastorNotifications extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response, array $args): Response
    {

        $notifications = $this->getNotificationsService()->getNotificationByPastor((int) $args['id']);
        if($notifications === null) {
            $notifications = new stdClass();
            return $response->withJson($this->updateDataBeforeSendToResponse($notifications, 404, "Notification Not found in the system"));
        }
        return $response->withJson($this->updateDataBeforeSendToResponse($notifications));
    }
}
