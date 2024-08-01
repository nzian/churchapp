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

$container['user_attendance_service'] = static function (Pimple\Container $container): App\Service\User_attendanceService {
    return new App\Service\User_attendanceService($container['user_attendance_repository']);
};

$container['user_information_service'] = static function (Pimple\Container $container): App\Service\User_informationService {
    return new App\Service\User_informationService($container['user_information_repository'], $container['users_repository']);
};

$container['province_service'] = static function (Pimple\Container $container): App\Service\ProvinceService {
    return new App\Service\ProvinceService($container['province_repository']);
};

$container['city_service'] = static function (Pimple\Container $container): App\Service\CityService {
    return new App\Service\CityService($container['city_repository']);
};

$container['complains_service'] = static function (Pimple\Container $container): App\Service\ComplainsService {
    return new App\Service\ComplainsService($container['complains_repository']);
};
