<?php

declare(strict_types=1);

namespace App\Controller\Complains;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\UploadedFile;

final class Create extends Base
{
    use UploadedFile;
    public function __invoke(Request $request, Response $response): Response
    {
        $request = $this->uploadedFileProcess($request);
        $input = (array) $request->getParsedBody();
        $complains = $this->getComplainsService()->create($input);

        return $response->withJson($complains, StatusCodeInterface::STATUS_CREATED);
    }
}
