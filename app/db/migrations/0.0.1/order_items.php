<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class OrderItemsMigration_001 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'order_items',
            array(
            'columns' => array(
                new Column(
                    'id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
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
                    'products_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'orders_id'
                    )
                ),
                new Column(
                    'quantity',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'products_id'
                    )
                ),
                new Column(
                    'line_total',
                    array(
                        'type' => Column::TYPE_DECIMAL,
                        'notNull' => true,
                        'size' => 6,
                        'scale' => 2,
                        'after' => 'quantity'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id')),
                new Index('idx_ordered_product_customer_order', array('orders_id')),
                new Index('idx_order_items_products', array('products_id'))
            ),
            'references' => array(
                new Reference('fk_order_items_order', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'orders',
                    'columns' => array('orders_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('fk_order_items_products', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'products',
                    'columns' => array('products_id'),
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
