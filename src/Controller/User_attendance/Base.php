<?php

declare(strict_types=1);

namespace App\Controller\User_attendance;

use App\Service\User_attendanceService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getUser_attendanceService(): User_attendanceService
    {
        return $this->container->get('user_attendance_service');
    }
}
