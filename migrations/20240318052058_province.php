<?php

use Phoenix\Migration\AbstractMigration;

class Province extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('province')
        ->addColumn('name', 'string')
        ->addColumn('created_at', 'datetime')
        ->create();
    }

    protected function down(): void
    {
        $this->table('province')->drop();
    }
}
