<?php

declare(strict_types=1);

use Slim\App;

return static function (App $app, Closure $customErrorHandler): void {
    $path = $_SERVER['SLIM_BASE_PATH'] ?? '';
    $app->setBasePath($path);
    $app->addRoutingMiddleware();
    $app->addBodyParsingMiddleware();
    $displayError = filter_var(
        $_SERVER['DISPLAY_ERROR_DETAILS'] ?? false,
        FILTER_VALIDATE_BOOLEAN
    );
$app->add(new \Tuupola\Middleware\HttpBasicAuthentication([
    "secure" => getenv('API_SECURE'),
    "relaxed" => ["localhost", "devng.churchapp","127.0.0.1"],
    "users" => [
        getenv('API_USER') =>  getenv('API_PASSWORD')
    ]
]));

    $errorMiddleware = $app->addErrorMiddleware($displayError, true, true);
    $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
};
