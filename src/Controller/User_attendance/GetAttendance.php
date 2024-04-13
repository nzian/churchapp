<?php

declare(strict_types=1);

namespace App\Controller\User_attendance;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Rakit\Validation\Validator;
use App\Traits\DataResponse;

final class GetAttendance extends Base
{
    use DataResponse;
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $userInputValidator = new Validator;
        $result = $userInputValidator->validate($input, $this->getCreateRule());
        if($result) {
            if($args['id'] === 'all') {
                $user_attendance = $this->getUser_attendanceService()->allUserAttendance($input);
            }
            else {
                $user_attendance = $this->getUser_attendanceService()->getAttendanceByUserId($input, (int)$args['id']);
            }
            if(is_array($user_attendance)) :
                return $response->withJson($this->updateDataBeforeSendToResponse($user_attendance), StatusCodeInterface::STATUS_CREATED);
            else:
                $users = [];
                return $response->withJson($this->updateDataBeforeSendToResponse($users, 404, "No attendance data found in the system"));
            endif;

        }
        else {
            return $response->withJson($this->updateDataBeforeSendToResponse([], 300, $result), StatusCodeInterface::STATUS_EXPECTATION_FAILED);
        }
        
    }
    private function getCreateRule() {
        return [
            'month'               => 'default:1|numeric|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'year'                => 'default:2024|numeric|min:2024',
            'start_date'          => 'date:d-m-Y h:i:s',
            'end_date'            => 'date:d-m-Y h:i:s',
        ];
    }
}
