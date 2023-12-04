<?php

declare(strict_types=1);

namespace App\Controller\Pastors;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\DataResponse;
use stdClass;

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
        if(array_key_exists('social_media_link', $input)) {
            $input['social_media_link'] = json_encode($input['social_media_link']);
        }
        $pastors = $this->getPastorsService()->update($input, (int) $args['id']);
        if($pastors === null) {
            $pastors = new stdClass();
            return $response->withJson($this->updateDataBeforeSendToResponse($pastors, 404, "Pastor Not found in the system"));
        }
        $pastors->social_media_link = json_decode($pastors->social_media_link, true);
        return $response->withJson($this->updateDataBeforeSendToResponse($pastors));
    }
}