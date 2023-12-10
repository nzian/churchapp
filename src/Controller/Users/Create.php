<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use Valitron\Validator;


final class Create extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();

$validation = new Validator($input);
$validation->rule('required', ['device_token','church_id']);
if(!$validation->validate()) {
    return $response->withJson($this->updateDataBeforeSendToResponse($validation->errors(), 500, 'Validation error'), StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
}

        $users = $this->getUsersService()->create($input);

        return $response->withJson($this->updateDataBeforeSendToResponse($users), StatusCodeInterface::STATUS_CREATED);
    }
}