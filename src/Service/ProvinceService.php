<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ProvinceRepository;

final class ProvinceService
{
    private ProvinceRepository $provinceRepository;

    public function __construct(ProvinceRepository $provinceRepository)
    {
        $this->provinceRepository = $provinceRepository;
    }

    public function checkAndGet(int $provinceId): object
    {
        return $this->provinceRepository->checkAndGet($provinceId);
    }

    public function getAll(): array
    {
        return $this->provinceRepository->getAll();
    }

    public function getOne(int $provinceId): object
    {
        return $this->checkAndGet($provinceId);
    }

    public function create(array $input): object
    {
        $province = json_decode((string) json_encode($input), false);

        return $this->provinceRepository->create($province);
    }

    public function update(array $input, int $provinceId): object
    {
        $province = $this->checkAndGet($provinceId);
        $data = json_decode((string) json_encode($input), false);

        return $this->provinceRepository->update($province, $data);
    }

    public function delete(int $provinceId): void
    {
        $this->checkAndGet($provinceId);
        $this->provinceRepository->delete($provinceId);
    }
}
