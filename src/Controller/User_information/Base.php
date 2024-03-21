<?php

declare(strict_types=1);

namespace App\Controller\User_information;

use App\Service\User_informationService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getUser_informationService(): User_informationService
    {
        return $this->container->get('user_information_service');
    }
}
