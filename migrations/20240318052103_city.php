<?php

use Phoenix\Migration\AbstractMigration;

class City extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('city')
        ->addColumn('name', 'string')
        ->addColumn('province_id', 'integer')
        ->addColumn('created_at', 'datetime')
        ->create();
    }

    protected function down(): void
    {
        $this->table('city')->drop();
    }
}
