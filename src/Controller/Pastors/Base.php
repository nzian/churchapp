<?php

declare(strict_types=1);

namespace App\Controller\Pastors;

use App\Service\PastorsService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getPastorsService(): PastorsService
    {
        return $this->container->get('pastors_service');
    }
}
