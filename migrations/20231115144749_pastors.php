<?php

use Phoenix\Migration\AbstractMigration;

class Pastors extends AbstractMigration
{
    /**
    *- id
    * name
    *- email
    *- status
    *- church_id
    *- created_at
    *- updated_at
    *- deleted_at
     */
    protected function up(): void
    {
        $this->execute('CREATE TABLE `pastors` (
            `id` int NOT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `status` BOOLEAN NOT NULL DEFAULT TRUE,
            `church_id` int NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
        $this->execute('ALTER TABLE `pastors` ADD PRIMARY KEY (`id`);');
        $this->execute('ALTER TABLE `pastors`
        MODIFY `id` int NOT NULL AUTO_INCREMENT;
        COMMIT;');
    }

    protected function down(): void
    {
        if($this->tableExists('pastors')) {
            $this->table('pastors')
            ->drop();
        }
    }
}
