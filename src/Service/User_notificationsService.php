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
    public function createUserNotifications(array $insert_data): void {
        $this->user_notificationsRepository->bulkInsert($insert_data);
    }

    public function deleteByNotificationId(int $notification_id): void {
        $this->user_notificationsRepository->deleteByNotificationId($notification_id);
    }

    public function getUserNotificationsByUserId(int $user_id) : array {
        // not only send notifications but also user notification statistics
        $result = [
            'notifications' => [],
            'statistics' => []
        ];
        $result['notifications'] = $this->user_notificationsRepository->getUserNotificationsByUserId($user_id);
        $result['statistics'] = $this->user_notificationsRepository->getUserNotificationsStatisticsByUserId($user_id);
        return $result;
    }


    public function updateNotification(int $read, int $user_id, int $notification_id): null|object {
        return $this->user_notificationsRepository->UpdateUserNotification($read, $user_id, $notification_id);
    }
}