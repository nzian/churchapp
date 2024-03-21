<?php

use Phoenix\Migration\AbstractMigration;
// update user table with type column guest and member
class UserUpdateType extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('ALTER TABLE `users` ADD `user_type` VARCHAR(50) NOT NULL DEFAULT "guest" AFTER `church_id`;');
    }

    protected function down(): void
    {
        $this->execute('ALTER TABLE `users` DROP `user_type`;');
    }
}
