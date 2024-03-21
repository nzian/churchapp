<?php

declare(strict_types=1);

namespace App\Repository;

final class ProvinceRepository
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

    public function checkAndGet(int $provinceId): object
    {
        $query = 'SELECT * FROM `province` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $provinceId);
        $statement->execute();
        $province = $statement->fetchObject();
        if (! $province) {
            throw new \Exception('Province not found.', 404);
        }

        return $province;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `province` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $province): object
    {
        $query = 'INSERT INTO `province` (`id`, `name`, `created_at`) VALUES (:id, :name, :created_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $province->id);
        $statement->bindParam('name', $province->name);
        $statement->bindParam('created_at', $province->created_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $province, object $data): object
    {
        if (isset($data->name)) {
            $province->name = $data->name;
        }
        if (isset($data->created_at)) {
            $province->created_at = $data->created_at;
        }

        $query = 'UPDATE `province` SET `name` = :name, `created_at` = :created_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $province->id);
        $statement->bindParam('name', $province->name);
        $statement->bindParam('created_at', $province->created_at);

        $statement->execute();

        return $this->checkAndGet((int) $province->id);
    }

    public function delete(int $provinceId): void
    {
        $query = 'DELETE FROM `province` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $provinceId);
        $statement->execute();
    }
}
