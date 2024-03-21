<?php

declare(strict_types=1);

namespace App\Controller\User_attendance;

use App\CustomResponse as Response;
use App\Validator\UserAttendanceValidator;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Rakit\Validation\Validator;
use App\Traits\DataResponse;

final class Create extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $userInputValidator = new Validator;
        $result = $userInputValidator->validate($input, $this->getCreateRule());
        if($result) {
            $user_attendance = $this->getUser_attendanceService()->create($input);
            return $response->withJson($this->updateDataBeforeSendToResponse($user_attendance), StatusCodeInterface::STATUS_CREATED);
        }
        else {
            return $response->withJson($this->updateDataBeforeSendToResponse([], 300, $result), StatusCodeInterface::STATUS_EXPECTATION_FAILED);
        }
        
    }
    private function getCreateRule() {
        return [
            'user_id'               => 'required|numeric',
            'church_id'             => 'required|numeric',
            'user_type'             => 'required|alpha',
            'qr_code_text'          => 'required|numeric',
        ];
    }
}
