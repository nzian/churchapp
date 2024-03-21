<?php

use Phoenix\Migration\AbstractMigration;

/*
- id
- user_id 
- user_type 
- church_id
- qr_code_text
- created_at
- updated_at
- deleted_at
*/

class UserAttendane extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('CREATE TABLE `user_attendance` (
            `id` int NOT NULL,
            `user_id` int NOT NULL,
            `church_id` int NOT NULL,
            `user_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT "member",
            `qr_code_text` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
        $this->execute('ALTER TABLE `user_attendance` ADD PRIMARY KEY (`id`);');
        $this->execute('ALTER TABLE `user_attendance`
        MODIFY `id` int NOT NULL AUTO_INCREMENT;
        COMMIT;');   
    }

    protected function down(): void
    {
        if($this->tableExists('user_attendance')) {
            $this->table('user_attendance')
            ->drop();
        }
    }
}
