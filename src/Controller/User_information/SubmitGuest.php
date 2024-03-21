<?php

declare(strict_types=1);

namespace App\Controller\User_information;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;

final class SubmitGuest extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $guest_information = $this->getUser_informationService()->submitGuest($input);

        return $response->withJson($this->updateDataBeforeSendToResponse($guest_information), StatusCodeInterface::STATUS_CREATED);
    }
}
