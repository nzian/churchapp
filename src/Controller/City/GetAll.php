<?php

declare(strict_types=1);

namespace App\Controller\City;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;

final class GetAll extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response): Response
    {
        $citys = $this->getCityService()->getAll();

        return $response->withJson($this->updateDataBeforeSendToResponse($citys));
    }
}
