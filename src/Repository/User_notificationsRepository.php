<?php

declare(strict_types=1);

namespace App\Repository;

final class User_notificationsRepository
{
    private \PDO $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function getDb(): \PDO
    {
        return $this->database;
    }

    public function checkAndGet(int $user_notificationsId): object
    {
        $query = 'SELECT `user_notifications`.*,`notifications`.title,`notifications`.description, `notifications`.published_at FROM `user_notifications` LEFT JOIN `notifications` ON `user_notifications`.notification_id = `notifications`.id WHERE `user_notifications`.id = :id AND `user_notifications`.deleted_at is NULL';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_notificationsId);
        $statement->execute();
        $user_notifications = $statement->fetchObject();
        if (!$user_notifications) {
            throw new \Exception('User_notifications not found.', 404);
        }

        return $user_notifications;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `user_notifications` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $user_notifications): object
    {
        $query = 'INSERT INTO `user_notifications` (`id`, `user_id`, `church_id`, `notification_id`, `read`, `created_at`, `updated_at`, `deleted_at`) VALUES (:id, :user_id, :church_id, :notification_id, :read, :created_at, :updated_at, :deleted_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_notifications->id);
        $statement->bindParam('user_id', $user_notifications->user_id);
        $statement->bindParam('church_id', $user_notifications->church_id);
        $statement->bindParam('notification_id', $user_notifications->notification_id);
        $statement->bindParam('read', $user_notifications->read);
        $statement->bindParam('created_at', $user_notifications->created_at);
        $statement->bindParam('updated_at', $user_notifications->updated_at);
        $statement->bindParam('deleted_at', $user_notifications->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $user_notifications, object $data): object
    {
        if (isset($data->user_id)) {
            $user_notifications->user_id = $data->user_id;
        }
        if (isset($data->church_id)) {
            $user_notifications->church_id = $data->church_id;
        }
        if (isset($data->notification_id)) {
            $user_notifications->notification_id = $data->notification_id;
        }
        if (isset($data->read)) {
            $user_notifications->read = $data->read;
        }
        if (isset($data->created_at)) {
            $user_notifications->created_at = $data->created_at;
        }
        if (isset($data->updated_at)) {
            $user_notifications->updated_at = $data->updated_at;
        }
        if (isset($data->deleted_at)) {
            $user_notifications->deleted_at = $data->deleted_at;
        }

        $query = 'UPDATE `user_notifications` SET `user_id` = :user_id, `church_id` = :church_id, `notification_id` = :notification_id, `read` = :read, `created_at` = :created_at, `updated_at` = :updated_at, `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_notifications->id);
        $statement->bindParam('user_id', $user_notifications->user_id);
        $statement->bindParam('church_id', $user_notifications->church_id);
        $statement->bindParam('notification_id', $user_notifications->notification_id);
        $statement->bindParam('read', $user_notifications->read);
        $statement->bindParam('created_at', $user_notifications->created_at);
        $statement->bindParam('updated_at', $user_notifications->updated_at);
        $statement->bindParam('deleted_at', $user_notifications->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $user_notifications->id);
    }

    public function delete(int $user_notificationsId): void
    {
        $deleted_at = date('Y-m-d h:i:s');
        $query = 'UPDATE `user_notifications` SET `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('deleted_at', $deleted_at);
        $statement->bindParam('id', $user_notificationsId);
        $statement->execute();
    }
    public function bulkInsert(array $insert_data): void {
        try {
            foreach($insert_data as $rowData) {
                $query = 'INSERT INTO `user_notifications` (`user_id`, `church_id`, `notification_id`, `read`, `created_at`) VALUES (:user_id, :church_id, :notification_id, :read, :created_at)';
                $statement = $this->getDb()->prepare($query);
                //$statement->bindParam('id', $rowData['id']);
                $statement->bindParam('user_id', $rowData['user_id']);
                $statement->bindParam('church_id', $rowData['church_id']);
                $statement->bindParam('notification_id', $rowData['notification_id']);
                $statement->bindParam('read', $rowData['read']);
                $statement->bindParam('created_at',$rowData['created_at']);
                //$statement->bindParam('updated_at', $user_notifications->updated_at);
                //$statement->bindParam('deleted_at', $user_notifications->deleted_at);
        
                $statement->execute();
            } 
        }
        catch(\Exception $exception) {
            throw new \Exception('Error in bulk insert into user_notifications' . $exception->getMessage(), $exception->getCode());
        }
        
    }

    public function deleteByNotificationId(int $notification_id) : void {
        // delete all notification related notification_id
        $deleted_at = date('Y-m-d h:i:s');
        $query = 'UPDATE `user_notifications` SET `deleted_at` = :deleted_at WHERE `notification_id` = :notification_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('deleted_at', $deleted_at);
        $statement->bindParam('notification_id', $notification_id);
        $statement->execute();
    }

    public function getUserNotificationsByUserId(int $user_id) : array {
$query = 'SELECT `user_notifications`.*,`notifications`.title,`notifications`.description, `notifications`.published_at FROM `user_notifications` LEFT JOIN `notifications` ON `user_notifications`.notification_id = `notifications`.id WHERE `user_notifications`.user_id = :user_id AND `user_notifications`.deleted_at is NULL ORDER BY `user_notifications`.id DESC';

        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('user_id', $user_id);
        $statement->execute();
        $user_notifications = $statement->fetchAll();
        if (!$user_notifications) {
            throw new \Exception('User_notifications not found.', 404);
        }
        return $user_notifications;
    }

    private function countNotification(int $user_id, string $mode) : int {
        $read = 0;
        if($mode === 'read') {
            $read = 1;
        }
        if($mode === 'total') {
            $query = 'SELECT COUNT(`id`) AS `' . $mode . '`, `user_id` FROM user_notifications WHERE `user_id` = :user_id AND deleted_at is NULL GROUP BY `user_id`';
            $statement = $this->getDb()->prepare($query);
            $statement->bindParam('user_id', $user_notificationsId);
        }
        else {
            $query = 'SELECT COUNT(`id`) as `' . $mode . '`, `user_id` FROM user_notifications WHERE `user_id` = :user_id AND `read` = :read AND deleted_at is NULL GROUP BY `user_id`';
            $statement = $this->getDb()->prepare($query);
            $statement->bindParam('user_id', $user_id);
            $statement->bindParam('read', $read);
        }
        $statement->execute();
        $notification_state = $statement->fetchObject();
        if($notification_state && $notification_state->$mode > 0) {
            return $notification_state->$mode;
        }
        return 0;
    }

    public function getUserNotificationsStatisticsByUserId(int $user_id): array {
        return [
            'read' => $this->countNotification($user_id, 'read'),
            'unread' => $this->countNotification($user_id, 'unread'),
            'total' => $this->countNotification($user_id, 'total'),
        ];
    }
    
    public function UpdateUserNotification(int $read, int $user_id, int $notification_id): null|object {
        $query = 'UPDATE `user_notifications` SET `read` = :read WHERE `user_id` = :user_id AND `id` = :notification_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('user_id', $user_id);
        $statement->bindParam('read', $read);
        $statement->bindParam('notification_id', $notification_id);
        if($statement->execute()) {
            return $this->checkAndGet((int)$notification_id);
        }
    }

    public function deleteOldEntryByDate(string $date): void {
        $deleted_at = date('Y-m-d h:i:s');
        $query = 'UPDATE `user_notifications` SET `deleted_at` = :deleted_at WHERE `created_at` <= :date';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('deleted_at', $deleted_at);
        $statement->bindParam('date', $date);
        $statement->execute();
    }
}