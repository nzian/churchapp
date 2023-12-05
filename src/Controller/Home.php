<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use Pimple\Psr11\Container;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\ConfigData;

final class Home
{
    use ConfigData;
    private const API_NAME = 'slim4-api-skeleton';

    private const API_VERSION = '0.41.0';

    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getJsonData(Request $request, Response $response): Response {

        return $response->withJson($this->getConfigData());
    }

    public function getCfc2JsonData(Request $request, Response $response): Response {

        return $response->withJson($this->getCfc1ConfigData());
    }

    public function getCfc3JsonData(Request $request, Response $response): Response {

        return $response->withJson($this->getCfc2ConfigData());
    }

    public function getHelp(Request $request, Response $response): Response
    {
        $message = [
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $response->withJson($message);
    }

    public function getStatus(Request $request, Response $response): Response
    {
        $this->container->get('db');
        $status = [
            'status' => [
                'database' => 'OK',
            ],
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $response->withJson($status);
    }
}