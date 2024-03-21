<?php

declare(strict_types=1);

namespace App\Controller\City;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;

final class Create extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $city = $this->getCityService()->create($input);

        return $response->withJson($this->updateDataBeforeSendToResponse($city), StatusCodeInterface::STATUS_CREATED);
    }
}
