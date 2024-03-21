<?php

declare(strict_types=1);


$container['churches_repository'] = static function (Pimple\Container $container): App\Repository\ChurchesRepository {
    return new App\Repository\ChurchesRepository($container['db']);
};

$container['users_repository'] = static function (Pimple\Container $container): App\Repository\UsersRepository {
    return new App\Repository\UsersRepository($container['db']);
};

$container['user_notifications_repository'] = static function (Pimple\Container $container): App\Repository\User_notificationsRepository {
    return new App\Repository\User_notificationsRepository($container['db']);
};

$container['pastors_repository'] = static function (Pimple\Container $container): App\Repository\PastorsRepository {
    return new App\Repository\PastorsRepository($container['db']);
};

$container['notifications_repository'] = static function (Pimple\Container $container): App\Repository\NotificationsRepository {
    return new App\Repository\NotificationsRepository($container['db']);
};

$container['user_attendance_repository'] = static function (Pimple\Container $container): App\Repository\User_attendanceRepository {
    return new App\Repository\User_attendanceRepository($container['db']);
};

$container['user_information_repository'] = static function (Pimple\Container $container): App\Repository\User_informationRepository {
    return new App\Repository\User_informationRepository($container['db']);
};

$container['province_repository'] = static function (Pimple\Container $container): App\Repository\ProvinceRepository {
    return new App\Repository\ProvinceRepository($container['db']);
};

$container['city_repository'] = static function (Pimple\Container $container): App\Repository\CityRepository {
    return new App\Repository\CityRepository($container['db']);
};
