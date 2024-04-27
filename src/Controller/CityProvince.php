<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Service\CityService;
use App\Service\ProvinceService;
use App\Service\User_informationService;
use Pimple\Psr11\Container;
use App\Traits\DataResponse;

final class CityProvince
{
    use DataResponse;
    protected Container $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    public function __invoke(Request $request, Response $response): Response
    {
        $citys = $this->getCityService()->getAll();
        $provinces = $this->getProvinceService()->getAll();
        $suburbs = $this->getUserInfomationService()->getSuburb();

        return $response->withJson($this->updateDataBeforeSendToResponse([
            'city' => $citys,
            'province' => $provinces,
            'suburb' => $suburbs
        ]));
    }

    protected function getCityService(): CityService
    {
        return $this->container->get('city_service');
    }
    protected function getProvinceService(): ProvinceService
    {
        return $this->container->get('province_service');
    }

    protected function getUserInfomationService(): User_informationService
    {
        return $this->container->get('user_information_service');
    }
}
