<?php

declare(strict_types=1);

namespace App\Controller\User_information;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $user_informations = $this->getUser_informationService()->getAll();

        return $response->withJson($user_informations);
    }
}
