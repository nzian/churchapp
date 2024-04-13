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
        // check if user already make a checkin
        if( $this->checkUserCheckin($user_attendance)) {
            return (object)[
                'error' => true,
                'message' => "This User already checkedin",
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

    private function checkUserCheckin(object $checkin) : bool 
    {
        return $this->user_attendanceRepository->existCheckin($checkin);
    }

    public function allUserAttendance(array $input): array {
        $attendance_filter = json_decode((string) json_encode($input), false);
        // check which filter send by user
        if($attendance_filter->start_date && $attendance_filter->end_date) {
            $date_start = date('Y-m-d h:i:s', strtotime($attendance_filter->start_date));
            $date_end = date('Y-m-d h:i:s', strtotime($attendance_filter->end_date));
            return $this->user_attendanceRepository->getAttendanceAll($date_start,$date_end);
        }
        elseif($attendance_filter->month) {
            if($attendance_filter->year) {
                $date_start = date( $attendance_filter->year .'-m-01');
                $date_end = date($attendance_filter->year .'-m-t');
                return $this->user_attendanceRepository->getAttendanceAll($date_start,$date_end);
            }
            else {
                $date_start = date('Y-m-01');
                $date_end = date('Y-m-t');
                return $this->user_attendanceRepository->getAttendanceAll($date_start,$date_end);
            }
           
        }
    }

    public function getAttendanceByUserId(array $input, int $user_id): array {
        $attendance_filter = json_decode((string) json_encode($input), false);
        // check which filter send by user
        if($attendance_filter->start_date && $attendance_filter->end_date) {
            $date_start = date('Y-m-d h:i:s', strtotime($attendance_filter->start_date));
            $date_end = date('Y-m-d h:i:s', strtotime($attendance_filter->end_date));
            return $this->user_attendanceRepository->getAttendanceByUserId($user_id,$date_start,$date_end);
        }
        elseif($attendance_filter->month) {
            if($attendance_filter->year) {
                $date_start = date( $attendance_filter->year .'-m-01');
                $date_end = date($attendance_filter->year .'-m-t');
                return $this->user_attendanceRepository->getAttendanceByUserId($user_id,$date_start,$date_end);
            }
            else {
                $date_start = date('Y-m-01');
                $date_end = date('Y-m-t');
                return $this->user_attendanceRepository->getAttendanceByUserId($user_id,$date_start,$date_end);
            }
           
        }
    }
}
