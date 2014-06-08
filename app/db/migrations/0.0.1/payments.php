<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class PaymentsMigration_001 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'payments',
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
                    'invoices_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'payment_methods_id',
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
                        'after' => 'payment_methods_id'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id')),
                new Index('fk_payments_payment_methods1_idx', array('payment_methods_id')),
                new Index('fk_payments_invoices1_idx', array('invoices_id'))
            ),
            'references' => array(
                new Reference('fk_payments_payment_methods', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'payment_methods',
                    'columns' => array('payment_methods_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('fk_payments_invoices', array(
                    'referencedSchema' => 'peregrine',
                    'referencedTable' => 'invoices',
                    'columns' => array('invoices_id'),
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
