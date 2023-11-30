<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\User_notificationsRepository;
use App\Traits\CheckDeletedEntry;

final class User_notificationsService
{
    use CheckDeletedEntry;
    private User_notificationsRepository $user_notificationsRepository;

    public function __construct(User_notificationsRepository $user_notificationsRepository)
    {
        $this->user_notificationsRepository = $user_notificationsRepository;
    }

    public function checkAndGet(int $user_notificationsId): object
    {
        return $this->user_notificationsRepository->checkAndGet($user_notificationsId);
    }

    public function getAll(): array
    {
        return $this->removeDeletedEntries($this->user_notificationsRepository->getAll());
    }

    public function getOne(int $user_notificationsId): object
    {
        return $this->removeDeletedEntry($this->checkAndGet($user_notificationsId));
    }

    public function create(array $input): object
    {
        $user_notifications = json_decode((string) json_encode($input), false);

        return $this->user_notificationsRepository->create($user_notifications);
    }

    public function update(array $input, int $user_notificationsId): object
    {
        $user_notifications = $this->removeDeletedEntry($this->checkAndGet($user_notificationsId));
        $data = json_decode((string) json_encode($input), false);
        if($user_notifications !== null) {
            return $this->user_notificationsRepository->update($user_notifications, $data);
        }
        return null;
    }

    public function delete(int $user_notificationsId): void
    {
        $this->checkAndGet($user_notificationsId);
        $this->user_notificationsRepository->delete($user_notificationsId);
    }
}
