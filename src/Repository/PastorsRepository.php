<?php

declare(strict_types=1);

namespace App\Repository;

final class PastorsRepository
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

    public function checkAndGet(int $pastorsId): object
    {
        $query = 'SELECT * FROM `pastors` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $pastorsId);
        $statement->execute();
        $pastors = $statement->fetchObject();
        if (!$pastors) {
            throw new \Exception('Pastors not found.', 404);
        }

        return $pastors;
    }

    public function checkAndGetByEmail(string $email): object {
        $query = 'SELECT * FROM `pastors` WHERE `email` = :email';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('email', $email);
        $statement->execute();
        $pastors = $statement->fetchObject();
        if (!$pastors) {
            throw new \Exception('Pastors not found.', 404);
        }

        return $pastors;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `pastors` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $pastors): object
    {
        $query = 'INSERT INTO `pastors` (`id`, `name`, `email`, `status`, `social_media_link`, `church_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (:id, :name, :email, :status, :social_media_link, :church_id, :created_at, :updated_at, :deleted_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $pastors->id);
        $statement->bindParam('name', $pastors->name);
        $statement->bindParam('email', $pastors->email);
        $statement->bindParam('status', $pastors->status);
        $statement->bindParam('church_id', $pastors->church_id);
        $statement->bindParam('social_media_link', $pastors->social_media_link);
        $statement->bindParam('created_at', $pastors->created_at);
        $statement->bindParam('updated_at', $pastors->updated_at);
        $statement->bindParam('deleted_at', $pastors->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $pastors, object $data): object
    {
        if (isset($data->name)) {
            $pastors->name = $data->name;
        }
        if (isset($data->email)) {
            $pastors->email = $data->email;
        }
        if (isset($data->status)) {
            $pastors->status = $data->status;
        }
        if (isset($data->church_id)) {
            $pastors->church_id = $data->church_id;
        }
        if (isset($data->social_media_link)) {
            $pastors->social_media_link = $data->social_media_link;
        }
        if (isset($data->created_at)) {
            $pastors->created_at = $data->created_at;
        }
        if (isset($data->updated_at)) {
            $pastors->updated_at = $data->updated_at;
        }
        if (isset($data->deleted_at)) {
            $pastors->deleted_at = $data->deleted_at;
        }

        $query = 'UPDATE `pastors` SET `name` = :name, `email` = :email, `status` = :status, `social_media_link` = :social_media_link, `church_id` = :church_id, `created_at` = :created_at, `updated_at` = :updated_at, `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $pastors->id);
        $statement->bindParam('name', $pastors->name);
        $statement->bindParam('email', $pastors->email);
        $statement->bindParam('status', $pastors->status);
        $statement->bindParam('social_media_link', $pastors->social_media_link);
        $statement->bindParam('church_id', $pastors->church_id);
        $statement->bindParam('created_at', $pastors->created_at);
        $statement->bindParam('updated_at', $pastors->updated_at);
        $statement->bindParam('deleted_at', $pastors->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $pastors->id);
    }

    public function delete(int $pastorsId): void
    {
        $deleted_at = date('Y-m-d h:i:s');
        $query = 'UPDATE `pastors` SET `deleted_at` =   WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $pastorsId);
        $statement->execute();
    }
}