<?php

declare(strict_types=1);

namespace App\Controller\Churches;

use App\Service\ChurchesService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getChurchesService(): ChurchesService
    {
        return $this->container->get('churches_service');
    }
}
