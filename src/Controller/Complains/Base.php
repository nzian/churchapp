<?php

declare(strict_types=1);

namespace App\Controller\Complains;

use App\Service\ComplainsService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getComplainsService(): ComplainsService
    {
        return $this->container->get('complains_service');
    }
}
