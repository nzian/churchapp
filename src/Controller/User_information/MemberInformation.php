<?php

declare(strict_types=1);

namespace App\Controller\User_information;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;

final class MemberInformation extends Base
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
        $user_information = $this->getUser_informationService()->getMemberByUserId((int) $args['user_id']);
        
        return $response->withJson($this->updateDataBeforeSendToResponse($user_information));

    }
}
