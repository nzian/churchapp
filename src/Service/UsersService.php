<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UsersRepository;
use App\Traits\CheckDeletedEntry;

final class UsersService
{
    use CheckDeletedEntry;
    private UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function checkAndGet(int $usersId): object
    {
        return $this->usersRepository->checkAndGet($usersId);
    }

    public function getAll(): array
    {
        return $this->removeDeletedEntries($this->usersRepository->getAll());
    }

    public function getOne(int $usersId): object
    {
        return $this->removeDeletedEntry($this->checkAndGet($usersId));
    }

    public function create(array $input): object
    {
        $users = json_decode((string) json_encode($input), false);

        return $this->usersRepository->create($users);
    }

    public function update(array $input, int $usersId): object
    {
        $users = $this->removeDeletedEntry($this->checkAndGet($usersId));
        $data = json_decode((string) json_encode($input), false);
        if($users !== null) {
            return $this->usersRepository->update($users, $data);
        }
        return null;
    }

    public function delete(int $usersId): void
    {
        $this->checkAndGet($usersId);
        $this->usersRepository->delete($usersId);
    }
}
