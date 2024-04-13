<?php

use Phoenix\Migration\AbstractMigration;

class UpdateUserInformationFieldsSecond extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('ALTER TABLE `user_information` ADD `email` VARCHAR(255) DEFAULT NULL AFTER `age`;');
        $this->execute('ALTER TABLE `user_information` ADD `phone` VARCHAR(20) DEFAULT NULL AFTER `email`;');
    }

    protected function down(): void
    {
        $this->execute('ALTER TABLE `user_information` DROP `email`;');
        $this->execute('ALTER TABLE `user_information` DROP `phone`;');
    }
}
