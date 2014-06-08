<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class UserAddressesMigration_001 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'user_addresses',
            array(
            'columns' => array(
                new Column(
                    'id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 10,
                        'first' => true
                    )
                ),
                new Column(
                    'users_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'user_address_type',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 45,
                        'after' => 'users_id'
                    )
                ),
                new Column(
                    'first_name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'user_address_type'
                    )
                ),
                new Column(
                    'last_name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'first_name'
                    )
                ),
                new Column(
                    'address1',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'last_name'
                    )
                ),
                new Column(
                    'address2',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'address1'
                    )
                ),
                new Column(
                    'city',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'address2'
                    )
                ),
                new Column(
                    'state',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'city'
                    )
                ),
                new Column(
                    'postal_code',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'state'
                    )
                ),
                new Column(
                    'country',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'postal_code'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id')),
                new Index('fk_user_addresses_1_idx', array('users_id'))
            ),
            'references' => array(
                new Reference('fk_user_addresses_users', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'users',
                    'columns' => array('users_id'),
                    'referencedColumns' => array('id')
                ))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '1',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_unicode_ci'
            )
        )
        );
    }
}
