<?php

declare(strict_types=1);

namespace App\Controller\Pastors;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;

final class PastorByEmail extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $pastors = $this->getPastorsService()->getPastorByEmail($input);

        return $response->withJson($this->updateDataBeforeSendToResponse($pastors), StatusCodeInterface::STATUS_CREATED);
    }
}
