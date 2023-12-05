<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\Service\User_notificationsService;
use App\Service\UsersService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getUsersService(): UsersService
    {
        return $this->container->get('users_service');
    }

    protected function GetUserNotificationsService(): User_notificationsService {
        return $this->container->get('user_notifications_service');
    }
}