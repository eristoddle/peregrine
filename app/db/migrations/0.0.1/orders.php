<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class OrdersMigration_001 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'orders',
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
                    'order_statuses_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'users_id'
                    )
                ),
                new Column(
                    'billing_address_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'order_statuses_id'
                    )
                ),
                new Column(
                    'shipping_address_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'billing_address_id'
                    )
                ),
                new Column(
                    'shipping_and_handling',
                    array(
                        'type' => Column::TYPE_DECIMAL,
                        'notNull' => true,
                        'size' => 6,
                        'scale' => 2,
                        'after' => 'shipping_address_id'
                    )
                ),
                new Column(
                    'subtotal',
                    array(
                        'type' => Column::TYPE_DECIMAL,
                        'notNull' => true,
                        'size' => 6,
                        'scale' => 2,
                        'after' => 'shipping_and_handling'
                    )
                ),
                new Column(
                    'grand_total',
                    array(
                        'type' => Column::TYPE_DECIMAL,
                        'notNull' => true,
                        'size' => 6,
                        'scale' => 2,
                        'after' => 'subtotal'
                    )
                ),
                new Column(
                    'date_created',
                    array(
                        'type' => Column::TYPE_DATE,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'grand_total'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id')),
                new Index('idx_orders_users', array('users_id')),
                new Index('fk_orders_order_statuses1_idx', array('order_statuses_id'))
            ),
            'references' => array(
                new Reference('fk_orders_users', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'users',
                    'columns' => array('users_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('fk_orders_order_statuses1', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'order_statuses',
                    'columns' => array('order_statuses_id'),
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
