<?php

declare(strict_types=1);

namespace App\Repository;

final class NotificationsRepository
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

    public function checkAndGet(int $notificationsId): object
    {
        $query = 'SELECT * FROM `notifications` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $notificationsId);
        $statement->execute();
        $notifications = $statement->fetchObject();
        if (!$notifications) {
            throw new \Exception('Notifications not found.', 404);
        }

        return $notifications;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `notifications` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $notifications): object
    {
        $query = 'INSERT INTO `notifications` (`id`, `title`, `description`, `published`, `published_at`, `created_by`, `updated_by`, `church_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (:id, :title, :description, :published, :published_at, :created_by, :updated_by, :church_id, :created_at, :updated_at, :deleted_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $notifications->id);
        $statement->bindParam('title', $notifications->title);
        $statement->bindParam('description', $notifications->description);
        $statement->bindParam('published', $notifications->published);
        $statement->bindParam('published_at', $notifications->published_at);
        $statement->bindParam('created_by', $notifications->created_by);
        $statement->bindParam('updated_by', $notifications->updated_by);
        $statement->bindParam('church_id', $notifications->church_id);
        $statement->bindParam('created_at', $notifications->created_at);
        $statement->bindParam('updated_at', $notifications->updated_at);
        $statement->bindParam('deleted_at', $notifications->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $notifications, object $data): object
    {
        if (isset($data->title)) {
            $notifications->title = $data->title;
        }
        if (isset($data->description)) {
            $notifications->description = $data->description;
        }
        if (isset($data->published)) {
            $notifications->published = $data->published;
        }
        if (isset($data->published_at)) {
            $notifications->published_at = $data->published_at;
        }
        if (isset($data->created_by)) {
            $notifications->created_by = $data->created_by;
        }
        if (isset($data->updated_by)) {
            $notifications->updated_by = $data->updated_by;
        }
        if (isset($data->church_id)) {
            $notifications->church_id = $data->church_id;
        }
        if (isset($data->created_at)) {
            $notifications->created_at = $data->created_at;
        }
        if (isset($data->updated_at)) {
            $notifications->updated_at = $data->updated_at;
        }
        if (isset($data->deleted_at)) {
            $notifications->deleted_at = $data->deleted_at;
        }

        $query = 'UPDATE `notifications` SET `title` = :title, `description` = :description, `published` = :published, `published_at` = :published_at, `created_by` = :created_by, `updated_by` = :updated_by, `church_id` = :church_id, `created_at` = :created_at, `updated_at` = :updated_at, `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $notifications->id);
        $statement->bindParam('title', $notifications->title);
        $statement->bindParam('description', $notifications->description);
        $statement->bindParam('published', $notifications->published);
        $statement->bindParam('published_at', $notifications->published_at);
        $statement->bindParam('created_by', $notifications->created_by);
        $statement->bindParam('updated_by', $notifications->updated_by);
        $statement->bindParam('church_id', $notifications->church_id);
        $statement->bindParam('created_at', $notifications->created_at);
        $statement->bindParam('updated_at', $notifications->updated_at);
        $statement->bindParam('deleted_at', $notifications->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $notifications->id);
    }

    public function delete(int $notificationsId): void
    {
        $deleted_at = date('Y-m-d h:i:s');
        $query = 'UPDATE `notifications` SET `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('deleted_at', $deleted_at);
        $statement->bindParam('id', $notificationsId);
        $statement->execute();
    }
}
