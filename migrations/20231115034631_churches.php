<?php

use Phoenix\Database\Element\Column;
use Phoenix\Database\Element\ColumnSettings;
use Phoenix\Migration\AbstractMigration;

class Churches extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('CREATE TABLE `churches` (
            `id` int NOT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `firebaseId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `social_media_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
        $this->execute('ALTER TABLE `churches` ADD `status` BOOLEAN NOT NULL DEFAULT TRUE AFTER `social_media_link`;');
        $this->execute('ALTER TABLE `churches` ADD PRIMARY KEY (`id`);');
        $this->execute('ALTER TABLE `churches`
        MODIFY `id` int NOT NULL AUTO_INCREMENT;
        COMMIT;');

    }

    protected function down(): void
    {
        if($this->tableExists('churches')) {
            $this->table('churches')
            ->drop();
        }
    }
}
