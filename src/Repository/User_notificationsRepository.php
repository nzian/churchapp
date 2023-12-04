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
        $query = 'SELECT * FROM `user_notifications` WHERE `id` = :id';
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
        // now implement bulk insert
        // create the ?,? sequence for a single row
        try {
            $values = str_repeat('?,', count($insert_data[0]) - 1) . '?';
        // construct the entire query
        $query = "INSERT INTO `user_notifications` (`user_id`, `church_id`, `notification_id`, `read`, `created_at`) VALUES " .
            // repeat the (?,?) sequence for each row
            str_repeat("($values),", count($insert_data) - 1) . "($values)";    

        $statement = $this->getDb()->prepare($query);
        // execute with all values from $data
        $statement->execute(array_merge(...$insert_data));
        }
        catch(\Exception $exception) {
            throw new \Exception('Error in bulk insert into user_notifications t', 404);
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
}