<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateCharactersTable extends AbstractMigration
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
        $this->table('characters')
        ->addColumn('name', 'string')
        ->addColumn('nickname', 'string')
        ->addColumn('image', 'string')
        ->addColumn('id_version', 'integer', ['null' => true])
        ->addColumn('id_attribute', 'integer')
        ->addColumn('id_affiliation', 'integer')
        ->addColumn('id_affiliation2', 'integer', ['null' => true])
        ->addColumn('id_soultrait', 'integer')
        ->addColumn('id_killer', 'integer')
        ->addColumn('id_killer2', 'integer', ['null' => true])
        ->addColumn('description', 'text', ['limit' => MysqlAdapter::TEXT_LONG ])
        ->addColumn('release_date', 'datetime')
        ->addColumn('created_at', 'datetime')

        ->addIndex(['id_attribute','id_version','id_affiliation','id_affiliation2', 'id_soultrait'])
       
        /*->addForeignKey('id_attribute', 'attributes', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
        ->addForeignKey('id_version', 'versions', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
        ->addForeignKey('id_affiliation', 'affiliations', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
        ->addForeignKey('id_affiliation2', 'affiliations', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
        ->addForeignKey('id_soultrait', 'soultraits', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])*/

        ->save();
    }
}
