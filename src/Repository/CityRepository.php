<?php

declare(strict_types=1);

namespace App\Repository;

final class CityRepository
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

    public function checkAndGet(int $cityId): object
    {
        $query = 'SELECT * FROM `city` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $cityId);
        $statement->execute();
        $city = $statement->fetchObject();
        if (! $city) {
            throw new \Exception('City not found.', 404);
        }

        return $city;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `city` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $city): object
    {
        $query = 'INSERT INTO `city` (`id`, `name`, `province_id`, `created_at`) VALUES (:id, :name, :province_id, :created_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $city->id);
        $statement->bindParam('name', $city->name);
        $statement->bindParam('province_id', $city->province_id);
        $statement->bindParam('created_at', $city->created_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $city, object $data): object
    {
        if (isset($data->name)) {
            $city->name = $data->name;
        }
        if (isset($data->province_id)) {
            $city->province_id = $data->province_id;
        }
        if (isset($data->created_at)) {
            $city->created_at = $data->created_at;
        }

        $query = 'UPDATE `city` SET `name` = :name, `province_id` = :province_id, `created_at` = :created_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $city->id);
        $statement->bindParam('name', $city->name);
        $statement->bindParam('province_id', $city->province_id);
        $statement->bindParam('created_at', $city->created_at);

        $statement->execute();

        return $this->checkAndGet((int) $city->id);
    }

    public function delete(int $cityId): void
    {
        $query = 'DELETE FROM `city` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $cityId);
        $statement->execute();
    }
}
