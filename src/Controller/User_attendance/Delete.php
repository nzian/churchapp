<?php

declare(strict_types=1);

namespace App\Controller\User_attendance;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Delete extends Base
{
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $this->getUser_attendanceService()->delete((int) $args['id']);

        return $response->withJson('', StatusCodeInterface::STATUS_NO_CONTENT);
    }
}
