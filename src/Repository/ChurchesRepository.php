<?php

declare(strict_types=1);

namespace App\Repository;

final class ChurchesRepository
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

    public function checkAndGet(int $churchesId): object
    {
        $query = 'SELECT * FROM `churches` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $churchesId);
        $statement->execute();
        $churches = $statement->fetchObject();
        if (!$churches) {
            throw new \Exception('Churches not found.', 404);
        }

        return $churches;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `churches` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $churches): object
    {
        $query = 'INSERT INTO `churches` (`id`, `name`, `firebaseId`, `address`, `location`, `social_media_link`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES (:id, :name, :firebaseId, :address, :location, :social_media_link, :status, :created_at, :updated_at, :deleted_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $churches->id);
        $statement->bindParam('name', $churches->name);
        $statement->bindParam('firebaseId', $churches->firebaseId);
        $statement->bindParam('address', $churches->address);
        $statement->bindParam('location', $churches->location);
        $statement->bindParam('social_media_link', $churches->social_media_link);
        $statement->bindParam('status', $churches->status);
        $statement->bindParam('created_at', $churches->created_at);
        $statement->bindParam('updated_at', $churches->updated_at);
        $statement->bindParam('deleted_at', $churches->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $churches, object $data): object
    {
        if (isset($data->name)) {
            $churches->name = $data->name;
        }
        if (isset($data->firebaseId)) {
            $churches->firebaseId = $data->firebaseId;
        }
        if (isset($data->address)) {
            $churches->address = $data->address;
        }
        if (isset($data->location)) {
            $churches->location = $data->location;
        }
        if (isset($data->social_media_link)) {
            $churches->social_media_link = $data->social_media_link;
        }
        if (isset($data->status)) {
            $churches->status = $data->status;
        }
        if (isset($data->created_at)) {
            $churches->created_at = $data->created_at;
        }
        if (isset($data->updated_at)) {
            $churches->updated_at = $data->updated_at;
        }
        if (isset($data->deleted_at)) {
            $churches->deleted_at = $data->deleted_at;
        }

        $query = 'UPDATE `churches` SET `name` = :name, `firebaseId` = :firebaseId, `address` = :address, `location` = :location, `social_media_link` = :social_media_link, `status` = :status, `created_at` = :created_at, `updated_at` = :updated_at, `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $churches->id);
        $statement->bindParam('name', $churches->name);
        $statement->bindParam('firebaseId', $churches->firebaseId);
        $statement->bindParam('address', $churches->address);
        $statement->bindParam('location', $churches->location);
        $statement->bindParam('social_media_link', $churches->social_media_link);
        $statement->bindParam('status', $churches->status);
        $statement->bindParam('created_at', $churches->created_at);
        $statement->bindParam('updated_at', $churches->updated_at);
        $statement->bindParam('deleted_at', $churches->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $churches->id);
    }

    public function delete(int $churchesId): void
    {
        $deleted_at = date('Y-m-d h:i:s');
        $query = 'UPDATE `churches` SET `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('deleted_at', $deleted_at);
        $statement->bindParam('id', $churchesId);
        $statement->execute();
    }
}
