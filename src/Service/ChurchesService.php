<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ChurchesRepository;
use App\Traits\CheckDeletedEntry;

final class ChurchesService
{
    use CheckDeletedEntry;
    private ChurchesRepository $churchesRepository;

    public function __construct(ChurchesRepository $churchesRepository)
    {
        $this->churchesRepository = $churchesRepository;
    }

    public function checkAndGet(int $churchesId): object
    {
        return $this->churchesRepository->checkAndGet($churchesId);
    }

    public function getAll(): array
    {
        return $this->removeDeletedEntries($this->churchesRepository->getAll());
    }

    public function getOne(int $churchesId): object
    {
        return $this->removeDeletedEntry($this->checkAndGet($churchesId));
    }

    public function create(array $input): object
    {
        $churches = json_decode((string) json_encode($input), false);

        return $this->churchesRepository->create($churches);
    }

    public function update(array $input, int $churchesId): object
    {
        $churches = $this->removeDeletedEntry($this->checkAndGet($churchesId));
        $data = json_decode((string) json_encode($input), false);
        if($churches !== null) {
            return $this->churchesRepository->update($churches, $data);
        }

        return null;
    }

    public function delete(int $churchesId): void
    {
        // @todo if give an invalid id then exception is not handled
        $this->checkAndGet($churchesId);
        $this->churchesRepository->delete($churchesId);
    }
}
