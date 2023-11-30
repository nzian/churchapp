<?php

use Phoenix\Migration\AbstractMigration;

/*
- id
- user_id
- notification_id
- read
- church_id
- created_at
- updated_at
- deleted_at
*/
class UserNotifications extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('CREATE TABLE `user_notifications` (
            `id` int NOT NULL,
            `user_id` int NOT NULL,
            `church_id` int NOT NULL,
            `notification_id` int NOT NULL,
            `read` BOOLEAN NOT NULL DEFAULT TRUE,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
        $this->execute('ALTER TABLE `user_notifications` ADD PRIMARY KEY (`id`);');
        $this->execute('ALTER TABLE `user_notifications`
        MODIFY `id` int NOT NULL AUTO_INCREMENT;
        COMMIT;');
    }

    protected function down(): void
    {
        if($this->tableExists('user_notifications')) {
            $this->table('user_notifications')
            ->drop();
        }
    }
}
