<?php

use Phoenix\Migration\AbstractMigration;

class UpdatePastor extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('ALTER TABLE `pastors` ADD `social_media_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci AFTER status;');
    }

    protected function down(): void
    {
        $this->execute('ALTER TABLE `pastors` DROP `social_media_link`;');
    }
}