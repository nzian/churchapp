<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\CityRepository;

final class CityService
{
    private CityRepository $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function checkAndGet(int $cityId): object
    {
        return $this->cityRepository->checkAndGet($cityId);
    }

    public function getAll(): array
    {
        return $this->cityRepository->getAll();
    }

    public function getOne(int $cityId): object
    {
        return $this->checkAndGet($cityId);
    }

    public function create(array $input): object
    {
        $city = json_decode((string) json_encode($input), false);

        return $this->cityRepository->create($city);
    }

    public function update(array $input, int $cityId): object
    {
        $city = $this->checkAndGet($cityId);
        $data = json_decode((string) json_encode($input), false);

        return $this->cityRepository->update($city, $data);
    }

    public function delete(int $cityId): void
    {
        $this->checkAndGet($cityId);
        $this->cityRepository->delete($cityId);
    }
}
