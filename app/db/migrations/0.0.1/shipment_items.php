<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class ShipmentItemsMigration_001 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'shipment_items',
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
                    'shipments_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'order_items_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'shipments_id'
                    )
                ),
                new Column(
                    'quantity',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'order_items_id'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id')),
                new Index('fk_shipment_items_shipments1_idx', array('shipments_id')),
                new Index('fk_shipment_items_order_items1_idx', array('order_items_id'))
            ),
            'references' => array(
                new Reference('fk_shipment_items_shipments', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'shipments',
                    'columns' => array('shipments_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('fk_shipment_items_order_items', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'order_items',
                    'columns' => array('order_items_id'),
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
