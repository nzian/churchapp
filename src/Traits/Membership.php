<?php

declare(strict_types=1);

namespace App\Traits;

trait Membership
{
    public function generateMembershipNumber(): string
    {
        $membership_number = 'SACH-' . time();
        
        return $membership_number;
    }
}
