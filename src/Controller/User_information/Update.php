<?php

declare(strict_types=1);

namespace App\Controller\User_information;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;

final class Update extends Base
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
        $input = (array) $request->getParsedBody();
        $user_information = $this->getUser_informationService()->update($input, (int) $args['id']);

        return $response->withJson($this->updateDataBeforeSendToResponse($user_information));
    }
}
