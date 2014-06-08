<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class AccessListMigration_001 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'access_list',
            array(
            'columns' => array(
                new Column(
                    'roles_name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'first' => true
                    )
                ),
                new Column(
                    'resources_name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'roles_name'
                    )
                ),
                new Column(
                    'access_name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'resources_name'
                    )
                ),
                new Column(
                    'allowed',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 3,
                        'after' => 'access_name'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('roles_name', 'resources_name', 'access_name'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_unicode_ci'
            )
        )
        );
    }
}
