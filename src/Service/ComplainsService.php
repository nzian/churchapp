<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ComplainsRepository;

final class ComplainsService
{
    private ComplainsRepository $complainsRepository;

    public function __construct(ComplainsRepository $complainsRepository)
    {
        $this->complainsRepository = $complainsRepository;
    }

    public function checkAndGet(int $complainsId): object
    {
        return $this->complainsRepository->checkAndGet($complainsId);
    }

    public function getAll(): array
    {
        return $this->complainsRepository->getAll();
    }

    public function getOne(int $complainsId): object
    {
        return $this->checkAndGet($complainsId);
    }

    public function create(array $input): object
    {
        $complains = json_decode((string) json_encode($input), false);

        return $this->complainsRepository->create($complains);
    }

    public function update(array $input, int $complainsId): object
    {
        $complains = $this->checkAndGet($complainsId);
        $data = json_decode((string) json_encode($input), false);

        return $this->complainsRepository->update($complains, $data);
    }

    public function delete(int $complainsId): void
    {
        $this->checkAndGet($complainsId);
        $this->complainsRepository->delete($complainsId);
    }
}
