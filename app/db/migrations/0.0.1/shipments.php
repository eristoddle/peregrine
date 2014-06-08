<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class ShipmentsMigration_001 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'shipments',
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
                    'orders_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'invoices_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'orders_id'
                    )
                ),
                new Column(
                    'shipping_methods_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'invoices_id'
                    )
                ),
                new Column(
                    'date_created',
                    array(
                        'type' => Column::TYPE_DATE,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'shipping_methods_id'
                    )
                ),
                new Column(
                    'tracking_code',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'date_created'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id')),
                new Index('fk_shipments_1_idx', array('orders_id')),
                new Index('fk_shipments_invoices1_idx', array('invoices_id')),
                new Index('fk_shipments_shipping_methods1_idx', array('shipping_methods_id'))
            ),
            'references' => array(
                new Reference('fk_shipments_orders', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'orders',
                    'columns' => array('orders_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('fk_shipments_invoices', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'invoices',
                    'columns' => array('invoices_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('fk_shipments_shipping_methods', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'shipping_methods',
                    'columns' => array('shipping_methods_id'),
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
