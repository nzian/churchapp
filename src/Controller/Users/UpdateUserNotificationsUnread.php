<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use stdClass;

final class UpdateUserNotificationsUnread extends Base
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
        $read = 0;
        $notification = $this->GetUserNotificationsService()->updateNotification($read, (int) $args['user_id'], (int) $args['notification_id']);
        return $response->withJson($this->updateDataBeforeSendToResponse($notification));
    }
}
