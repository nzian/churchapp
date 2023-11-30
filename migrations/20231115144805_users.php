<?php

use Phoenix\Migration\AbstractMigration;

/*
- id
- name
- device_token
- status
- email
- phone
- church_id
- created_at
- updated_at
- deleted_at
*/
class Users extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('CREATE TABLE `users` (
            `id` int NOT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `device_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `status` BOOLEAN NOT NULL DEFAULT TRUE,
            `church_id` int NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
        $this->execute('ALTER TABLE `users` ADD PRIMARY KEY (`id`);');
        $this->execute('ALTER TABLE `users`
        MODIFY `id` int NOT NULL AUTO_INCREMENT;
        COMMIT;');
    }

    protected function down(): void
    {
        if($this->tableExists('users')) {
            $this->table('users')
            ->drop();
        }
    }
}
