<?php

declare(strict_types=1);

namespace App\Repository;

final class User_attendanceRepository
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

    public function checkAndGet(int $user_attendanceId): object
    {
        $query = 'SELECT * FROM `user_attendance` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_attendanceId);
        $statement->execute();
        $user_attendance = $statement->fetchObject();
        if (! $user_attendance) {
            throw new \Exception('User_attendance not found.', 404);
        }

        return $user_attendance;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `user_attendance` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $user_attendance): object
    {
        $query = 'INSERT INTO `user_attendance` (`id`, `user_id`, `church_id`, `user_type`, `qr_code_text`, `created_at`, `updated_at`, `deleted_at`) VALUES (:id, :user_id, :church_id, :user_type, :qr_code_text, :created_at, :updated_at, :deleted_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_attendance->id);
        $statement->bindParam('user_id', $user_attendance->user_id);
        $statement->bindParam('church_id', $user_attendance->church_id);
        $statement->bindParam('user_type', $user_attendance->user_type);
        $statement->bindParam('qr_code_text', $user_attendance->qr_code_text);
        $statement->bindParam('created_at', $user_attendance->created_at);
        $statement->bindParam('updated_at', $user_attendance->updated_at);
        $statement->bindParam('deleted_at', $user_attendance->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $user_attendance, object $data): object
    {
        if (isset($data->user_id)) {
            $user_attendance->user_id = $data->user_id;
        }
        if (isset($data->church_id)) {
            $user_attendance->church_id = $data->church_id;
        }
        if (isset($data->user_type)) {
            $user_attendance->user_type = $data->user_type;
        }
        if (isset($data->qr_code_text)) {
            $user_attendance->qr_code_text = $data->qr_code_text;
        }
        if (isset($data->created_at)) {
            $user_attendance->created_at = $data->created_at;
        }
        if (isset($data->updated_at)) {
            $user_attendance->updated_at = $data->updated_at;
        }
        if (isset($data->deleted_at)) {
            $user_attendance->deleted_at = $data->deleted_at;
        }

        $query = 'UPDATE `user_attendance` SET `user_id` = :user_id, `church_id` = :church_id, `user_type` = :user_type, `qr_code_text` = :qr_code_text, `created_at` = :created_at, `updated_at` = :updated_at, `deleted_at` = :deleted_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_attendance->id);
        $statement->bindParam('user_id', $user_attendance->user_id);
        $statement->bindParam('church_id', $user_attendance->church_id);
        $statement->bindParam('user_type', $user_attendance->user_type);
        $statement->bindParam('qr_code_text', $user_attendance->qr_code_text);
        $statement->bindParam('created_at', $user_attendance->created_at);
        $statement->bindParam('updated_at', $user_attendance->updated_at);
        $statement->bindParam('deleted_at', $user_attendance->deleted_at);

        $statement->execute();

        return $this->checkAndGet((int) $user_attendance->id);
    }

    public function delete(int $user_attendanceId): void
    {
        $query = 'DELETE FROM `user_attendance` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $user_attendanceId);
        $statement->execute();
    }

    public function existCheckin(object $checkin): bool
    {
        $current_date = date('Y-m-d h:i:s');
        $query = 'SELECT id FROM `user_attendance` WHERE `user_id` = :user_id AND qr_code_text = :qr_code_text AND created_at = ' . $current_date;
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('user_id', $checkin->user_id);
        $statement->bindParam('qr_code_text', $checkin->qr_code_text);
        $statement->execute();
        $user_attendance = $statement->fetchObject();
        if (! $user_attendance) {
            return false;
        }

        return true;
    }

    public function getAttendanceAll(string $start_date, string $end_date) : array {
        $query = 'SELECT `user_attendance`.*,`user_information`.first_name,`user_information`.last_name FROM `user_attendance` LEFT JOIN `user_information` ON `user_attendance`.user_id = `user_information`.user_id WHERE `user_attendance`.created_at >= :startDate AND `user_attendance`.created_at <= :endDate AND `user_attendance`.deleted_at is NULL';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('startDate', $start_date);
        $statement->bindParam('endDate', $end_date);
        $statement->execute();
        $user_attendance = $statement->fetchAll();
        if (!$user_attendance) {
            return [];
        }

        return $user_attendance;
    }

    public function getAttendanceByUserId(int $user_id, string $start_date, string $end_date) : array {
        $query = 'SELECT `user_attendance`.*,`user_information`.first_name,`user_information`.last_name FROM `user_attendance` LEFT JOIN `user_information` ON `user_attendance`.user_id = `user_information`.user_id WHERE `user_attendance`.user_id = :user_id AND `user_attendance`.created_at >= :startDate AND `user_attendance`.created_at <= :endDate AND `user_attendance`.deleted_at is NULL';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('startDate', $start_date);
        $statement->bindParam('endDate', $end_date);
        $statement->bindParam('user_id', $user_id);
        $statement->execute();
        $user_attendance = $statement->fetchAll();
        if (!$user_attendance) {
            return [];
        }

        return $user_attendance;
    }
}
