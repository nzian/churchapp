<?php

use Phoenix\Migration\AbstractMigration;

class UpdateChurch extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('ALTER TABLE `churches` ADD `notification_delete_cycle` INT DEFAULT 30 AFTER status;');
    }

    protected function down(): void
    {
        $this->execute('ALTER TABLE `churches` DROP `notification_delete_cycle`;');
    }
}
