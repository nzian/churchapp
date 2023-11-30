<?php

use Phoenix\Migration\AbstractMigration;

/*
- id
- title
- description
- published
- published_at
- created_by
- updated_by
- church_id
- created_at
- updated_at
- deleted_at
*/
class Notifications extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('CREATE TABLE `notifications` (
            `id` int NOT NULL,
            `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
            `published` BOOLEAN NOT NULL DEFAULT TRUE,
            `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `created_by` int NOT NULL,
            `updated_by` int DEFAULT NULL,
            `church_id` int NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
        $this->execute('ALTER TABLE `notifications` ADD PRIMARY KEY (`id`);');
        $this->execute('ALTER TABLE `notifications`
        MODIFY `id` int NOT NULL AUTO_INCREMENT;
        COMMIT;');
    }

    protected function down(): void
    {
        if($this->tableExists('notifications')) {
            $this->table('notifications')
            ->drop();
        }
    }
}
