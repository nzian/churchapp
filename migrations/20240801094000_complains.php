<?php

use Phoenix\Migration\AbstractMigration;

class Complains extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('CREATE TABLE `complains` (
            `id` int NOT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `complain` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
        $this->execute('ALTER TABLE `complains` ADD PRIMARY KEY (`id`);');
        $this->execute('ALTER TABLE `complains`
        MODIFY `id` int NOT NULL AUTO_INCREMENT;
        COMMIT;');
    }

    protected function down(): void
    {
        if($this->tableExists('complains')) {
            $this->table('complains')
            ->drop();
        }
    }
}
