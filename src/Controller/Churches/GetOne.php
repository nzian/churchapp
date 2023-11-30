<?php

declare(strict_types=1);

namespace App\Controller\Churches;

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
        $churches = $this->getChurchesService()->getOne((int) $args['id']);
        if($churches === null) {
            $churches = new stdClass();
            return $response->withJson($this->updateDataBeforeSendToResponse($churches, 404, "Church Not found in the system"));
        }

        return $response->withJson($this->updateDataBeforeSendToResponse($churches));
    }
}
