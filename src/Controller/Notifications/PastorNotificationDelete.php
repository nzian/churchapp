<?php

declare(strict_types=1);

namespace App\Controller\Notifications;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use stdClass;

final class PastorNotificationDelete extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        // normally notification delete by id but when its request from pastor then need to check where its created by that pastor
        $message = 'Pastor does not own this notifications. ask administrator';
        $code = 999;
        if($this->getNotificationsService()->checkPastorOwnNotification((int)$args['pastor_id'], (int)$args['id'])) {
            $this->getNotificationsService()->delete((int) $args['id']);
            // at same time all the message in user notifications also deleted.
            $this->getUserNotificationService()->deleteByNotificationId((int)$args['id']);
            $message = 'Notification id ' . $args['id'] . ' is deleted successfully';
            $code = 0;
        }


        return $response->withJson($this->updateDataBeforeSendToResponse([], $code, $message), StatusCodeInterface::STATUS_OK);
    }
}
