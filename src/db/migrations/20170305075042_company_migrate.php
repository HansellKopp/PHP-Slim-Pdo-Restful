<?php

use Phinx\Migration\AbstractMigration;

class CompanyMigrate extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('company');
        $table->addColumn('taxId', 'string', array('limit' => 10))
            ->addColumn('name', 'string', array('limit' => 100))
            ->addColumn('address', 'string', array('limit' => 200))
            ->addColumn('phoneNumber', 'string', array('limit' => 20))
            ->addColumn('email', 'string', array('limit' => 100))
            ->addTimestamps()
            ->addIndex('taxId', array('unique' => true))
            ->create();
    }
}
