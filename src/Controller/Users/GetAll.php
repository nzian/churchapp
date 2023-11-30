<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;

final class GetAll extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response): Response
    {
        $users = $this->getUsersService()->getAll();

        return $response->withJson($this->updateDataBeforeSendToResponse($users));
    }
}
