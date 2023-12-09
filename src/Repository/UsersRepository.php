<?php

declare(strict_types=1);

namespace App\Repository;

final class UsersRepository
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

    public function checkAndGet(int $usersId): object
    {
        $query = 'SELECT * FROM `users` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usersId);
        $statement->execute();
        $users = $statement->fetchObject();
        if (!$users) {
            throw new \Exception('Users not found.', 404);
        }

        return $users;
    }

    public function checkAndGetByToken(string $device_token): null|object
    {
        $query = 'SELECT * FROM `users` WHERE `device_token` = :device_token';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('device_token', $device_token);
        $statement->execute();
        $users = $statement->fetchObject();
        if (!$users) {
return null;

        }

        return $users;
    }    

    public function getAll(): array
    {
        $query = 'SELECT * FROM `users` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $users): object
    {
        $query = 'INSERT INTO `users` (`id`, `name`, `device_token`, `email`, `phone`, `status`, `church_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (:id, :name, :device_token, :email, :phone, :status, :church_id, :created_at, :updated_at, :deleted_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $users->id);
        $statement->bindParam('name', $users->name);
        $statement->bindParam('device_token', $users->device_token);
        $statement->bindParam('email', $users->email);
        $statement->bindParam('phone', $users->phone);
        $statement->bindParam('status', $users->status);
        $statement->bindParam('church_id', $users->church_id);
        $statement->bindParam('created_at', $users->created_at);
        $statement->bindParam('updated_at', $users->updated_at);
        $statement->bindParam('deleted_at', $users->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $users, object $data): object
    {
        if (isset($data->name)) {
            $users->name = $data->name;
        }
        if (isset($data->device_token)) {
            $users->device_token = $data->device_token;
        }
        if (isset($data->email)) {
            $users->email = $data->email;
        }
        if (isset($data->phone)) {
            $users->phone = $data->phone;
        }
        if (isset($data->status)) {
            $users->status = $data->status;
        }
        if (isset($data->church_id)) {
            $users->church_id = $data->church_id;
        }
        if (isset($data->created_at)) {
            $users->created_at = $data->created_at;
        }
        if (isset($data->updated_at)) {
            $users->updated_at = $data->updated_at;
        }
        if (isset($data->deleted_at)) {
            $users->deleted_at = $data->deleted_at;
        }

        $query = 'UPDATE `users` SET `name` = :name, `device_token` = :device_token, `email` = :email, `phone` = :phone, `status` = :status, `church_id` = :church_id, `created_at` = :created_at, `updated_at` = :updated_at, `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $users->id);
        $statement->bindParam('name', $users->name);
        $statement->bindParam('device_token', $users->device_token);
        $statement->bindParam('email', $users->email);
        $statement->bindParam('phone', $users->phone);
        $statement->bindParam('status', $users->status);
        $statement->bindParam('church_id', $users->church_id);
        $statement->bindParam('created_at', $users->created_at);
        $statement->bindParam('updated_at', $users->updated_at);
        $statement->bindParam('deleted_at', $users->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $users->id);
    }

    public function delete(int $usersId): void
    {
        $deleted_at = date('Y-m-d h:i:s');
        $query = 'UPDATE `users` SET `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('deleted_at', $deleted_at);
        $statement->bindParam('id', $usersId);
        $statement->execute();
    }

    public function getDataBySelection(int $church_id, string $columns) : array {
        $query = 'SELECT ' . $columns . ' FROM `users` WHERE `church_id` = :church_id AND `status` = 1';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('church_id', $church_id);
        $statement->execute();
        return (array) $statement->fetchAll();
    }

    public function checkAndGetByEmail(string $email): null|object {
        $query = 'SELECT * FROM `users` WHERE `email` = :email';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('email', $email);
        $statement->execute();
        $users = $statement->fetchObject();
        if (!$users) {
            throw new \Exception('User not found.', 404);
        }

        return $users;
    }
}