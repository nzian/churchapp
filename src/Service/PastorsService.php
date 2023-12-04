<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\PastorsRepository;
use App\Traits\CheckDeletedEntry;

final class PastorsService
{
    use CheckDeletedEntry;
    private PastorsRepository $pastorsRepository;

    public function __construct(PastorsRepository $pastorsRepository)
    {
        $this->pastorsRepository = $pastorsRepository;
    }

    public function checkAndGet(int $pastorsId): object
    {
        return $this->pastorsRepository->checkAndGet($pastorsId);
    }

    public function checkAndGetByEmail(string $email) {
        return $this->pastorsRepository->checkAndGetByEmail($email);
    }

    public function getAll(): array
    {
        return $this->removeDeletedEntries($this->pastorsRepository->getAll());
    }

    public function getOne(int $pastorsId): object
    {
        return $this->removeDeletedEntry($this->checkAndGet($pastorsId));
    }

    public function create(array $input): object
    {
        $pastors = json_decode((string) json_encode($input), false);

        return $this->pastorsRepository->create($pastors);
    }

    public function update(array $input, int $pastorsId): object
    {
        $pastors = $this->removeDeletedEntry($this->checkAndGet($pastorsId));
        $data = json_decode((string) json_encode($input), false);
        if($pastors !== null) {
            return $this->pastorsRepository->update($pastors, $data);
        }
        return null;
    }

    public function delete(int $pastorsId): void
    {
        $this->checkAndGet($pastorsId);
        $this->pastorsRepository->delete($pastorsId);
    }

    public function getPastorByEmail(array $input) {
        return $this->removeDeletedEntry($this->checkAndGetByEmail($input['email']));
    }
}