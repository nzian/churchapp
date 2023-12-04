<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\NotificationsRepository;
use App\Traits\CheckDeletedEntry;

final class NotificationsService
{
    use CheckDeletedEntry;
    private NotificationsRepository $notificationsRepository;

    public function __construct(NotificationsRepository $notificationsRepository)
    {
        $this->notificationsRepository = $notificationsRepository;
    }

    public function checkAndGet(int $notificationsId): object
    {
        return $this->notificationsRepository->checkAndGet($notificationsId);
    }

    public function getAll(): array
    {
        return $this->removeDeletedEntries($this->notificationsRepository->getAll());
    }

    public function getOne(int $notificationsId): object
    {
        return $this->removeDeletedEntry($this->checkAndGet($notificationsId));
    }

    public function create(array $input): object
    {
        $notifications = json_decode((string) json_encode($input), false);

        return $this->notificationsRepository->create($notifications);
    }

    public function update(array $input, int $notificationsId): object
    {
        $notifications = $this->removeDeletedEntry($this->checkAndGet($notificationsId));
        $data = json_decode((string) json_encode($input), false);
        if($notifications !== null) {
            return $this->notificationsRepository->update($notifications, $data);
        }
        return null;
    }

    public function delete(int $notificationsId): void
    {
        $this->checkAndGet($notificationsId);
        $this->notificationsRepository->delete($notificationsId);
    }

    public function getNotificationByPastor(int $pastor_id) {
        return $this->notificationsRepository->getNotificationByPastor($pastor_id);
    }

    public function checkPastorOwnNotification(int $pastor_id, $notification_id): bool {
        $result = $this->notificationsRepository->pastorOwnNotification($pastor_id, $notification_id);
        return $result;
    }
}