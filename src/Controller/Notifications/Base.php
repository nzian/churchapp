<?php

declare(strict_types=1);

namespace App\Controller\Notifications;

use App\Service\NotificationsService;
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

    protected function getNotificationsService(): NotificationsService
    {
        return $this->container->get('notifications_service');
    }

    protected function getUsersService(): UsersService {
        return $this->container->get('users_service');
    }
    protected function getUserNotificationService(): User_notificationsService {
        return $this->container->get('user_notifications_service');
    }
}