<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;

final class GetUserNotifications extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        // send user id and from service notifications
        $notifications = $this->GetUserNotificationsService()->getUserNotificationsByUserId((int)$args['id']);

        return $response->withJson($this->updateDataBeforeSendToResponse($notifications));
    }
}
