<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use stdClass;

final class GetUserByEmail extends Base
{
    use DataResponse;
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response
    ): Response {
        $input = (array) $request->getParsedBody();
        $users = $this->getUsersService()->GetUserByEmail($input);
        if($users === null) {
            $users = new stdClass();
            return $response->withJson($this->updateDataBeforeSendToResponse($users, 404, "User Not found in the system"));
        }
        return $response->withJson($this->updateDataBeforeSendToResponse($users));
    }
}
