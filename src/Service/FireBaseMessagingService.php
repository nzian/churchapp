<?php

declare(strict_types=1);

namespace App\Service;

use Kreait\Firebase\Factory;
use GuzzleHttp\MessageFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

final class FireBaseMessagingService
{
    private $key;
    private $firebase;
    private $fileCache;

    public function __construct()
    {
        $this->key = dirname(dirname(dirname(__FILE__))) . '/key/brew-crew-768eb-b427251847f5.json';
        $this->firebase =  (new Factory())->withServiceAccount($this->key);
        $this->setLogger();
        $this->fileCache = new FilesystemAdapter(
            '',
            0,
            dirname(dirname(dirname(__FILE__))) . '/cache'
        );
        $this->setCache();
    }

    public function getFirebaseInstance()
    {
        return $this->firebase;
    }


    private function setCache()
    {
        $this->firebase = $this->firebase->withAuthTokenCache($this->fileCache)->withVerifierCache($this->fileCache);

    }

    private function setLogger()
    {
        $httpLogger = new Logger('firebase_http_logs');
        $httpLogger->pushHandler(new StreamHandler(dirname(dirname(dirname(__FILE__))) . '/logs', Logger::INFO));

        // Without further arguments, requests and responses will be logged with basic
        // request and response information. Successful responses will be logged with
        // the 'info' log level, failures (Status code >= 400) with 'notice'
        $this->firebase = $this->firebase->withHttpLogger($httpLogger);

        // You can configure the message format and log levels individually
        $messageFormatter = new MessageFormatter(MessageFormatter::SHORT);
        $this->firebase = $this->firebase->withHttpLogger(
            $httpLogger,
            $messageFormatter,
            $successes = 'debug',
            $errors = 'warning'
        );

        // You can provide a separate logger for detailed HTTP message logs
        $httpDebugLogger = new Logger('firebase_http_debug_logs');
        $httpDebugLogger->pushHandler(
            new StreamHandler(
                dirname(dirname(dirname(__FILE__))) . '/logs/firebase_api_debug.log',
                Logger::DEBUG
            )
        );

        // Logs will include the full request and response headers and bodies
        $this->firebase = $this->firebase->withHttpDebugLogger($httpDebugLogger);
    }

}
