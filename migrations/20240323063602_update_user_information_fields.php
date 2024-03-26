<?php

use Phoenix\Migration\AbstractMigration;

class UpdateUserInformationFields extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute('ALTER TABLE `user_information` ADD `gender` VARCHAR(50) NOT NULL DEFAULT "male" AFTER `dateofbirth`;');
        $this->execute('ALTER TABLE `user_information` ADD `age` TINYINT(2) NOT NULL DEFAULT 0 AFTER `gender`;');
        $this->execute('ALTER TABLE `user_information` ADD `added_by` varchar(200) NOT NULL DEFAULT "pastor" AFTER `age`;');
        $this->execute('ALTER TABLE `user_information` ADD `updated_by` varchar(200) NOT NULL DEFAULT pastor AFTER `added_by`;');
    }

    protected function down(): void
    {
        $this->execute('ALTER TABLE `users` DROP `gender`, `age`, `added_by`, `updated_by`;');
    }
}
