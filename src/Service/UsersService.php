<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UsersRepository;
use App\Traits\CheckDeletedEntry;
use stdClass;

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

    public function checkAndGetByEmail(string $email) {
        return $this->usersRepository->checkAndGetByEmail($email);
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


if(property_exists($users, 'device_token')) {


    $user =  $this->usersRepository->checkAndGetByToken($users->device_token);
   // print_r($user);exit;
    if($user instanceof stdClass) {
        return $user;
    }
}
    
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

    public function churchUserDeviceToken(int $church_id, string $columns) : array {
        return $this->usersRepository->getDataBySelection($church_id, $columns);
    }
    public function getChurchUserIds(int $church_id, string $columns) : array {
        return $this->usersRepository->getDataBySelection($church_id, $columns);
    }

    public function GetUserByEmail(array $input) {
        return $this->removeDeletedEntry($this->checkAndGetByEmail($input['email']));
    }
}