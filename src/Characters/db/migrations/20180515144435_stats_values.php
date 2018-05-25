<?php


use Phinx\Migration\AbstractMigration;

class StatsValues extends AbstractMigration
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
        $this->table('statsvalues')
        ->addColumn('id_charaStats', 'integer')
        ->addColumn('id_statsNames', 'integer')
        ->addColumn('value', 'integer')
        /*->addForeignKey('id_charaStats', 'characters', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
        ->addForeignKey('id_statsNames', 'statsnames', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])*/
        ->save();
    }
}
