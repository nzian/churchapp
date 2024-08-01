<?php

declare(strict_types=1);

namespace App\Repository;

final class ComplainsRepository
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

    public function checkAndGet(int $complainsId): object
    {
        $query = 'SELECT * FROM `complains` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $complainsId);
        $statement->execute();
        $complains = $statement->fetchObject();
        if (! $complains) {
            throw new \Exception('Complains not found.', 404);
        }

        return $complains;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `complains` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $complains): object
    {
        $query = 'INSERT INTO `complains` (`id`, `name`, `email`, `image`, `complain`, `created_at`, `updated_at`, `deleted_at`) VALUES (:id, :name, :email, :image, :complain, :created_at, :updated_at, :deleted_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $complains->id);
        $statement->bindParam('name', $complains->name);
        $statement->bindParam('email', $complains->email);
        $statement->bindParam('image', $complains->image);
        $statement->bindParam('complain', $complains->complain);
        $statement->bindParam('created_at', $complains->created_at);
        $statement->bindParam('updated_at', $complains->updated_at);
        $statement->bindParam('deleted_at', $complains->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $complains, object $data): object
    {
        if (isset($data->name)) {
            $complains->name = $data->name;
        }
        if (isset($data->email)) {
            $complains->email = $data->email;
        }
        if (isset($data->image)) {
            $complains->image = $data->image;
        }
        if (isset($data->complain)) {
            $complains->complain = $data->complain;
        }
        if (isset($data->created_at)) {
            $complains->created_at = $data->created_at;
        }
        if (isset($data->updated_at)) {
            $complains->updated_at = $data->updated_at;
        }
        if (isset($data->deleted_at)) {
            $complains->deleted_at = $data->deleted_at;
        }

        $query = 'UPDATE `complains` SET `name` = :name, `email` = :email, `image` = :image, `complain` = :complain, `created_at` = :created_at, `updated_at` = :updated_at, `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $complains->id);
        $statement->bindParam('name', $complains->name);
        $statement->bindParam('email', $complains->email);
        $statement->bindParam('image', $complains->image);
        $statement->bindParam('complain', $complains->complain);
        $statement->bindParam('created_at', $complains->created_at);
        $statement->bindParam('updated_at', $complains->updated_at);
        $statement->bindParam('deleted_at', $complains->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $complains->id);
    }

    public function delete(int $complainsId): void
    {
        $query = 'DELETE FROM `complains` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $complainsId);
        $statement->execute();
    }
}
