<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class ResourcesMigration_001 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'resources',
            array(
            'columns' => array(
                new Column(
                    'name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'first' => true
                    )
                ),
                new Column(
                    'description',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'name'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('name'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'ucs2_general_ci'
            )
        )
        );
    }
}
