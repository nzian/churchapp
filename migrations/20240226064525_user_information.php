<?php

use Phoenix\Migration\AbstractMigration;

/*
- id
- user_id 
- user_type  guest or member
- church_id
- first_name needed
- last_name needed
- id or passport_number optional
- telephone needed
- street optional
- apartment, optional
- suburb, optional
- city,  needed
- province, needed
- area_code optional
- race (Ex Caucasian, African)
- dateofbirth nullable
- marital_status (Single, Divorced, Married) nullable 
- vital_status (Alive, Deceased) nullable but for member its must
- membership_number  nullable but for memeber its must
- password nullable but for member its must
- gender
- age
- created_by
- updated_by
- created_at
- updated_at
- deleted_at
*/

class UserInformation extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('CREATE TABLE `user_information` (
            `id` int NOT NULL,
            `user_id` int NOT NULL,
            `church_id` int NOT NULL,
            `user_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT "guest",
            `first_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
            `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            `passport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `apartment` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `suburb` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `province` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `area_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `race` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `marital_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `vital_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `membership_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `dateofbirth` datetime DEFAULT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
        $this->execute('ALTER TABLE `user_information` ADD PRIMARY KEY (`id`);');
        $this->execute('ALTER TABLE `user_information`
        MODIFY `id` int NOT NULL AUTO_INCREMENT;
        COMMIT;');
    }

    protected function down(): void
    {
        if($this->tableExists('user_information')) {
            $this->table('user_information')
            ->drop();
        }
    }
}
