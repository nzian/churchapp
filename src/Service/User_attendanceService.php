<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\User_attendanceRepository;

use App\Validator\ConfigDataValidator;

final class User_attendanceService
{
    private User_attendanceRepository $user_attendanceRepository;
    private ConfigDataValidator $config_data_validator;

    public function __construct(User_attendanceRepository $user_attendanceRepository)
    {
        $this->user_attendanceRepository = $user_attendanceRepository;
        $this->config_data_validator = new ConfigDataValidator();
    }

    public function checkAndGet(int $user_attendanceId): object
    {
        return $this->user_attendanceRepository->checkAndGet($user_attendanceId);
    }

    public function getAll(): array
    {
        return $this->user_attendanceRepository->getAll();
    }

    public function getOne(int $user_attendanceId): object
    {
        return $this->checkAndGet($user_attendanceId);
    }

    public function create(array $input): object
    {
        $user_attendance = json_decode((string) json_encode($input), false);
        if(!$this->config_data_validator->isValidQrCode($user_attendance->qr_code_text)) {
            return (object)[
                'error' => true,
                'message' => "QR code is invalid",
            ];
        }
        $user_attendance->created_at = date('Y-m-d h:i:s');
        $user_attendance->updated_at = date('Y-m-d h:i:s');
        return $this->user_attendanceRepository->create($user_attendance);
    }

    public function update(array $input, int $user_attendanceId): object
    {
        $user_attendance = $this->checkAndGet($user_attendanceId);
        $data = json_decode((string) json_encode($input), false);

        return $this->user_attendanceRepository->update($user_attendance, $data);
    }

    public function delete(int $user_attendanceId): void
    {
        $this->checkAndGet($user_attendanceId);
        $this->user_attendanceRepository->delete($user_attendanceId);
    }
}
