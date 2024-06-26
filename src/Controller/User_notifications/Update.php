<?php

declare(strict_types=1);

namespace App\Controller\User_notifications;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use stdClass;

final class Update extends Base
{
    use DataResponse;
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $input = (array) $request->getParsedBody();
        $user_notifications = $this->getUser_notificationsService()->update($input, (int) $args['id']);
        if($user_notifications === null) {
            $user_notifications = new stdClass();
            return $response->withJson($this->updateDataBeforeSendToResponse($user_notifications, 404, "User Notification Not found in the system"));
        }
        return $response->withJson($this->updateDataBeforeSendToResponse($user_notifications));
    }
}
