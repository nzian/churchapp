<?php

declare(strict_types=1);

namespace App\Traits;

trait DataResponse
{
    public function updateDataBeforeSendToResponse(array|Object $data, int $error_code = 0, string $error_message = 'Action Successful'): array
    {
        return [
            'error' => $error_code,
            'message' => $error_message,
            'data' => $data
        ];
    }
}
