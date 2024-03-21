<?php

declare(strict_types=1);

namespace App\Controller\City;

use App\Service\CityService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getCityService(): CityService
    {
        return $this->container->get('city_service');
    }
}
