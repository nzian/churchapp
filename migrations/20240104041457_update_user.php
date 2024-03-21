<?php

use Phoenix\Migration\AbstractMigration;

class UpdateUser extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('ALTER TABLE `users` ADD `unique_device_id` varchar(255) DEFAULT NULL AFTER `device_token`;');
    }

    protected function down(): void
    {
        $this->execute('ALTER TABLE `users` DROP `unique_device_id`;');
    }
}
