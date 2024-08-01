<?php

declare(strict_types=1);

namespace App\Controller\Complains;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\UploadedFile;

final class Update extends Base
{
    use UploadedFile;
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $request = $this->uploadedFileProcess($request);
        $input = (array) $request->getParsedBody();
        $complains = $this->getComplainsService()->update($input, (int) $args['id']);

        return $response->withJson($complains);
    }
}
