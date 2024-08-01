<?php

declare(strict_types=1);

namespace App\Controller\User_information;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use stdClass;

final class MemberSearch extends Base
{
    use DataResponse;
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
    ): Response {
        $input = (array) $request->getParsedBody();
        $user_information = $this->getUser_informationService()->searchMember($input);
        //var_dump($user_information);die();
        if($user_information) :
            return $response->withJson($this->updateDataBeforeSendToResponse($user_information));
        endif;

        $user_info = [];
        return $response->withJson($this->updateDataBeforeSendToResponse($user_info, 404, "Searching data not match with any member"));

    }
}
