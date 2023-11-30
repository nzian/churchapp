<?php

declare(strict_types=1);


$container['churches_service'] = static function (Pimple\Container $container): App\Service\ChurchesService {
    return new App\Service\ChurchesService($container['churches_repository']);
};

$container['users_service'] = static function (Pimple\Container $container): App\Service\UsersService {
    return new App\Service\UsersService($container['users_repository']);
};

$container['user_notifications_service'] = static function (Pimple\Container $container): App\Service\User_notificationsService {
    return new App\Service\User_notificationsService($container['user_notifications_repository']);
};

$container['pastors_service'] = static function (Pimple\Container $container): App\Service\PastorsService {
    return new App\Service\PastorsService($container['pastors_repository']);
};

$container['notifications_service'] = static function (Pimple\Container $container): App\Service\NotificationsService {
    return new App\Service\NotificationsService($container['notifications_repository']);
};
