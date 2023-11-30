<?php

declare(strict_types=1);

namespace App\Controller\Pastors;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use stdClass;

final class GetOne extends Base
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
        $pastors = $this->getPastorsService()->getOne((int) $args['id']);
        if($pastors === null) {
            $pastors = new stdClass();
            return $response->withJson($this->updateDataBeforeSendToResponse($pastors, 404, "Pastor Not found in the system"));
        }
        return $response->withJson($this->updateDataBeforeSendToResponse($pastors));
    }
}
