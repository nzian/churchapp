<?php

use Phoenix\Migration\AbstractMigration;

class UpdateUserInformationFields extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('ALTER TABLE `user_information` ADD `age` INT NOT NULL DEFAULT 0 AFTER `dateofbirth`;');
    }

    protected function down(): void
    {
        $this->execute('ALTER TABLE `user_information` DROP `age`;');
    }
}
