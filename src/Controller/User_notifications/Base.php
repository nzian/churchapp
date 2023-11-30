<?php

declare(strict_types=1);

namespace App\Controller\User_notifications;

use App\Service\User_notificationsService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getUser_notificationsService(): User_notificationsService
    {
        return $this->container->get('user_notifications_service');
    }
}
