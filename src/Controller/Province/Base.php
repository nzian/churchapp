<?php

declare(strict_types=1);

namespace App\Controller\Province;

use App\Service\ProvinceService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getProvinceService(): ProvinceService
    {
        return $this->container->get('province_service');
    }
}
