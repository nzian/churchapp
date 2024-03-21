<?php

declare(strict_types=1);

namespace App\Controller\City;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;

final class Delete extends Base
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
        $this->getCityService()->delete((int) $args['id']);

        return $response->withJson($this->updateDataBeforeSendToResponse([], 0, "City id " . $args['id'] . ' is deleted successfully'), StatusCodeInterface::STATUS_NO_CONTENT);
    }
}
